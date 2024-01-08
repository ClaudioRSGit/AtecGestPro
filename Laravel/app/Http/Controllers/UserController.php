<?php

namespace App\Http\Controllers;

use App\Role;
use App\Role_User;
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
        $positionFilter = $request->input('positionFilter');
        $nameFilter = $request->input('nameFilter');

        $query = User::query();

        if ($positionFilter) {
            $query->where('position', $positionFilter);
        }

        if ($nameFilter) {
            $query->where(function ($query) use ($nameFilter) {
                $query->where('name', 'like', $nameFilter . '%');
            });
        }

        $users = $query->paginate(5);
        $roles = Role::all();

        if ($request->ajax()) {
            return view('users.partials.user_table', compact('users', 'roles'));
        }

        return view('users.index', compact('users', 'roles'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $role = $request->input('roleFilter');


        if ($role == "formando") {
            $request['isStudent'] = 1;
            $role_id = 3;
        } else {
            $request['isStudent'] = 0;
        }

        if ($role == "admin") {
            $role_id = 1;
        } else if ($role == "administrador") {
            $role_id = 1;
        } else if ($role == "user") {
            $role_id = 2;
        } else if ($role == "tecnico") {
            $role_id = 4;
        } else if ($role == "funcionario") {
            $role_id = 5;
        }

//        dd($request);
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
                    'nullable',
                    'string',
                    'min:7',
                    'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
                ],
                'isStudent' => 'required',
                'isActive' => 'required',
            ]);




            $userData = $request->only(['name', 'username', 'email', 'contact', 'password', 'isStudent', 'isActive']);
            $userData['password'] = $this->encryptPassword($userData['password']);


            $user = User::create($userData);


            $role_user = Role_User::create([
                'role_id' => $role_id,
                'user_id' => $user->id,
            ]);



            return redirect()->route('users.show', $user->id)->with('success', 'Utilizador criado com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $courseClasses = CourseClass::all();

        if ($user->isStudent && $user->CourseClass) {
            $user->load('CourseClass.Course');
            $courseDescription = $user->CourseClass->course->description;
        } else {
            $courseDescription = null;
        }

        return view('users.show', compact('user', 'courseClasses', 'courseDescription'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $courseClasses = CourseClass::all();
        $courses = Course::all();

        return view('users.edit', compact('user', 'courseClasses', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'username' => 'required|string|min:5|max:20',
            'email' => [
                'required',
                'email',
            ],
            'contact' => 'required|min:9|max:20',
            'password' => [
                'nullable',
                'string',
                'min:7',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
            ],
            'position' => 'required',
            'isActive' => 'required',
            'isStudent' => 'nullable',
        ]);

        $request['isStudent'] = $this->setIsStudent($request);
        $user->update($request->except('password'));

        if ($request->has('password')) {
            $user->password = $this->encryptPassword($request['password']);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'Utilizador atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
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

    private function setIsStudent(Request $request)
    {
        return $request->input('position') === 'formando' ? 1 : 0;
    }
}
