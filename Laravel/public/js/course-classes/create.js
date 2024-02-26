$(document).ready(function () {

    $("#select-all").click(function () {
        $("input[name='selected_students[]']").prop('checked', $(this).prop('checked'));
    });


    $("#search").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $("#studentsTable tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });


    $(".modalBtn").click(function (event) {
        event.preventDefault();

        var selectedStudents = $("input[name='selected_students[]']:checked").length;

        if (selectedStudents === 0) {
            var message = $(this).data('message');
            $(".modal-body").text(message);
            $("#confirmationModal").modal('show');
        } else {
            $("#createCourseClassForm").submit();
        }
    });

    $("#continueBtn").click(function () {
        $("#createCourseClassForm").off('submit').submit();
    });

    $('button[name="import"]').on('click', function (e) {
        e.preventDefault();
        $('#importStudentsModal').modal('show');
    });

});
