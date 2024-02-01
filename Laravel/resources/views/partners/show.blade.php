@extends('master.main')
@section('title', 'Detalhes do Parceiro')
@section('content')
    <div class="w-100">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Parceiro:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $partner->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="description" name="description" disabled>{{ $partner->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Morada:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $partner->address }}" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="contacts" class="form-label">Contatos:</label>

                    @if ($partner->contactPartner->isEmpty())
                        <p>Sem Contatos Associados</p>
                    @else
                        @foreach($partner->contactPartner as $contact)
                            <div class="mb-2">
                                <input type="text" class="form-control" name="contact_description[]" value="{{ $contact->description }}" placeholder="Descrição" disabled>
                                <input type="text" class="form-control" name="contact_value[]" value="{{ $contact->contact }}" placeholder="Contato" disabled>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

                <div class="form-group">
                    <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>

    </div>
@endsection
