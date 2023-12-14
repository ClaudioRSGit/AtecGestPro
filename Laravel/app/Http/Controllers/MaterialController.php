<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $material = Material::create($request->all());

        return redirect()->route('materials.show', $material->id)->with('success', 'Material inserido com sucesso!');
        }
        catch (\Exception $e) {

            return redirect()->back()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
        }
}



    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $material->update($request->all());

        return redirect()->route('materials.index')->with('success', 'Success!');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Success!');
    }
}
