@extends('master.main')

@section('content')
    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Criar Novo Parceiro</h1>

        <form method="post" action="{{ route('partners.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Parceiro:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Morada:</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') }}">

                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="contacts" class="form-label">Contatos:</label>
                            <button type="button" class="btn btn-primary" onclick="addContactFields()">Novo
                                Contacto</button>
                        </div>
                        <div id="contacts-container">
                            @foreach (old('contact_description', ['']) as $index => $contactDescription)
                                <div class="contact-group mb-3">
                                    <input type="text" class="form-control" name="contact_description[]"
                                        placeholder="Descrição" value="{{ $contactDescription }}">
                                    <input type="text" class="form-control" name="contact_value[]" placeholder="Contacto"
                                        value="{{ old('contact_value.' . $index) }}">
                                    <button type="button" class="btn remove-contact" onclick="removeContact(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                            viewBox="0 0 448 512">
                                            <path fill="#116fdc"
                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </button>
                                </div>
                                @error("contact_description.$index")
                                    <div class="alert alert-danger contact-alert">{{ $message }}</div>
                                @enderror
                                @error("contact_value.$index")
                                    <div class="alert alert-danger contact-alert">{{ $message }}</div>
                                @enderror
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" onclick="validateForm()">Criar Parceiro</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateRemoveButtonState();

            document.querySelector('#contacts-container').addEventListener('input', function(event) {
                if (event.target.tagName === 'INPUT' && event.target.name.startsWith('contact_')) {
                    updateRemoveButtonState();
                }
            });
        });

        const maxContacts = 3;

        function validateForm() {
            const firstContactGroup = document.querySelector('.contact-group');
            const firstDescriptionInput = firstContactGroup.querySelector('input[name^="contact_description"]');
            const firstValueInput = firstContactGroup.querySelector('input[name^="contact_value"]');

            if (firstDescriptionInput.value.trim() === '' && firstValueInput.value.trim() === '') {
                firstContactGroup.remove();
            }

            removeEmptyContactFields();
        }


        function removeEmptyContactFields() {
            const contactGroups = document.querySelectorAll('.contact-group');

            if (contactGroups.length > 1) {
                for (let i = contactGroups.length - 1; i >= 0; i--) {
                    const contactDescription = contactGroups[i].querySelector('input[name^="contact_description"]');
                    const contactValue = contactGroups[i].querySelector('input[name^="contact_value"]');

                    if (contactDescription.value.trim() === '' || contactValue.value.trim() === '') {
                        contactGroups[i].remove();
                    }
                }
            }
        }

        function addContactFields() {
            const contactsContainer = document.getElementById('contacts-container');
            const contactGroups = document.querySelectorAll('.contact-group');

            const allFieldsFilled = Array.from(contactGroups).every(function(contactGroup) {
                const description = contactGroup.querySelector('input[name^="contact_description"]').value.trim();
                const value = contactGroup.querySelector('input[name^="contact_value"]').value.trim();
                return description !== '' && value !== '';
            });

            if (contactGroups.length < maxContacts) {
                if (allFieldsFilled) {
                    const newContactGroup = document.createElement('div');
                    newContactGroup.classList.add('contact-group', 'mb-3');

                    const inputDescription = document.createElement('input');
                    inputDescription.type = 'text';
                    inputDescription.classList.add('form-control');
                    inputDescription.name = 'contact_description[]';
                    inputDescription.placeholder = 'Descrição';

                    const inputValue = document.createElement('input');
                    inputValue.type = 'text';
                    inputValue.classList.add('form-control');
                    inputValue.name = 'contact_value[]';
                    inputValue.placeholder = 'Contacto';

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.classList.add('btn', 'remove-contact');
                    removeButton.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#116fdc" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>';
                    removeButton.addEventListener('click', function() {
                        const contactGroups = document.querySelectorAll('.contact-group');
                        if (contactGroups.length > 1 || (contactGroups.length === 1 && (inputDescription.value
                                .trim() !== '' || inputValue.value.trim() !== ''))) {
                            newContactGroup.remove();
                            updateRemoveButtonState();
                        }
                    });

                    newContactGroup.appendChild(inputDescription);
                    newContactGroup.appendChild(inputValue);
                    contactsContainer.appendChild(newContactGroup);
                    newContactGroup.appendChild(removeButton);
                    updateRemoveButtonState();

                    inputDescription.value = '';
                    inputValue.value = '';
                } else {
                    alert('Preencha todos os campos dos contactos anteriores!');
                }
            } else {
                alert('Número máximo de contactos atingido!');
            }
        }


        function removeContact(button) {
            const contactGroup = button.closest('.contact-group');
            const contactsContainer = document.getElementById('contacts-container');
            contactGroup.remove();
            updateRemoveButtonState();

            if (document.querySelectorAll('.contact-group').length === 0) {
                addContactFields();
            }
        }

        function updateRemoveButtonState() {
            const contactGroups = document.querySelectorAll('.contact-group');
            const removeButtons = document.querySelectorAll('.remove-contact');

            if (contactGroups.length === 1) {
                const contactDescription = contactGroups[0].querySelector('input[name^="contact_description"]');
                const contactValue = contactGroups[0].querySelector('input[name^="contact_value"]');
                removeButtons.forEach(function(button) {
                    button.disabled = (contactDescription.value.trim() === '' && contactValue.value.trim() === '');
                });
            } else {
                removeButtons.forEach(function(button) {
                    button.disabled = false;
                });
            }
        }

        window.setTimeout(function() {
            $(".contact-alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2500);
    </script>
@endsection
