<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseClass;
use Illuminate\Http\Request;

class CourseClassController extends Controller
{
    public function index()
    {
        $courseClasses = CourseClass::all();
        return view('courseClass.index', [
            'courseClasses' => $courseClasses
    ]);
    }

    public function create()
    {
        $courses = Course::all();
        return view('courseClasses.create',[
            'courses' => $courses
        ]);

    }
    public function details($courseClass){
        $courseClass = CourseClass::where('id',$courseClass)->get();
        return view('courseClass_details',[
            'courseClass' => $courseClass
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CourseClass $courseClass)
    {
        //
    }

    public function edit(CourseClass $courseClass)
    {
        //
    }

    public function update(Request $request, CourseClass $courseClass)
    {
        //
    }

    public function destroy(CourseClass $courseClass)
    {
        //
    }
}
