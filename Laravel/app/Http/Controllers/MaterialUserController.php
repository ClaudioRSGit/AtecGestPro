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
use App\Http\Requests\MaterialUserRequest;


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
            $queryNonDocent = $queryNonDocent->where('name', '!=', 'Fila de Espera')->where('name', '!=', 'Utilizador Padrao')->where('name', 'like', '%' . $searchNonDocent . '%');
        } else {
            $queryNonDocent = $queryNonDocent->where('name', '!=', 'Fila de Espera')->where('name', '!=', 'Utilizador Padrao')->where('isStudent', false);
        }
        if ($roleFilter) {
            $queryNonDocent = $queryNonDocent->where('role_id', $roleFilter);
        }


        $nonDocents = $queryNonDocent->paginate(5, ['*'], 'nPage')->withQueryString();

        $courseClasses = $query->paginate(5, ['*'], 'cPage')->withQueryString();

        $roles = Role::Where('name', '!=', 'formando')->get();

        $courses = Course::all();

        return view('material-user.index', compact('courseClasses', 'courses', 'roles', 'nonDocents', 'courseFilter', 'searchCourseClass', 'usersWithMaterialsDelivered'));
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

        if ($user->isStudent == 1 && $user->courseClass) {
            $student = $user;
            $studentCourseId = $student->courseClass->course_id;
            $course = $student->courseClass->course->description;

            $clothes = Material::with('sizes', 'courses')
                ->where('isClothing', 1)
                ->whereHas('courses', function ($query) use ($studentCourseId) {
                    $query->where('courses.id', $studentCourseId);
                })
                ->get();
        } else {
            $student = $user;
            $course = "Funcionário";
            $clothes = Material::with('sizes', 'courses')
                ->where('isClothing', 1)
                ->doesntHave('courses')
                ->get();
        }


        return view('material-user.create', compact('clothes', 'student', 'assignedClothes', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialUserRequest $request)
    {
        try {
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

                $allDeliveries = MaterialUser::where('user_id', $request->get('user_id'))->get();

                $deliveredAllValue = $request->delivered_all;

                $allDeliveries->each(function ($item, $key) use ($deliveredAllValue) {
                    $item->delivered_all = $deliveredAllValue;
                    $item->save();
                });
            }

            return redirect()->route('material-user.index')->with('success', 'Material entregue com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao entregar o material. Por favor, tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\MaterialUser $materialUser
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialUser $materialUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\MaterialUser $materialUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $materialUsers = MaterialUser::with('material', 'user')->where('user_id', $id)->get();
        $user = User::find($id);


        return view('material-user.edit', compact('materialUsers', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\MaterialUser $materialUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialUser $materialUser)
    {

        try {
            $user_id = $request->get('user_id');
            $user = User::find($user_id);
            $note = $request->get('note');

            $user->notes = $note;
            $user->save();

            return redirect()->route('material-user.edit', $user_id)->with('success', 'Notas do utilizador gravada com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao gravar a nota. Por favor, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\MaterialUser $materialUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialUser $materialUser)
    {
        try {
            $materialUser->delete();
            return back()->with('success', 'Material removido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover o material. Por favor, tente novamente.');
        }
    }

    public function massDelete(Request $request)
    {
        $materialIds = $request->input('material_ids');

        if (is_array($materialIds) && count($materialIds) > 0) {
            try {
                MaterialUser::whereIn('id', $materialIds)->delete();
                return back()->with('success', 'Materiais removidos com sucesso!');
            } catch (\Exception $e) {
                return back()->with('error', 'Erro ao remover os materiais selecionados. Por favor, tente novamente.');
            }
        }

        return back()->with('error', 'Nenhum material selecionado para exclusão.');
    }

    public function addNote(Request $request)
    {
        $user_id = $request->get('user_id');
        $note = $request->get('note');
        $user = User::find($user_id);
        $existingNotes = $user->notes;
        $newNote = $note;
        $timestamp = now()->toDateTimeString();
        $user->notes = $existingNotes . "\n" . $timestamp . ": " . $newNote;
        $user->save();


//        return view('material-user.edit', compact()->with('success', 'Nota adicionada com sucesso!');
        return redirect()->route('material-user.edit', $user_id)->with('success', 'Nota adicionada com sucesso!');
//        return redirect()->back()->with('success', 'Nota adicionada com sucesso!');
    }

    public function addDeliveredAll(Request $request)
    {

        $user_id = $request->get('user_id');

        $allDeliveries = MaterialUser::where('user_id', $user_id)->get();


            foreach ($allDeliveries as $delivery) {
                $delivery->delivered_all = 1;
                $delivery->save();
            }

        return redirect()->route('material-user.edit', $user_id)->with('success', 'Entrega marcada como comleta com sucesso!');
    }

    public function addDeliveredPartial(Request $request)
    {

        $user_id = $request->get('user_id');

        $allDeliveries = MaterialUser::where('user_id', $user_id)->get();

        foreach ($allDeliveries as $delivery) {
            $delivery->delivered_all = 0;
            $delivery->save();
        }


        return redirect()->route('material-user.edit', $user_id)->with('success', 'Entrega marcada como parcial marcada com sucesso!');
    }



}
