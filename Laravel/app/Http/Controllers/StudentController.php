<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('isStudent', true)->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $student = new User;
        $student->name = $request->input('name');
        $student->isStudent = true;
        $student->save();

        return redirect()->route('students.index')->with('success', 'Estudante criado com sucesso!');
    }

    public function show(User $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(User $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $student->name = $request->input('name');
        $student->save();

        return redirect()->route('students.index')->with('success', 'Estudante atualiado com sucesso!');
    }

    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Estudante apagado com sucesso!');
    }
}
