<?php

namespace App\Http\Controllers;

use App\MaterialUser;
use Illuminate\Http\Request;
use App\Course;
use App\CourseClass;
use App\User;
use App\Material;


class MaterialUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseClasses = CourseClass::with('students')->paginate(5);
        $courses = Course::all();
        $nonDocents = User::all()->where('isStudent', false)->where('position', '!=', 'formando');
        return view('material-user.index', compact('courseClasses', 'courses', 'nonDocents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $clothing_assignment = Material::with('sizes')
        ->where('isClothing', 1)
        ->whereHas('courses')
        ->get();
        $materials = Material::all();
        //$clothing_deliveries = Clothing_Delivery::all();

        $student = User::find($id);


        return view('material-user.create', compact( 'clothing_assignment', 'materials', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'selectedClothing' => 'required|array',
            'user_id' => 'required',
            'quantity' => 'required|array',
            'size_id' => 'required|array',
            'delivery_date' => 'required',
            'delivered_all' => 'required',
        ]);

        foreach ($request->get('selectedClothing') as $index => $material_id) {
            $indices[] = $index;
            $materialUser = new MaterialUser([
                'material_id' => $material_id,
                'user_id' => $request->get('user_id'),
                'quantity' => $request->get('quantity')[$index],
                'size_id' => $request->get('size_id')[$index],
                'delivery_date' => $request->get('delivery_date'),
                'delivered_all' => $request->get('delivered_all'),
            ]);

            //dd($materialUser);
            //dd($request->get('size_id'));
            $materialUser->save();
        }

        dd($indices);
        return redirect()->route('material-user.index')->with('success', 'Material entregue com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialUser  $materialUser
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialUser $materialUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialUser  $materialUser
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialUser $materialUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialUser  $materialUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialUser $materialUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialUser  $materialUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialUser $materialUser)
    {
        //
    }
}
