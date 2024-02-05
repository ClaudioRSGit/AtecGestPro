@extends('master.main')

@section('content')
    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger error-alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('password') && old('role_id') != 3 && $user->role_id == 3)
            <div class="alert alert-danger error-alert">
                {{ $errors->first('password') }}
            </div>
        @endif

        <h1>Editar Utilizador</h1>

        <form method="post" action="{{ route('users.update', $user->id) }}" id="userForm">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Utilizador:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name }}">

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username }}">

                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $user->email }}">

                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contacto:</label>
                        <input type="text" class="form-control" id="contact" name="contact"
                            value="{{ $user->contact }}">

                        @error('contact')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="{{ $user->password ? 'Não altere para manter a password existente' : '' }}">

                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>




                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Função:</label>
                            <select class="form-control" id="role_id" name="role_id" onchange="toggleCourseClassDiv()">


                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->role->description == $role->description ? 'selected' : '' }}>
                                        {{ $role->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="isStudent" id="isStudent" value="{{ old('role_id') == 3 ? 1 : 0 }}">



                        <div class="mb-3" id="labelCourseClass">
                            <label for="course_class_id" class="form-label">Turma:</label>
                            <select class="form-control" id="course_class_id" name="course_class_id">
                                @foreach ($courseClasses as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('course_class_id', $user->course_class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="isActive" class="form-label">Estado:</label>
                            <select class="form-control" id="isActive" name="isActive">
                                <option value="1" {{ $user->isActive == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ $user->isActive == 0 ? 'selected' : '' }}>Desativado</option>
                            </select>
                        </div>

                        <div class="mb-3" id="labelCourseClass">
                            <div class="mb-3" id="notes">
                                <label for="notes" class="form-label">Notas:</label>
                                <textarea class="form-control" id="notes" name="notes">{{ $user->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="buttons d-flex justify-content-start align-items-center pt-3">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" form="deleteForm" class="btn btn-danger">Excluir</button>
                    </div>
            </div>
        </form>
    </div>

    <form id="deleteForm" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
    </form>


    <style>
        .buttons {
            width: 100%;
            gap: 1rem;
        }
    </style>



    <script>
        function toggleCourseClassDiv() {
            const selectedRole = $("#role_id").val();
            const isStudentValue = selectedRole === "3" ? 1 : 0;

            $("#isStudent").val(isStudentValue);

            if (selectedRole === "3") {
                $("#labelCourseClass").show();
                $("#password").closest(".mb-3").hide();
            } else {
                $("#labelCourseClass").hide();
                $("#password").closest(".mb-3").show();
            }
        }

        function updateCourseDescription(select) {}

        $(document).ready(function() {
            toggleCourseClassDiv();
        });

        window.setTimeout(function() {
            $(".error-alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
@endsection
