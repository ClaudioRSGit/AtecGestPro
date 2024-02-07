<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    public function index(Request $request)
    {

        $courseSearch = $request->input('courseSearch');

        $query = Course::query();


        $sortColumn = $request->input('sortColumn', 'description');
        $sortDirection = $request->input('sortDirection', 'asc');

        if ($sortColumn && $sortDirection){
        $query->orderBy($sortColumn, $sortDirection);
        }


        if ($courseSearch) {
            $query->where(function ($query) use ($courseSearch) {
                $query->where('description', 'like', '%' . $courseSearch . '%')
                    ->orWhere('code', 'like', '%' . $courseSearch . '%');
            });
        }

        $courses = $query->paginate(5);



        return view('courses.index', compact('courses', 'courseSearch', 'sortColumn', 'sortDirection'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request)
    {
        try {

            $course = Course::create($request->all());

            return redirect()->route('courses.show', $course->id)->with('success', 'Curso criado com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Curso criado com sucesso!');;
        }
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Curso excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('courses.index')->with('error', 'Erro ao excluir o curso. Por favor, tente novamente.');
        }
    }

}
