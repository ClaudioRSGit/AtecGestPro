jQuery(function () {
    flatpickr("#start_date, #end_date", {
        inline: true,
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
        locale: "pt"
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var partnerDropdown = document.getElementById('partner_id');
    var addressField = document.getElementById('address');

    function setAddress() {
        var selectedOption = partnerDropdown.options[partnerDropdown.selectedIndex];
        addressField.value = selectedOption.getAttribute('data-address');
    }

    setAddress();

    partnerDropdown.addEventListener('change', setAddress);
});

window.setTimeout(function () {
    $(".error-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2500);
