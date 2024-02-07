function submitSortCode() {
    document.getElementById("filterForm").submit();
}

document.addEventListener('DOMContentLoaded', function () {
    const courseTable = document.getElementById('courseTable');
    const courseRows = courseTable.querySelectorAll('tbody tr');
    const selectAllCheckbox = document.getElementById('select-all');
    const deleteSelectedButton = document.getElementById('delete-selected');

    selectAllCheckbox.addEventListener('change', function () {
        courseRows.forEach(courseRow => {
            const checkbox = courseRow.querySelector('input[name="selectedCourses[]"]');
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    deleteSelectedButton.addEventListener('click', function () {
        const selectedCourses = Array.from(document.querySelectorAll(
            'input[name="selectedCourses[]"]:checked'))
            .map(checkbox => checkbox.value);

        if (selectedCourses.length > 0 && confirm(
            'Tem certeza que deseja excluir os cursos selecionados?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('courses.massDelete') }}`;
            form.style.display = 'none';

            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            selectedCourses.forEach(courseId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'course_ids[]';
                input.value = courseId;
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

setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);
