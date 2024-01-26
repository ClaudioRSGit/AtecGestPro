<?php

namespace App\Http\Controllers;

use App\MaterialSize;
use App\MaterialUser;
use Illuminate\Http\Request;
use App\Course;
use App\CourseClass;
use App\User;
use App\Material;
use App\Role;


class MaterialUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $courseFilter = request()->query('courseFilter');
        $searchCourseClass = request()->query('searchCourseClass');
        $searchNonDocent = request()->query('searchNonDocent');
        $roleFilter = request()->query('roleFilter');
        $usersWithMaterialsDelivered = User::whereHas('materialUsers', function ($query) {
            $query->where('delivered_all', true);
        })->get();


        $query = CourseClass::with('students');
        $queryNonDocent = User::where('isStudent', false);

        if ($courseFilter) {
            $query = $query->where('course_id', $courseFilter);
        }

        if ($searchCourseClass) {
            $query = $query->where('description', 'like', '%' . $searchCourseClass . '%');
        }

        if($searchNonDocent){
            $queryNonDocent = User::where('isStudent', false)->where('name', 'like', '%' . $searchNonDocent . '%')->paginate(5);
        } else {
            $queryNonDocent = User::all()->where('isStudent', false)->where('isStudent', false);
        }

        if ($roleFilter) {
            $queryNonDocent = $queryNonDocent->where('role_id', $roleFilter);
        }

        $nonDocents = $queryNonDocent;

        $courseClasses = $query->paginate(5);
        $roles = Role::Where('name', '!=', 'formando')->get();

        $courses = Course::all();
        return view('material-user.index', compact('courseClasses', 'courses', 'roles', 'nonDocents', 'courseFilter', 'searchCourseClass','usersWithMaterialsDelivered'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find($id);
        $assignedClothes = MaterialUser::with('material', 'user')->where('user_id', $id)->get();

        if($user->isStudent==1){
            $student = $user;
            $studentCourseId = $student->courseClass->course_id;

            $clothes = Material::with('sizes', 'courses')
                ->where('isClothing', 1)
                ->whereHas('courses', function ($query) use ($studentCourseId) {
                    $query->where('courses.id', $studentCourseId);
                })
                ->paginate(5);
        } else
        {
            $student = $user;

            $clothes = Material::with('sizes', 'courses')
                ->where('isClothing', 1)
                ->doesntHave('courses')
                ->paginate(5);
        }



        return view('material-user.create', compact('clothes', 'student', 'assignedClothes'));
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
//                'delivered_all' => $request->get('delivered_all'),
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

            $allDeliveries = MaterialUser::where('user_id', $request->get('user_id'))->get();

            $allDeliveries->each(function ($item, $key) {
                if($item->delivered_all == 0){
                    $item->delivered_all = 1;
                    $item->save();
                }elseif ($item->delivered_all == 1){
                    $item->delivered_all = 0;
                    $item->save();
                }
            });

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
    public function edit($id)
    {
        $materialUsers = MaterialUser::with('material', 'user')->where('user_id', $id)->get();//        dd($materialUsers);
        $user = User::find($id);



        return view('material-user.edit', compact('materialUsers', 'user'));
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

        $materialUser->delete();
        return back()->with('success', 'Material removido com sucesso!');
    }

    public function massDelete(Request $request)
    {
        $materialIds = $request->input('material_ids');

        if (is_array($materialIds) && count($materialIds) > 0) {
            MaterialUser::whereIn('id', $materialIds)->delete();
            return back()->with('success', 'Materiais removidos com sucesso!');
        }

        return back()->with('error', 'Nenhum material selecionado para exclusão.');
    }

}
