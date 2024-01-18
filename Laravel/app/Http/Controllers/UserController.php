<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\CourseClass;
use App\Course;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $positionFilter = $request->input('positionFilter');
//        $nameFilter = $request->input('nameFilter');
        $courseClasses = CourseClass::all();
        $roles = Role::all();

        $query = User::with('CourseClass');



//        if ($positionFilter) {
//            $query->where('role_id', $positionFilter);
//            $users = $query->paginate(5);
//        } elseif ($nameFilter) {
//            $query->where(function ($query) use ($nameFilter) {
//                $query->where('name', 'like', $nameFilter . '%');
//                $users = $query->paginate(5);
//            });
//        } else {
//
//        }

        $users = $query->paginate(5);


//        if ($request->ajax()) {
//            return view('users.partials.user_table', compact('users', 'courseClasses',  'roles'));
//        }

        return view('users.index', compact('users', 'courseClasses', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseClasses = CourseClass::all();
        $courses = Course::all();
        $roles = Role::all();

        return view('users.create', compact('courseClasses', 'courses', 'roles'));
    }


    public function store(Request $request)
    {


        $isStudent = $request->input('role_id') == 3 ? 1 : 0;
        $request->merge(['isStudent' => $isStudent]);

//SOLID



        try {
            $request->validate([
                'name' => 'required|string|min:5|max:255',
                'username' => 'required|string|min:5|max:20',
                'email' => [
                    'required',
                    'email',
                ],
                'contact' => 'required|min:9|max:20',
                'password' => [
                    $request->input('password') != null ? 'required' : 'nullable',
                    'string',
                    'min:7',
                    'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
                ],

                'isStudent' => 'required',
                'isActive' => 'required',
                'course_class_id' => 'nullable',
                'role_id' => 'required',
            ]);





            $userData = $request->only(['name', 'username', 'email', 'contact', 'password', 'isStudent', 'isActive', 'course_class_id', 'role_id']);
            $userData['password'] = $this->encryptPassword($userData['password']);


            $user = User::create($userData);

            return redirect()->route('users.show', $user->id)->with('success', 'Utilizador criado com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar o utilizador. Por favor, tente novamente.');
        }
    }


    public function show(User $user)
    {
        $courseClasses = CourseClass::with('Course')->get();
        $roles = Role::all();



        if ($user->isStudent == 1) {
            $user->load('courseClass', 'role');
            $courseDescription = $user->courseClass ? $user->courseClass->course->description : null;

        } else {
            $user->load('role');
            $courseDescription = null;
        }

//        dd($courseDescription);
        return view('users.show', compact('user', 'courseClasses', 'courseDescription', 'roles'));
    }



    public function edit(User $user)
    {
        $courseClasses = CourseClass::all();
        $courses = Course::all();
        $roles = Role::all();
        $user->load('CourseClass.Course', 'Role');

        return view('users.edit', compact('user', 'courseClasses', 'courses', 'roles'));
    }


    public function update(Request $request, User $user)
    {


        if($request->input('role_id') == 3) {
            $request['isStudent'] = 1;
        }else {
            $request['isStudent'] = 0;
        }

//
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'username' => 'required|string|min:5|max:20',
            'email' => 'required',
            'contact' => 'required|min:9|max:20',
            'password' => [
                $request->input('password') != null ? 'required' : 'nullable',
                'string',
                'min:7',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
            ],
            'role_id' => 'required',
            'course_class_id' => 'nullable',
            'isActive' => 'required',
            'isStudent' => 'required',
        ]);





        if ($request->has('password')) {
            $user->password = $this->encryptPassword($request['password']);
            $user->update($request->only(['name', 'username', 'email', 'contact', 'isActive', 'role_id', 'isStudent', 'course_class_id', 'password']));
        } else {
            $user->update($request->only(['name', 'username', 'email', 'contact', 'isActive', 'role_id', 'isStudent', 'course_class_id']));
        }

        return redirect()->route('users.index')->with('success', 'Utilizador atualizado com sucesso!');
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Utilizador excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Erro ao excluir o utilizador. Por favor, tente novamente.');
        }
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',//all items inside array must exist
        ]);

        try {

            User::whereIn('id', $request->input('user_ids'))->delete();
            return redirect()->back()->with('success', 'Utilizadores selecionados excluídos com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Erro ao excluir utilizadores selecionados. Por favor, tente novamente.');
        }
    }

    private function encryptPassword($password)
    {
        return bcrypt($password);
    }

//    private function setIsStudent(Request $request)
//    {
//        return $request->input('position') === 'formando' ? 1 : 0;
//    }
}
