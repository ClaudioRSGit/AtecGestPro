@extends('master.main')

@section('content')
<div class="container">
    <h1>Criar Novo Parceiro</h1>

    <form method="post" action="{{ route('partners.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Parceiro:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Morada:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="contacts" class="form-label">Contatos:</label>
                        <button type="button" class="btn btn-primary" onclick="addContactFields()">Novo Contato</button>
                    </div>
                    <div id="contacts-container">
                        <div class="contact-group mb-3">
                            <input type="text" class="form-control" name="contact_description[]" placeholder="Descrição">
                            <input type="text" class="form-control" name="contact_value[]" placeholder="Contato">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="actions" class="form-label">Ações:</label>
                    <button type="submit" class="btn btn-primary">Criar Parceiro</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function addContactFields() {
        var contactGroups = document.querySelectorAll('.contact-group');

        var allFieldsFilled = Array.from(contactGroups).every(function (contactGroup) {
            var description = contactGroup.querySelector('input[name^="contact_description"]').value.trim();
            var value = contactGroup.querySelector('input[name^="contact_value"]').value.trim();
            return description !== '' && value !== '';
        });

        if (allFieldsFilled) {
            var contactsContainer = document.getElementById('contacts-container');
            var newContactGroup = document.createElement('div');
            newContactGroup.classList.add('contact-group', 'mb-3');

            var inputDescription = document.createElement('input');
            inputDescription.type = 'text';
            inputDescription.classList.add('form-control');
            inputDescription.name = 'contact_description[]';
            inputDescription.placeholder = 'Descrição';

            var inputValue = document.createElement('input');
            inputValue.type = 'text';
            inputValue.classList.add('form-control');
            inputValue.name = 'contact_value[]';
            inputValue.placeholder = 'Contato';

            newContactGroup.appendChild(inputDescription);
            newContactGroup.appendChild(inputValue);

            contactsContainer.appendChild(newContactGroup);
        } else {
            alert('Preencha todos os campos dos contatos anteriores!');
        }
    }
</script>
@endsection
