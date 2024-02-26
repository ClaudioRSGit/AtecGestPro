<?php

namespace App\Http\Controllers;

use App\Course;
use App\Material;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MaterialRequest;

class MaterialController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $materialFilter = $request->input('materialFilter');
        $sortColumn = $request->input('sortColumn', 'name'); // default sort by 'name'
        $sortDirection = $request->input('sortDirection', 'asc'); // default sort direction 'asc'
        $searchRecycled = $request->input('searchRecycled');
        $materialRecycledFilter = $request->input('materialRecycledFilter');



        $queryRecycled = Material::onlyTrashed();
        $query = Material::with('sizes', 'courses');

        if ($materialFilter === "internal") {
            $query->where('isInternal', 1)->where('isClothing', 0);
        } elseif ($materialFilter === "external") {
            $query->where('isInternal', 0);
        } elseif ($materialFilter === "clothing") {
            $query->where('isClothing', 1);
        }

        if ($materialRecycledFilter === "internal") {
            $queryRecycled->where('isInternal', 1)->where('isClothing', 0);
        } elseif ($materialRecycledFilter === "external") {
            $queryRecycled->where('isInternal', 0);
        } elseif ($materialRecycledFilter === "clothing") {
            $queryRecycled->where('isClothing', 1);
        }

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($searchRecycled) {
            $queryRecycled->where('name', 'like', "%$searchRecycled%");
        }

        $materials = $query->orderBy($sortColumn, $sortDirection)->paginate(5, ['*'], 'mPage')->withQueryString();
        $recycleMaterials = $queryRecycled->orderBy($sortColumn, $sortDirection)->paginate(5, ['*'], 'rPage')->withQueryString();
        return view('materials.index', compact('materials', 'search', 'materialFilter', 'sortColumn', 'sortDirection', 'recycleMaterials', 'searchRecycled', 'materialRecycledFilter'));
    }


    public function create()
    {

        $sizes = Size::all();
        $courses = Course::all();


        return view('materials.create', compact('sizes', 'courses'));
    }

    public function store(MaterialRequest $request)
    {

        try {
            if ($request->input('isClothing') == 0) {
                $request->merge([
                    'gender' => null,
                    'sizes' => [],
                    'stocks' => [],
                    'courses' => [],
                ]);
            }
            
            $quantity = $request->input('quantity');

            if ($request->input('isClothing')) {
                $quantity = 0;
            }

            $request->merge(['quantity' => $quantity]);


            $material = Material::create($request->all());


            $material->courses()->attach($request->input('courses'));

            $sizes = $request->input('sizes', []);

            $stocks = $request->input('stocks', []);

            if ($sizes) {
                foreach ($sizes as $sizeId) {
                    $stock = $stocks[$sizeId] ?? 0;

                    $material->sizes()->attach($sizeId, ['stock' => $stock]);

                }
            }


            return redirect()->route('materials.show', $material->id)->with('success', 'Material inserido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
        }
    }


    public function show(Material $material)
    {
        $sizesAll = Size::all();
        $coursesAll = Course::all();
        $sizes = $material->sizes;
        $courses = $material->courses;

        return view('materials.show', compact('material' , 'sizes', 'courses' , 'sizesAll' , 'coursesAll'));

    }

    public function edit(Material $material)
    {

        $sizesAll = Size::all();
        $coursesAll = Course::all();
        $sizes = $material->sizes;
        $courses = $material->courses;

        return view('materials.edit', compact('material' , 'sizes', 'courses' , 'sizesAll' , 'coursesAll'));
    }

    public function update(Request $request, Material $material)
    {
        try {
            if ($request->input('isClothing') == 0) {
                $request->merge([
                    'gender' => null,
                    'sizes' => [],
                    'stocks' => [],
                    'courses' => [],
                ]);
            }
            $material->update($request->all());

            $material->courses()->sync($request->input('courses', []));

            $sizes = $request->input('sizes', []);
            $stocks = $request->input('stocks', []);
            $syncData = [];
            foreach ($sizes as  $sizeId) {
                $stock = $stocks[$sizeId] ?? 0;
                $syncData[$sizeId] = ['stock' => $stock];
            }

            $material->sizes()->sync($syncData);

            return redirect()->route('materials.show', ['material' => $material->id])->with('success', 'Material atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar material!');
        }
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
            'material_ids.*' => 'exists:materials,id',
        ]);

        try {
            Material::whereIn('id', $request->input('material_ids'))->delete();
            return redirect()->back()->with('success', 'Materiais selecionados excluídos com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir os materiais selecionados. Por favor, tente novamente.');
        }
    }

    public function restore($id)
    {
        try {
            $material = Material::withTrashed()->findOrFail($id);
            $material->restore();
            return redirect()->route('materials.index')->with('success', 'Material restaurado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('materials.index')->with('error', 'Erro ao restaurar o material. Por favor, tente novamente.');
        }
    }

    public function massRestore(Request $request)
    {

        $request->validate([
            'material_ids' => 'required|array',
            'material_ids.*' => 'exists:materials,id',
        ]);

        try {
            Material::withTrashed()->whereIn('id', $request->input('material_ids'))->restore();
            return redirect()->back()->with('success', 'Materiais selecionados restaurados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao restaurar os materiais selecionados. Por favor, tente novamente.');
        }
    }

    public function forceDelete($id)
    {
        try {
            $material = Material::withTrashed()->findOrFail($id);
            $material->forceDelete();
            return redirect()->route('materials.index')->with('success', 'Material excluído permanentemente!');
        } catch (\Exception $e) {
            return redirect()->route('materials.index')->with('error', 'Erro ao excluir permanentemente o material. Por favor, tente novamente.');
        }
    }

    public function massForceDelete(Request $request)
    {
        $request->validate([
            'material_ids' => 'required|array',
            'material_ids.*' => 'exists:materials,id',
        ]);

        try {
            Material::withTrashed()->whereIn('id', $request->input('material_ids'))->forceDelete();
            return redirect()->back()->with('success', 'Materiais selecionados excluídos permanentemente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir permanentemente os materiais selecionados. Por favor, tente novamente.');
        }
    }

}
