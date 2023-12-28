@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Parceiro</h1>
        <form method="post" action="{{ route('partners.update', $partner->id) }}">

            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Parceiro:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $partner->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $partner->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Morada:</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $partner->address }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contacts" class="form-label">Contatos:</label>
                        @foreach ($partner->partnerContacts as $contact)
                            <div class="mb-2">
                                <div class="row">
                                    <input type="text" class="form-control" name="contact_description[]"
                                        value="{{ $contact->description }}" placeholder="Descrição">

                                    <input type="text" class="form-control" name="contact_value[]"
                                        value="{{ $contact->contact }}" placeholder="Contato">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </form>
    </div>
@endsection
