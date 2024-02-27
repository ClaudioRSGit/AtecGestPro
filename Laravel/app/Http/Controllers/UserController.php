<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\CourseClass;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\TicketUser;
use App\Ticket;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $searchName = $request->input('searchName');
        $roleFilter = $request->input('roleFilter');
        $sortColumn = $request->input('sortColumn', 'name');
        $sortDirection = $request->input('sortDirection', 'asc');

        $query = User::with('courseClass', 'role')->where('name', '!=', 'Fila de Espera')->where('name', '!=', 'Utilizador Padrao');

        if ($roleFilter && $roleFilter !== 'all') {
            $query->whereHas('role', function ($roleQuery) use ($roleFilter) {
                $roleQuery->where('id', $roleFilter);
            });
        }

        if ($searchName) {
            $query->where('name', 'like', "%$searchName%");
        }

        $users = $query->orderBy($sortColumn, $sortDirection)->paginate(5, ['*'], 'uPage')->withQueryString();
        $deletedUsers = User::onlyTrashed()->paginate(5, ['*'], 'dPage')->withQueryString();

        $courseClasses = CourseClass::all();
        $roles = Role::all();

        return view('users.index', compact('users', 'courseClasses', 'roles', 'roleFilter', 'sortColumn', 'sortDirection', 'searchName', 'deletedUsers'));
    }

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

        if ($isStudent != 1) {
            $request->merge(['course_class_id' => null]);
        }

        try {

            if (auth()->user()->hasRole('tecnico') && $request->input('role_id') == 1) {
                return redirect()->back()->with('error', 'Não é possível criar um novo administrador!');
            }

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

        return view('users.show', compact('user', 'courseClasses', 'courseDescription', 'roles'));
    }



    public function edit(User $user)
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->hasRole('funcionario') || $authenticatedUser->hasRole('tecnico')) {
            if ($authenticatedUser->id === $user->id) {
                $courseClasses = CourseClass::all();
                $courses = Course::all();
                $roles = Role::all();
                $user->load('CourseClass.Course', 'Role');

                return view('users.edit', compact('user', 'courseClasses', 'courses', 'roles'));
            }
        } else {
            if ($user->id !== 1 && $user->id !== 2) {
                $courseClasses = CourseClass::all();
                $courses = Course::all();
                $roles = Role::all();
                $user->load('CourseClass.Course', 'Role');

                return view('users.edit', compact('user', 'courseClasses', 'courses', 'roles'));
            }
        }

        return abort(403, 'Acesso não autorizado!');
    }


    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            if ($user->role_id == 3 && $request->input('role_id') != 3 && !$request->filled('password')) {
                return redirect()->back()->with('error', 'Password obrigatória ao alterar de Formando para outra função.');
            }

            if ($user->role_id != 3 && !$request->filled('password')) {
                unset($data['password']);
            }

            if ($user->role_id != 3 && $request->input('role_id') == 3) {
                $data['password'] = null;
            }

            if ($request->input('isStudent') != 1) {
                $data['course_class_id'] = null;
            }

            if ($request->filled('password') && $request->input('role_id') != 3) {
                $data['password'] = $this->encryptPassword($request->input('password'));
            }

            if (auth()->user()->hasRole('admin')) {
                if ($user->hasRole('admin') && $request->input('role_id') != 1) {
                    return redirect()->back()->with('error', 'O administrador não pode alterar a sua própria função!');
                }
            }
            if ($user->id == auth()->user()->id && $request->input('isActive') == 0) {
                return redirect()->back()->with('error', 'Não é possível desativar a sua própria conta!');
            }

            $user->update($data);

            if ($user->hasRole('funcionario')) {
                return redirect()->route('master.main')->with('success', 'Utilizador atualizado com sucesso!');
            } elseif (auth()->user()->role_id == 1 && $request->input('role_id') == 2) {
                return redirect()->route('master.main')->with('success', 'Utilizador atualizado com sucesso!');
            } else {
                return redirect()->route('users.index')->with('success', 'Utilizador atualizado com sucesso!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o utilizador.Por favor tente novamente!');
        }
    }

    private function canDeleteUser($loggedInUser, $user)
    {
        if ($loggedInUser->hasRole('tecnico')) {
            if ($user->hasRole('admin') || $user->id == $loggedInUser->id) {
                return false;
            }
        }

        if ($loggedInUser->hasRole('admin')) {
            if ($user->hasRole('admin') && $user->id == $loggedInUser->id) {
                return false;
            }
        }

        return true;
    }

    public function destroy(User $user)
    {
        $loggedInUser = auth()->user();
        $waitingQueueUserId = 1;
        $anonymousRequesterUserId = 2;

        $technicianTickets = TicketUser::where('user_id', $user->id)->get();
        $userTickets = Ticket::where('user_id', $user->id)->get();


        if (!$this->canDeleteUser($loggedInUser, $user)) {
            return redirect()->back()->with('error', 'Não é permitido excluir este utilizador!');
        }

        try {
            foreach ($technicianTickets as $technician) {
                $technician->update(['user_id' => $waitingQueueUserId]);
            }
            foreach ($userTickets as $newRequester) {
                $newRequester->update(['user_id' => $anonymousRequesterUserId]);
            }

            $user->delete();
            return redirect()->route('users.index')->with('success', 'Utilizador excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Erro ao excluir o utilizador. Por favor, tente novamente.');
        }
    }

    public function massDelete(Request $request)
    {
        $loggedInUser = auth()->user();
        $waitingQueueUserId = 1;
        $anonymousRequesterUserId = 2;

        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        try {
            foreach ($request->input('user_ids') as $userId) {
                $user = User::findOrFail($userId);

                $technicianTickets = TicketUser::where('user_id', $user->id)->get();
                $userTickets = Ticket::where('user_id', $user->id)->get();
                foreach ($technicianTickets as $ticket) {
                    $ticket->update(['user_id' => $waitingQueueUserId]);
                }
                foreach ($userTickets as $newRequester) {
                    $newRequester->update(['user_id' => $anonymousRequesterUserId]);
                }

                if (!$this->canDeleteUser($loggedInUser, $user)) {
                    return redirect()->back()->with('error', 'Não é permitido excluir um dos utilizadores selecionados!');
                }
            }

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

    public function restore($id)
    {
        try {
            $user = User::withTrashed()->find($id);
            $user->restore();

            return redirect()->back()->with('success', 'Utilizador restaurado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao restaurar o utilizador. Por favor, tente novamente.');
        }
    }

    public function forceDelete($id)
    {
        try {
            $user = User::withTrashed()->find($id);
            $user->forceDelete();

            return redirect()->back()->with('success', 'O utilizador foi removido permanentemente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao remover permanentemente o utilizador. Por favor, tente novamente.');
        }
    }
}
