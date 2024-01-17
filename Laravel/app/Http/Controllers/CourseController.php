<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $nameFilter = $request->input('nameFilter');
//dd($nameFilter);
        $query = Course::query();

        if ($nameFilter) {
            $query->where(function ($query) use ($nameFilter) {
                $query->where('code', 'like', $nameFilter . '%');
            });
        }

        $courses = $query->paginate(5);

        if ($request->ajax()) {
            return view('courses.partials.course_table', compact('courses'));
        }

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|string|max:15',
                'description' => 'required|string|min:10|max:100',
            ]);

            $course = Course::create($request->all());

            return redirect()->route('courses.show', $course->id)->with('success', 'Curso criado com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back();
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

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|string|max:15',
            'description' => 'required|string|min:10|max:100',
        ]);


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

    public function massDelete(Request $request)
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',//all items inside array must exist
        ]);

        try {

            Course::whereIn('id', $request->input('course_ids'))->delete();
            return redirect()->back()->with('success', 'Cursos selecionados excluídos com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Erro ao excluir cursos selecionados. Por favor, tente novamente.');
        }
    }
}
