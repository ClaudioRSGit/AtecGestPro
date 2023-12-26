<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::paginate(5);
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
                'description' => 'nullable|string|max:500',
                'supplier' => 'nullable|string|max:255',
                'aquisition_date' => 'nullable|date',
                'isInternal' => 'required|boolean',
                'isClothing' => 'required|boolean',
                'gender' => 'nullable|boolean',
                'quantity' => 'nullable|integer|min:0',
                'size' => 'nullable|string|max:10',
                'role' => 'nullable|string|max:255',
            ]);

            $material = Material::create($request->all());

            return redirect()->route('materials.show', $material->id)->with('success', 'Material inserido com sucesso!');
            }
            catch (\Exception $e) {

                return redirect()->back()->withInput()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
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
            'name' => 'required|string|max:255',
        ]);

        $material->update($request->all());

        return redirect()->route('materials.index')->with('success', 'Material atualizado com sucesso!');
    }

    public function destroy(Material $material)
    {
        try {
            $material->delete();
            return redirect()->route('materials.index')->with('success', 'Material excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('materials.index')->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');
        }
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'material_ids' => 'required|array',
            'material_ids.*' => 'exists:materials,id',//all items inside array must exist
        ]);

        try {

            Material::whereIn('id', $request->input('material_ids'))->delete();
            return redirect()->back()->with('success', 'Materiais selecionados excluídos com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Erro ao excluir os materiais selecionados. Por favor, tente novamente.');
            return redirect()->route('materials.index')->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');
        }
    }
}
