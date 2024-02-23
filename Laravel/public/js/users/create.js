function toggleCourseClassDiv() {
    const selectedRole = $("#role_id").val();
    const isStudentValue = selectedRole === "3" ? 1 : 0;

    $("#isStudent").val(isStudentValue);

    if (selectedRole === "3") {
        $("#labelCourseClass").show();
        $("#password").closest(".mb-3").hide();
    } else {
        $("#labelCourseClass").hide();
        $("#password").closest(".mb-3").show();
    }
}

$(document).ready(function() {
    toggleCourseClassDiv();
});

window.setTimeout(function() {
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);
