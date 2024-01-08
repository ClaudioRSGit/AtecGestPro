@extends('master.main')

@section('content')
    <div class="container">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Criar Novo Utilizador</h1>

        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" id="userForm">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Utilizador:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">

                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">

                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contacto:</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}">

                        @error('contact')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{ old('password') }}">

                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 d-flex flex-column">
                    <div class="mb-3">
                        <label for="roleFilter" class="form-label">Função:</label>
                        <select class="form-control" id="roleFilter" name="roleFilter" onchange="toggleCourseClassDiv()">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('roleFilter') == $role->name ? 'selected' : '' }}>
                                    {{ $role->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3" id="labelCourseClass" style="display: none;">
                        <label for="course_class_id" class="form-label">Turma:</label>
                        <select class="form-select" id="course_class_id" name="course_class_id" onchange="updateCourseDescription(this)">
                            @foreach($courseClasses as $class)
                                <option value="{{ $class->id }}" data-course-description="{{ $class->course->description }}">{{ $class->description }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="isActive" class="form-label">Estado:</label>
                        <select class="form-select" id="isActive" name="isActive">
                            <option value="1">Ativo</option>
                            <option value="0">Desativado</option>
                        </select>
                    </div>
                </div>


                <div class="buttons">
                    <button type="submit" class="btn btn-primary">Criar Utilizador</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleCourseClassDiv() {
            var selectedRole = $("#roleFilter").val();
            if (selectedRole === "formando") {
                $("#labelCourseClass").show();
            } else {
                $("#labelCourseClass").hide();
            }
        }

        function updateCourseDescription(select) {
        }
    </script>


@endsection
