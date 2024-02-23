function toggleCourseClassDiv() {
    const selectedRole = $("#role_id").val();
    const isStudentValue = selectedRole === "3" ? 1 : 0;

    $("#isStudent").val(isStudentValue);

    if (selectedRole === "3") {
        $("#labelCourseClass").show();
        $("#password").hide();
        $("#passwordLabel").hide();
    } else {
        $("#labelCourseClass").hide();
        $("#password").show();
        $("#passwordLabel").show();
    }
}

function updateCourseDescription(select) {}

$(document).ready(function() {
    toggleCourseClassDiv();
});

window.setTimeout(function() {
    $(".error-alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);
