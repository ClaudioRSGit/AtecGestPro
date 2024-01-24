@extends('master.main')

@section('content')
<div class="container">
    <h1>Novo Ticket</h1>

    <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado:</label>
            <select class="form-control" id="status" name="status_id">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="technician" class="form-label">Técnico Responsável:</label>
            <select class="form-control" id="technician" name="technician_id" required>
                <option value="">Selecione um técnico</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioridade:</label>
            <select class="form-control" id="priority" name="priority_id" required>
                @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Categoria:</label>
            <select class="form-control" id="category" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="attachment" class="form-label">Anexo:</label>
            <input type="file" class="form-control" id="attachment" name="attachment">
            <p>Make sure you upload a file smaller than 20MB</p>
        </div>

        <button type="submit" class="btn btn-primary">Criar Ticket</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
