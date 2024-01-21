<?php

namespace App\Http\Controllers;

use App\MaterialSize;
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
        $student = User::find($id);
        $studentCourseId = $student->courseClass->course_id;

        $clothes = Material::with('sizes', 'courses')
            ->where('isClothing', 1)
            ->whereHas('courses', function ($query) use ($studentCourseId) {
                $query->where('courses.id', $studentCourseId);
            })
            ->get();

        return view('material-user.create', compact('clothes', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'selectedClothing' => 'required|array',
            'user_id' => 'required',
            'quantity' => 'required|array',
            'material_size_id' => 'required|array',
            'delivery_date' => 'required|array',
            'delivered_all' => 'required',
        ]);

        $selectedClothingitems = $request->get('selectedClothing');
        $note = $request->get('additionalNotes');

        foreach ($selectedClothingitems as $index => $selectedClothingitem) {

            $itemSize = $request->get('material_size_id')[$index];
            $itemQuantity = $request->get('quantity')[$index];
            $itemDeliveryDate = $request->get('delivery_date')[$index];
            $materialUser = new MaterialUser([
                'material_id' => $selectedClothingitem,
                'user_id' => $request->get('user_id'),
                'quantity' => $itemQuantity,
                'size_id' => $itemSize,
                'delivery_date' => $itemDeliveryDate,
                'delivered_all' => $request->get('delivered_all'),
            ]);


            $materialUser->save();

            $materialSize = MaterialSize::where('material_id', $selectedClothingitem)
                ->where('size_id', $itemSize)
                ->first();

            if ($materialSize) {
                $newStock = $materialSize->stock - $itemQuantity;
                $materialSize->stock = $newStock;
                $materialSize->save();
            }

            if ($note) {
                $student = User::find($request->get('user_id'));
                $existingNotes = $student->notes;
                $newNote = $note;
                $timestamp = now()->toDateTimeString();

                $student->notes = $existingNotes . "\n" . $timestamp . ": " . $newNote;
                $student->save();
            }

        }

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
