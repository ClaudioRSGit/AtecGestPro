@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4 position-relative">
            <h1>Cursos</h1>
            <a href="{{ route('courses.create') }}" class="btn btn-primary newCourse">
                <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i> Novo Curso
            </a>
            <img src="{{ asset('assets/questionMark.png') }}" onclick="event.stopPropagation(); triggerCoursesIntro();"
                 class="questionMarkBtn">
        </div>

        <div class="d-flex justify-content-between mb-3">


            <form action="{{ route('courses.index') }}" method="get" class="form-inline" id="filterForm">
                <div class="input-group pr-2">
                    <div class="search-container">
                        <input type="text" class="form-control" id="courseSearch" name="courseSearch"
                               value="{{ request('courseSearch') }}" placeholder="Pesquisar curso...">
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">
                            Procurar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <table class="table" id="courseTable">
            <thead style="width: 100%">
            <tr>

                <th>
                    <a href="{{ route('courses.index', ['sortColumn' => 'code', 'sortDirection' => $sortColumn === 'code' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">Código
                        @if ($sortDirection === 'desc' && $sortColumn === 'code')
                        <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                        @else
                        <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('courses.index', ['sortColumn' => 'description', 'sortDirection' => $sortColumn === 'description' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">Descrição
                        @if ($sortDirection === 'desc' && $sortColumn === 'description')
                        <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                        @else
                        <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                        @endif
                    </a>
                </th>
                <th class="fill"></th>
            </tr>
            </thead>
            <tbody>
            <tr class="filler"></tr>
            @foreach ($courses as $course)
                <tr class="courses-row customTableStyling" style="width: 100%">

                    <td class="clickable" style="width: 10%">
                        <a href="{{ route('courses.show', $course->id) }}"
                           class="d-flex align-items-center w-auto h-100">{{ $course->code }}</a>
                    </td>
                    <td class="clickable mobileOverflow" style="width: 85%">
                        <a href="{{ route('courses.show', $course->id) }}"
                            class="d-flex align-items-center w-auto h-100">{{ $course->description }}</a>
                    </td>
                    <td class="editDelete" style="min-width: 7rem;">
                        <div style="width: 40%">
                            <a href="{{ route('courses.edit', $course->id) }}" class="mx-2">
                                <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                            </a>
                        </div>
                        <div style="width: 40%">
                            <form method="post" action="{{ route('courses.destroy', $course->id) }}"
                                  style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" id="modal"
                                        data-message="Tem a certeza que deseja eliminar o curso {{ $course->description }}?"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                        <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="filler"></tr>
            @endforeach
            </tbody>
        </table>
        {{ $courses->links() }}

        {{--    confirmation modal    --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="deleteBtn">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        {{--    confirmation modal    --}}
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/courses/index.js') }}"></script>
    <script src="{{ asset('js/userOnboarding/intro.js') }}"></script>
    <script src="{{ asset('js/userOnboarding/courses.js') }}"></script>
@endpush
