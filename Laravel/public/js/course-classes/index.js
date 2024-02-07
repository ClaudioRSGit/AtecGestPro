function submitForm() {
    document.getElementById("courseFilterForm").submit();
}

document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.accordion-checkbox');
    const searchInput = document.getElementById('search');
    const filterDropdown = document.getElementById('filter');
    const deleteSelectedButton = document.getElementById('delete-selected');

    selectAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                '.accordion-checkbox:checked').length;
        });
    });

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        filterMaterials(searchTerm);
    });

    filterDropdown.addEventListener('change', function () {
        filterMaterials();
    });

    function filterMaterials(searchTerm = null) {
        const courseClassCards = document.querySelectorAll('.card');

        courseClassCards.forEach(card => {
            const courseId = card.querySelector('.accordion-checkbox').getAttribute('data-course');
            const filterValue = filterDropdown.value;

            const matchesFilter = (
                (filterValue === 'all') ||
                (filterValue === courseId)
            );

            const matchesSearch = !searchTerm || (
                card.textContent.toLowerCase().includes(searchTerm) ||
                card.querySelector('button').textContent.toLowerCase().includes(searchTerm)
            );

            card.style.display = matchesFilter && matchesSearch ? '' : 'none';
        });
    }

    deleteSelectedButton.addEventListener('click', function () {
        const selectedCourseClass = Array.from(document.querySelectorAll(
            'input[name="selectedCourseClass[]"]:checked'))
            .map(checkbox => checkbox.value);
        if (selectedCourseClass.length > 0 && confirm(
            'Tem certeza que deseja excluir as turmas selecionadas?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('course-classes.massDelete') }}`;
            form.style.display = 'none';
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            selectedCourseClass.forEach(courseClassId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'course_class_ids[]';
                input.value = courseClassId;
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


});

window.setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

