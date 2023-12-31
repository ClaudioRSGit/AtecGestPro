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
                            <button type="button" class="btn btn-primary" onclick="addContactFields()">Novo
                                Contato</button>
                        </div>
                        <div id="contacts-container">
                            @foreach ($partner->partnerContacts as $contact)
                                <div class="contact-group mb-3">
                                    <input type="hidden" name="existing_contact_ids[]" value="{{ $contact->id }}">
                                    <input type="text" class="form-control" name="existing_contact_descriptions[]"
                                        value="{{ $contact->description }}" placeholder="Descrição">
                                    <input type="text" class="form-control" name="existing_contact_values[]"
                                        value="{{ $contact->contact }}" placeholder="Contato">
                                    <button type="button" class="btn"
                                        onclick="removeContact({{ $contact->id }}, this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                            viewBox="0 0 448 512">
                                            <path fill="#116fdc"
                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" onclick="submitForm()">Atualizar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function submitForm() {
            validateContacts();
            document.querySelector('form').submit();
        }

        function validateContacts() {
            var contactGroups = document.querySelectorAll('.contact-group');

            for (var i = 0; i < contactGroups.length; i++) {
                var descriptionInput = contactGroups[i].querySelector(
                    '[name^="existing_contact_descriptions"], [name^="new_contact_descriptions"]');
                var valueInput = contactGroups[i].querySelector(
                    '[name^="existing_contact_values"], [name^="new_contact_values"]');

                if (descriptionInput.value.trim() === '' || valueInput.value.trim() === '') {
                    contactGroups[i].remove();
                }
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            function checkAndAddContactFields() {
                var contactsContainer = document.getElementById('contacts-container');
                var existingContacts = document.querySelectorAll('.contact-group');

                if (existingContacts.length === 0) {
                    addContactFields();
                }
            }
            checkAndAddContactFields();
        });

        function addContactFields() {
            var contactsContainer = document.getElementById('contacts-container');
            var contactGroups = document.querySelectorAll('.contact-group');

            if (contactGroups.length === 0) {
                addNewContactGroup();
                return;
            }

            var lastContactGroup = contactGroups[contactGroups.length - 1];
            var lastDescriptionInput = lastContactGroup.querySelector('[name^="new_contact_descriptions"]');
            var lastValueInput = lastContactGroup.querySelector('[name^="new_contact_values"]');

            if (lastDescriptionInput && lastValueInput && (lastDescriptionInput.value.trim() === '' || lastValueInput.value
                    .trim() === '')) {
                alert('Preencha todos os campos dos contatos anteriores!');
                return;
            }
            addNewContactGroup();
        }

        function addNewContactGroup() {
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

            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('btn');
            removeButton.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#116fdc" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>';
            removeButton.addEventListener('click', function() {
                newContactGroup.remove();
            });

            newContactGroup.appendChild(inputId);
            newContactGroup.appendChild(inputDescription);
            newContactGroup.appendChild(inputValue);
            newContactGroup.appendChild(removeButton);

            contactsContainer.appendChild(newContactGroup);
        }

        function removeContact(contactId, contactElement) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/partner-contact/' + contactId,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $(contactElement).closest('.contact-group').remove();
                    } else {
                        alert(response.error);
                    }
                }
            });
        }
    </script>
@endsection
