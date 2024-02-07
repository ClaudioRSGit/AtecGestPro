$(document).ready(function () {
    $("#select-all").click(function () {
        $("input[name='selected_students[]']").prop('checked', $(this).prop('checked'));
    });

    $("#criarTurmaBtn").click(function () {
        document.getElementById('createCourseClassForm').submit();
    });

    $("#search").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $("#studentsTable tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
