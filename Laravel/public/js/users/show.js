window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);

function updateCourseDescription(selectElement) {
var selectedOption = selectElement.options[selectElement.selectedIndex];
var courseDescription = selectedOption.getAttribute('data-course-description');
document.getElementById('courseDescription').value = courseDescription;
}
document.getElementById('course_class_id').dispatchEvent(new Event('change'));
