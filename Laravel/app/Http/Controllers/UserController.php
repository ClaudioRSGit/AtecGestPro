<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\CourseClass;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

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


    public function store(UserRequest  $request)
    {
        $isStudent = $request->input('role_id') == 3 ? 1 : 0;
        $request->merge(['isStudent' => $isStudent]);

        try {

            $password = $request->input('password');
            $userData = $request->only(['name', 'username', 'email', 'contact', 'isStudent', 'isActive', 'course_class_id', 'role_id']);

            if (!$isStudent && $password !== null) {
                $userData['password'] = $this->encryptPassword($password);
            }
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


    public function update(UserRequest  $request, User $user)
    {
        $data = $request->validated();

        if ($request->filled('password') && $request->input('role_id') != 3) {
            $data['password'] = $this->encryptPassword($request->input('password'));
        } else {
            unset($data['password']);
        }

        $user->update($data);

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
            'user_ids.*' => 'exists:users,id', //all items inside array must exist
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
