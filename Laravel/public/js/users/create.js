document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const eyeIcon = togglePasswordBtn.querySelector('i');

    togglePasswordBtn.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        eyeIcon.classList.toggle('fa-eye', type === 'password');
        eyeIcon.classList.toggle('fa-eye-slash', type === 'text');
    });
});

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

$(document).ready(function () {
    toggleCourseClassDiv();
});

window.setTimeout(function () {
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 3000);
