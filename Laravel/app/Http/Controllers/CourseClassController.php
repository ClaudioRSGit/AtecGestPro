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

        $courseClasses = $query->paginate(5);
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
        //select * from users where isStudent = 1


        $students = User::where('isStudent', 1)->paginate(5);

        //dd($students->toArray());
        return view('course-classes.create', compact('courses','students'));
    }

    public function store(CourseClassRequest $request)
    {

        $courseClass = CourseClass::create([
            'description' => $request->input('description'),
            'course_id' => $request->input('course_id'),
        ]);


        if($request->has('noImport')){
            if ($request->has('selected_students')) {
                foreach ($request->input('selected_students') as $student) {
                    $user = User::find($student);
                    $user->course_class_id = $courseClass->id;
                    $user->save();
                }
            }
        }
        else if($request->has('import')){
            return redirect()->route('import-excel.importStudents');
        }
        return redirect()->route('course-classes.index')->with('success', 'Course class created successfully!');

    }


    public function edit(CourseClass $courseClass)
    {
        $courseClass->load('course', 'users');
        $courses = Course::all();

        return view('course-classes.edit', compact('courseClass', 'courses'));
    }

    public function update(Request $request, CourseClass $courseClass)
    {
        dd($request->all());
        $courseClass->update($request->all());

        return redirect()->route('course-classes.index')->with('success', 'Course class updated successfully!');
    }

    public function destroy(CourseClass $courseClass)
    {
        $courseClass->delete();
        return redirect()->route('course-classes.index')->with('success', 'Course class deleted successfully!');
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'course_class_ids' => 'required|array',
            'course_class_ids.*' => 'exists:course_classes,id',
        ]);

        try {
            CourseClass::whereIn('id', $request->input('course_class_ids'))->delete();
            return redirect()->back()->with('success', 'Turmas selecionadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir as turmas selecionadas. Por favor, tente novamente.');
        }
    }

}
