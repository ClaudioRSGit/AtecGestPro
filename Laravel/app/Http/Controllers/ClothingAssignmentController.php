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
        $student = User::find($id);
        $name = $student->name;

        $clothing_assignment = Material::where('isClothing', 1)->get();
        return view('clothing-assignment.index', ['name' => $name], compact('clothing_assignment',  'student'));
    }

    public function create()
    {
        return view('clothing-assignment.create');
    }

    public function details()
    {
        //
    }

        // testetttttttttttttttttttt
        //public function store(Request $request)
        //{
        //    $request->validate([
        //        'name' => 'required|string|max:255',
        //        'selectedClothing' => 'required|array',
        //        'selectedClothing.*' => 'exists:materials,id',
        //    ]);
//
        //    try {
        //        $clothing_delivery = ClothingDelivery::create($request->all());
//
        //        // Get the selected clothing items from the request
        //        $selectedClothing = $request->input('selectedClothing');
//
        //        // Associate the selected clothing items with the clothing delivery
        //        foreach ($selectedClothing as $clothingId) {
        //            DB::table('material__clothing__deliveries')->insert([
        //                'clothing_delivery_id' => $clothing_delivery->id,
        //                'material_id' => $clothingId
        //            ]);
        //        }
//
        //        return redirect()->route('materials.show', $clothing_delivery->id)->with('success', 'Material inserido com sucesso!');
        //    } catch (\Exception $e) {
        //        return redirect()->back()->with('error', 'Erro ao inserir o material. Por favor, tente novamente.');
        //    }
        //}

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

    //testetttttttttttttttttttt
   // public function update(Request $request, $id)
    //{
    //    $request->validate([
    //        'selectedClothing' => 'required|array',
    //        'selectedClothing.*' => 'exists:materials,id',
    //    ]);
    //
    //    try {
    //        // Find the specific ClothingDelivery by its ID
    //        $clothing_delivery = ClothingDelivery::findOrFail($id);
        //
    //        // Get the selected clothing items from the request
    //        $selectedClothing = $request->input('selectedClothing');
        //
    //        // Update the associated clothing items
    //        $clothing_delivery->materials()->sync($selectedClothing);
        //
    //        return redirect()->route('clothing-delivery.show', $clothing_delivery->id)->with('success', 'Clothing Delivery updated successfully!');
    //    } catch (\Exception $e) {
    //        return redirect()->back()->with('error', 'Error updating Clothing Delivery. Please try again.');
    //    }
    //}

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

   // public function assign(Request $request)

}
