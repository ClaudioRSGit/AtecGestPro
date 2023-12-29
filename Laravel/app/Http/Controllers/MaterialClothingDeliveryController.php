<?php

namespace App\Http\Controllers;

use App\Material_Clothing_Delivery;
use Illuminate\Http\Request;
use App\Material;
use App\User;
use App\Clothing_Delivery;
use App\MaterialClothingDelivery; //ficar de olho
use App\Material_Clothing_Assignment;
use Illuminate\Support\Facades\DB;

    class MaterialClothingDeliveryController extends Controller
    {
        public function index()
        {
            //
        }

        public function create($id)
        {
            $clothing_assignment = Material::where('isClothing', 1)->get();
            $materials = Material::all();
            $clothing_deliveries = Clothing_Delivery::all();

            $student = User::find($id);


            return view('material-clothing-delivery.create', compact( 'clothing_assignment', 'materials', 'clothing_deliveries', 'student'));
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'additionalNotes' => 'nullable|string',
                'selectedClothing' => 'required|array',
                'selectedClothing.*' => 'integer|exists:materials,id',
                'quantities' => 'required|array',
                'quantities.*' => 'integer|min:1',
            ]);

            $clothingDelivery = new Clothing_Delivery;
            $clothingDelivery->user_id = $validatedData['user_id'];
            $clothingDelivery->additionalNotes = $validatedData['additionalNotes'];
            $clothingDelivery->save();

            foreach ($validatedData['selectedClothing'] as $index => $materialId) {
                $materialClothingDelivery = new Material_Clothing_Delivery;
                $materialClothingDelivery->clothing_delivery_id = $clothingDelivery->id;
                $materialClothingDelivery->material_id = $materialId;
                $materialClothingDelivery->quantity = $validatedData['quantities'][$index];
                $materialClothingDelivery->save();
            }
        return redirect()->route('clothing.index')->with('success', 'Material inserido com sucesso!');
        }

        public function show(Material_Clothing_Delivery $material_Clothing_Delivery)
        {
            //
        }

        public function edit(Material_Clothing_Delivery $material_Clothing_Delivery)
        {
            //
        }

        public function update(Request $request, Material_Clothing_Delivery $material_Clothing_Delivery)
        {
            //
        }

        public function destroy(Material_Clothing_Delivery $material_Clothing_Delivery)
        {
            //
        }
    }
