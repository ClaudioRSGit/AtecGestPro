<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseClass;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\CourseClassRequest;

class CourseClassController extends Controller
{
    public function index(Request $request)
    {
        $courseClassSearch = $request->input('courseClassSearch');
        $courseFilter = $request->input('courseFilter');

        $query = CourseClass::with('users', 'course');

        if ($courseFilter && $courseFilter !== 'all') {
            $query->whereHas('course', function ($courseQuery) use ($courseFilter) {
                $courseQuery->where('id', $courseFilter);
            });
        }

        if ($courseClassSearch) {
            $query->where(function ($courseClassQuery) use ($courseClassSearch) {
                $courseClassQuery->where('description', 'like', "%$courseClassSearch%");
            });
        }

        $courseClasses = $query->paginate(5)->withQueryString();
        $courses = Course::all();


        if ($courseClasses->isEmpty()) {
            $errorMessage = 'Não foram encontradas turmas.';
            return view('course-classes.index', compact('errorMessage', 'courseClasses', 'courses', 'courseFilter', 'courseClassSearch'));
        } else {
            return view('course-classes.index', compact('courseClasses', 'courses', 'courseFilter', 'courseClassSearch'));
        }

    }

    public function show(CourseClass $courseClass)
    {
        $courses = Course::all();
        $students = User::where('course_class_id', $courseClass->id)->where('isStudent', true)->get();

        return view('course-classes.show', compact('courseClass', 'students', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        $emptyStudents = false;

        $students = User::where('isStudent', 1)->whereNull('course_class_id')->get();

        return view('course-classes.create', compact('courses', 'students', 'emptyStudents'))->with('success', 'Turma criada com sucesso!');
    }

    public function store(CourseClassRequest $request)
    {
        dd($request->all());
        try {
            $courseClass = CourseClass::create([
                'description' => $request->input('description'),
                'course_id' => $request->input('course_id'),
            ]);

            if ($request->has('noImport')) {
                if ($request->has('selected_students')) {
                    foreach ($request->input('selected_students') as $student) {
                        $user = User::find($student);
                        $user->update(['course_class_id' => $courseClass->id]);
                    }
                }
            } else if ($request->has('import')) {
                return redirect()->route('import-excel.importStudents');
            }
            return redirect()->route('course-classes.index')->with('success', 'Turma criada com sucesso!');
        } catch (\Exception $e) {

            return redirect()->route('course-classes.index')->with('error', 'Erro ao criar turma!');
        }
    }


    public function edit(CourseClass $courseClass)
    {

        $courseClass->load('course', 'users');
        $courses = Course::all();
        $students = User::where('course_class_id', $courseClass->id)->where('isStudent', true)->get();
        $studentsWithoutClassCourse = User::whereNull('course_class_id')->where('isStudent', '=', '1')->get();

        return view('course-classes.edit', compact('courseClass', 'courses', 'studentsWithoutClassCourse', 'students'));
    }

    public function update(CourseClassRequest $request, CourseClass $courseClass)
    {
        try {
            $data = $request->validated();
            $courseClass->update($data);

            if ($request->has('studentsToAdd')) {
                foreach ($request->input('studentsToAdd') as $student) {
                    $user = User::find($student);
                    $user->course_class_id = $courseClass->id;
                    $user->save();
                }
            }

            if ($request->has('studentsToRemove')) {
                foreach ($request->input('studentsToRemove') as $student) {
                    $user = User::find($student);
                    $user->course_class_id = null;
                    $user->save();
                }
            }

            return redirect()->route('course-classes.index')->with('success', 'Turma atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('course-classes.index')->with('error', 'Erro ao atualizar turma!');
        }
    }
    public function destroy(CourseClass $courseClass)
    {
        try {
            $students = User::where('course_class_id', $courseClass->id)->get();

            foreach ($students as $student) {
                $student->course_class_id = null;
                $student->save();
            }

            $courseClass->delete();
            return redirect()->route('course-classes.index')->with('success', 'Turma apagada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('course-classes.index')->with('error', 'Erro ao apagar turma!');
        }
    }


}
