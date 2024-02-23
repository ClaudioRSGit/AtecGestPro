document.addEventListener('DOMContentLoaded', function () {
    let deleteButton = document.getElementById('modal');

    deleteButton.addEventListener('click', function (event) {
        event.preventDefault();

        let message = deleteButton.getAttribute('data-message');
        document.getElementById('modalBody').textContent = message;

        $('#deleteModal').modal('show');

        $('#deleteBtn').click(function () {
            deleteButton.closest('form').submit();
        });
    });
});

setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

function submitSortCode() {
    document.getElementById("filterForm").submit();
}
