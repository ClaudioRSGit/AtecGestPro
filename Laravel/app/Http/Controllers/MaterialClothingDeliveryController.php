<?php

namespace App\Http\Controllers;

use App\Material_Clothing_Delivery;
use Illuminate\Http\Request;
use App\Material;
use App\User;
use App\Clothing_Delivery;
use App\MaterialClothingDelivery;

//ficar de olho
use App\Material_clothes;
use Illuminate\Support\Facades\DB;

class MaterialClothingDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $student = User::with('CourseClass')->find($id);

//        dd($student->CourseClass->course_id);

        if ($student->CourseClass->course_id == 5) {
            $clothes = Material::where('name', "Bata")->get();
        } elseif ($student->CourseClass->course_id ==4){
            $clothes = Material::where('name', 'like', '%Botas%')->get();

        } else {
            $clothes = Material::where('isClothing', 1)->get();
        }



        //$clothes = Material::where('isClothing', 1)->get();

        $clothing_deliveries = Clothing_Delivery::all();




        return view('material-clothing-delivery.create', compact('clothes',  'clothing_deliveries', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


//        selectedClothing
        //user_id
        //additionalNotes
        //selectedClothing
        //gender
        //size
        //quantity


        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'additionalNotes' => 'nullable|string',
            'selectedClothing' => 'required|array',
            'selectedClothing.*' => 'required|string',
            'size' => 'required|array',
            'size.*' => 'string',
            'quantity' => 'required|array',
            'quantity.*' => 'integer',
            'gender' => 'required|string'
        ]);

      //  dd($request->input('quantity'));

        $clothingDelivery = new Clothing_Delivery;
        $clothingDelivery->user_id = $validatedData['user_id'];
        $clothingDelivery->additionalNotes = $validatedData['additionalNotes'];
        $clothingDelivery->save();

        foreach ($validatedData['selectedClothing'] as $materialId) {

            foreach ($validatedData['selectedClothing'] as $materialName) {

                $size = $validatedData['size'][$materialName];
                $quantity = $validatedData['quantity'][$materialName];

                if ($validatedData['gender'] == "male") {
                    $gender = 0;
                } else {
                    $gender = 1;
                }

                //         dd($gender);
                $material = Material::where('name', $materialName)
                    ->where('size', $size)
                    ->where(function ($query) use ($gender) {
                        $query->where('gender', $gender)
                            ->orWhereNull('gender');
                    })
                    ->first();



               // dd($quantity);
                if ($material) {
                   // dd($material->id);
                    $materialClothingDelivery = new Material_Clothing_Delivery;
                    $materialClothingDelivery->quantity = $quantity;
                    $materialClothingDelivery->clothing_delivery_id = $clothingDelivery->id;
                    $materialClothingDelivery->material_id = $material->id;
                    $materialClothingDelivery->save();
                    $material->quantity = $material->quantity - $quantity;
                    $material->save();
                } else {

                    dd("Material not found: " . $materialName);
                }
            }

        }


        return redirect()->route('clothing.index')->with('success', 'Material inserido com sucesso!');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Material_Clothing_Delivery $material_Clothing_Delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Material_Clothing_Delivery $material_Clothing_Delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Material_Clothing_Delivery $material_Clothing_Delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Material_Clothing_Delivery $material_Clothing_Delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Material_Clothing_Delivery $material_Clothing_Delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material_Clothing_Delivery $material_Clothing_Delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Material_Clothing_Delivery $material_Clothing_Delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material_Clothing_Delivery $material_Clothing_Delivery)
    {
        //
    }
}
