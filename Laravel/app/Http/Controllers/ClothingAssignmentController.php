<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\User;
use App\Clothing_Delivery;
use Illuminate\Support\Facades\DB;



class ClothingAssignmentController extends Controller
{
    public function index($id)
    {
        $student = $id ? User::find($id) : null;
        $name = $student ? $student->name : 'Default Name';
        $material = $id ? Material::find($id) : null;

        $clothes = Material::where('isClothing', 1)->get();
        return view('clothing-assignment.index', ['name' => $name], compact('clothes',  'student', 'material', 'id'));
    }

    public function create()
    {
        return view('clothing-assignment.create');
    }

    public function details()
    {
        //
    }


    public function store(Request $request)
    {
       $request->validate([
           'name' => 'required|string|max:255',
       ]);

       try {
           $clothes = Material::create($request->all());

           return redirect()->route('materials.show', $clothes->id)->with('success', 'Material inserido com sucesso!');
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
       }
    }

    public function show(Material $clothes)
    {
        return view('clothing-assignment.show', compact('clothes'));
    }

    public function edit(Material $clothes)
    {

        return view('clothing-assignment.edit', compact('clothes'));
    }


    public function update(Request $request, Material $clothes)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $clothes->update($request->all());

        return redirect()->back()->with('success', 'Material atualizado com sucesso!');

    }

    public function destroy($id)
    {
        try {
            $clothes = Material::find($id);
            if($clothes) {
                $clothes->delete();
                return redirect()->back()->with('success', 'Material excluído com sucesso!');

            } else {
                return redirect()->back()->with('success', 'Material não foundencontrado!');

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');

        }
    }



}
