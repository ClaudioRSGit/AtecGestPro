@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes do Parceiro</h1>

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

                    @if ($partner->partnerContacts->isEmpty())
                        <p>Sem Contatos Associados</p>
                    @else
                        @foreach($partner->partnerContacts as $contact)
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
                    <label for="actions">Ações:</label>
                    <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
