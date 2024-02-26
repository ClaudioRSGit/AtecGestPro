document.addEventListener('DOMContentLoaded', function () {
    let deleteButtons = document.querySelectorAll('button[class="modalBtn"]');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            let message = button.getAttribute('data-message');
            document.getElementById('modalBody').textContent = message;

            $('#deleteModal').modal('show');

            $('#deleteBtn').click(function () {
                button.closest('form').submit();
            });
        });
    });
});

function submitForm() {
    document.getElementById("courseFilterForm").submit();
}

window.setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);
