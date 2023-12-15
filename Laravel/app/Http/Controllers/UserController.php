<?php

namespace App\Http\Controllers;

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
        $roleFilter = $request->input('roleFilter');
        $nameFilter = $request->input('nameFilter');

        $query = User::query();

        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        if ($nameFilter) {
            $query->where(function ($query) use ($nameFilter) {
                $query->where('name', 'like', $nameFilter . '%');
            });
        }

        $users = $query->get();

        if ($request->ajax()) {
            return view('users.partials.user_table', compact('users'));
        }

        return view('users.index', compact('users'));
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

        return view('users.create', compact('courseClasses', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:20',
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
                'role' => 'required',
                'isActive' => 'required',
                'isStudent' => 'nullable',
            ]);

            $request['isStudent'] = $this->setIsStudent($request);
            $request['password'] = $this->encryptPassword($request['password']);
            $user = User::create($request->all());

            return redirect()->route('users.show', $user->id)->with('success', 'Utilizador inserido com sucesso!');
            }
            catch (\Exception $e) {

                return redirect()->back()->with('error', 'Erro ao inserir o utilizador. Por favor, tente novamente.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $courseClasses = CourseClass::all();
        $courses = Course::all();

        return view('users.show', compact('user', 'courseClasses', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20',
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
            'role' => 'required',
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
     * @param  \App\User  $user
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

    private function encryptPassword($password)
    {
        return bcrypt($password);
    }

    private function setIsStudent(Request $request)
    {
        return $request->input('role') === 'formando' ? 1 : 0;
    }
}
