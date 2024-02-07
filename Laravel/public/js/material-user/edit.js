document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

    selectAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                'input[name="selectedMaterials[]"]:checked').length;
        });
    });
});

const deleteSelectedButton = document.getElementById('delete-selected');

document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                'input[name="selectedMaterials[]"]:checked').length;
        });
    });
});

deleteSelectedButton.addEventListener('click', function () {
    const selectedMaterials = Array.from(document.querySelectorAll(
        'input[name="selectedMaterials[]"]:checked'))
        .map(checkbox => checkbox.value);
    if (selectedMaterials.length > 0 && confirm(
        'Tem certeza que deseja excluir os materiais selecionados?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ route('material - user.massDelete') }}`;
        form.style.display = 'none';
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        selectedMaterials.forEach(materialId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'material_ids[]';
            input.value = materialId;
            form.appendChild(input);
        });
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    }
});
