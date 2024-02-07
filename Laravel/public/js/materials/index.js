window.setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

function submitForm() {
    let materialFilterValue = document.getElementById("materialFilter").value;

    if (materialFilterValue) {
        document.getElementById("materialFilterForm").submit();
    }
}

const deleteSelectedButton = document.getElementById('delete-selected');
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

    const sortDropdown = document.getElementById('sort');

    sortDropdown.addEventListener('change', function () {
        sortMaterials();
    });

    function sortMaterials() {
        const sortValue = sortDropdown.value;
        const materialRows = Array.from(document.querySelectorAll('.material-row'));
        const fillerRows = Array.from(document.querySelectorAll('.filler'));

        materialRows.sort((a, b) => {
            const aName = a.querySelector('a').textContent.toLowerCase();
            const bName = b.querySelector('a').textContent.toLowerCase();

            if (sortValue === 'az') {
                return aName.localeCompare(bName);
            } else {
                return bName.localeCompare(aName);
            }
        });

        const tbody = document.querySelector('tbody');
        materialRows.forEach((row, index) => {
            tbody.appendChild(row);
            if (fillerRows[index]) {
                tbody.appendChild(fillerRows[index]);
            }
        });
    }

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
        form.action = `{{ route('materials.massDelete') }}`;
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
