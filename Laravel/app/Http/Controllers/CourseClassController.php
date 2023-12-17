<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseClass;
use Illuminate\Http\Request;
use App\User;
class CourseClassController extends Controller
{
    public function index()
    {
        $courseClasses = CourseClass::with('students')->paginate(5);
        $courses = Course::all();
        return view('course-classes.index', compact('courseClasses', 'courses'));
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
        return view('course-classes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        CourseClass::create($request->all());

        return redirect()->route('course-classes.index')->with('success', 'Course class created successfully!');
    }

    public function edit(CourseClass $courseClass)
    {
        $courseClass->load('course', 'students');
        $courses = Course::all();

        return view('course-classes.edit', compact('courseClass', 'courses'));
    }

    public function update(Request $request, CourseClass $courseClass)
    {
        $courseClass->update($request->all());

        return redirect()->route('course-classes.index')->with('success', 'Course class updated successfully!');
    }

    public function destroy(CourseClass $courseClass)
    {
        $courseClass->delete();
        return redirect()->route('course-classes.index')->with('success', 'Course class deleted successfully!');
    }
}
