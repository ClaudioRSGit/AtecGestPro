@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <h1>Novo Ticket</h1>

        <div class="row my-2">
            <div class="col-md-9">

                <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                            required>

                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <div class="bg-light">

                            <!-- Hidden input field to store Quill HTML content -->
                            <input type="hidden" id="descriptionInput" name="description" value="{{ old('description') }}">
                            <!-- Quill editor -->
                            <div id="description" style="height: 200px;">{!! old('description') !!}</div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Anexo: <strong><span id="file-name"></span></strong></label><br>
                        <label for="attachment" class="btn btn-primary">Selecionar ficheiro</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" style="display: none;">
                        <p>Certifique-se que o arquivo tem menos de 20MB</p>


                    </div>
                    <div class="w-100 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-45">Criar Ticket</button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary w-45">Cancelar</a>
                    </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="status" class="form-label">Estado:</label>
                    <select class="form-control" id="status" name="status_id">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="technician" class="form-label">Técnico Responsável:</label>
                    <select class="form-control" id="technician" name="technician_id">
                        @foreach ($technicians as $technician)
                            <option value="{{ $technician->id }}"
                                {{ old('technician_id') == $technician->id ? 'selected' : '' }}>
                                {{ $technician->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="priority" class="form-label">Prioridade:</label>
                    <select class="form-control" id="priority" name="priority_id" required>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}"
                                {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                {{ $priority->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Categoria:</label>
                    <select class="form-control" id="category" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#description', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                var htmlContent = quill.root.innerHTML;
                document.getElementById('descriptionInput').value = htmlContent;
            });
        });

        // Update file name when file is selected
        document.getElementById('attachment').addEventListener('change', function() {
            var filename = this.value.split('\\').pop();
            document.getElementById('file-name').textContent = filename;
        });
    </script>
@endsection
