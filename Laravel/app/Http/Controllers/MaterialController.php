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

        if ($materialFilter === "internal") {
            $materials = Material::with('sizes', 'courses')
                ->where('isInternal', 1)
                ->where('isClothing', 0)
                ->paginate(5);
        } elseif ($materialFilter === "external") {
            $materials = Material::with('sizes', 'courses')
                ->where('isInternal', 0)
                ->paginate(5);
        } elseif ($materialFilter === "clothing") {
            $materials = Material::with('sizes', 'courses')
                ->where('isClothing', 1)
                ->paginate(5);
        } elseif ($materialFilter === "all") {
            $materials = Material::with('sizes', 'courses')->paginate(5);
        } else {
            $materials = Material::with('sizes', 'courses')->paginate(5);
        }

        if ($search) {
            $materials = Material::with('sizes', 'courses')
                ->where('name', 'like', "%$search%")
                ->paginate(5);
        }

        return view('materials.index', compact('materials', 'search', 'materialFilter'));
    }


    public function create()
    {

        $sizes = Size::all();
        $courses = Course::all();


        return view('materials.create', compact('sizes', 'courses'));
    }

    public function store(MaterialRequest $request)
    {

        //DB::connection()->enableQueryLog();
        try {
            $quantity = $request->input('quantity');

            if ($request->input('isClothing')) {
                $quantity = 0;
            }

            $request->merge(['quantity' => $quantity]);


            $material = Material::create($request->all());


            $material->courses()->attach($request->input('courses'));

            $sizes = $request->input('sizes');

            $stocks = $request->input('stocks', []);

            foreach ($sizes as $sizeId) {
                $stock= $stocks[$sizeId] ?? 0;

                $material->sizes()->attach($sizeId, ['stock' => $stock]);


            }


            //  dd(DB::getQueryLog());


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

    public function update(MaterialRequest $request, Material $material)
    {
        if ($request->input('isClothing') == 0) {
            $request->merge([
                'gender' => null,
                'sizes' => [],
                'stocks' => [],
                'courses' => [],
            ]);
        }
        $material->update($request->all());

        // Update the related courses
        $material->courses()->sync($request->input('courses', []));

        // Update the related sizes and stocks
        $sizes = $request->input('sizes', []);
        $stocks = $request->input('stocks', []);
        $syncData = [];
        foreach ($sizes as $index => $sizeId) {
            $stock = $stocks[$index] ?? 0;
            $syncData[$sizeId] = ['stock' => $stock];
        }

        $material->sizes()->sync($syncData);

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
            //return redirect()->route('materials.index')->with('error', 'Erro ao excluir o material. Por favor, tente novamente.');
        }
    }


}
