function submitFormRoles() {
    let roleFilterValue = document.getElementById("roleFilter").value;
    document.getElementById("roleFilterForm").submit();
}

function submitForm() {
    let courseFilterValue = document.getElementById("courseFilter").value;

    document.getElementById("courseFilterForm").submit();
}

$(document).ready(function() {
    let activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTabs a[href="' + activeTab + '"]').tab('show');
    }

    $('a[data-toggle="tab"]').on('click', function(e) {
        localStorage.setItem('activeTab', $(this).attr('href'));
    });
});
