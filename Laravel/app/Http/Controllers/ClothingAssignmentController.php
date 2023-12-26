<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\User;



class ClothingAssignmentController extends Controller
{
    public function index($id)
    {
        $student = User::find($id);
        $name = $student->name;

        $clothing_assignment = Material::where('isClothing', 1)->get();
        return view('clothing-assignment.index', ['name' => $name], compact('clothing_assignment'));
    }

    public function create()
    {
        return view('clothing-assignment.create');
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
            $clothing_assignment = Material::create($request->all());

            return redirect()->route('materials.show', $clothing_assignment->id)->with('success', 'Material inserido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
        }
    }

    public function show(Material $clothing_assignment)
    {
        return view('clothing-assignment.show', compact('clothing_assignment'));
    }

    public function edit(Material $clothing_assignment)
    {

        return view('clothing-assignment.edit', compact('clothing_assignment'));
    }

    public function update(Request $request, Material $clothing_assignment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $clothing_assignment->update($request->all());

        return redirect()->route('clothing-assignment.index')->with('success', 'Material atualizado com sucesso!');
    }

    public function destroy($id)
    {
        try {
            $clothing_assignment = Material::find($id);
            if($clothing_assignment) {
                $clothing_assignment->delete();
                return redirect()->route('clothing-assignment.index')->with('success', 'Material excluído com sucesso!');
            } else {
                return redirect()->route('clothing-assignment.index')->with('error', 'Material not found.');
            }
        } catch (\Exception $e) {
            return redirect()->route('clothing-assignment.index')->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');
        }
    }
}
