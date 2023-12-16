<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Material;
use App\Http\Controller\MaterialController;



class ClothingController extends Controller
{
    public function index()
    {
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

    public function destroy(Material $clothing)
    {
        try {
            $clothing->delete();
            return redirect()->route('clothing.index')->with('success', 'Material excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clothing.index')->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');
        }
    }
}
