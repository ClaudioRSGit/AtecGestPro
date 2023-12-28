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
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="contacts" class="form-label">Contatos:</label>
                            <button type="button" class="btn btn-primary" onclick="addContactFields()">Novo Contato</button>
                        </div>
                        <div id="contacts-container">
                            @foreach ($partner->partnerContacts as $contact)
                                <div class="contact-group mb-3">
                                    <input type="hidden" name="existing_contact_ids[]" value="{{ $contact->id }}">
                                    <input type="text" class="form-control" name="existing_contact_descriptions[]"
                                        value="{{ $contact->description }}" placeholder="Descrição">
                                    <input type="text" class="form-control" name="existing_contact_values[]"
                                        value="{{ $contact->contact }}" placeholder="Contato">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <script>
        function addContactFields() {
            var contactsContainer = document.getElementById('contacts-container');
            var newContactGroup = document.createElement('div');
            newContactGroup.classList.add('contact-group', 'mb-3');

            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'new_contact_ids[]';
            inputId.value = ''; 

            var inputDescription = document.createElement('input');
            inputDescription.type = 'text';
            inputDescription.classList.add('form-control');
            inputDescription.name = 'new_contact_descriptions[]';
            inputDescription.placeholder = 'Descrição';

            var inputValue = document.createElement('input');
            inputValue.type = 'text';
            inputValue.classList.add('form-control');
            inputValue.name = 'new_contact_values[]';
            inputValue.placeholder = 'Contato';

            newContactGroup.appendChild(inputId);
            newContactGroup.appendChild(inputDescription);
            newContactGroup.appendChild(inputValue);

            contactsContainer.appendChild(newContactGroup);
        }
    </script>
@endsection
