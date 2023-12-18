<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $nameFilter = $request->input('nameFilter');

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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request, Course $course)
    {
        //
    }

    public function destroy(Course $course)
    {
        //
    }
}
