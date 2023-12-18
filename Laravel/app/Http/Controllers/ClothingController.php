<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Course;
use App\CourseClass;
use Illuminate\Http\Request;
use App\User;
=======

use Illuminate\Http\Request;
use App\Material;
use App\Http\Controller\MaterialController;


>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785

class ClothingController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $courseClasses = CourseClass::with('students')->paginate(5);
        $courses = Course::all();
        return view('clothing.index', compact('courseClasses', 'courses'));
=======
        $clothing = Material::where('isClothing', 1)->get();
        return view('clothing.index', compact('clothing'));
    }

    public function create()
    {
        return view('clothing.create');
    }

    public function details()
    {
        // Add your code here
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $clothing = Material::create($request->all());

            return redirect()->route('materials.show', $clothing->id)->with('success', 'Material inserido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
        }
    }

    public function show(Material $clothing)
    {
        return view('clothing.show', compact('clothing'));
    }

    public function edit(Material $clothing)
    {
        return view('clothing.edit', compact('clothing'));
    }

    public function update(Request $request, Material $clothing)
    {
        // Add your code here
    }

    public function destroy($id)
    {
        try {
            $clothing = Material::find($id);
            if($clothing) {
                $clothing->delete();
                return redirect()->route('clothing.index')->with('success', 'Material excluído com sucesso!');
            } else {
                return redirect()->route('clothing.index')->with('error', 'Material not found.');
            }
        } catch (\Exception $e) {
            return redirect()->route('clothing.index')->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');
        }
>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
    }
}
