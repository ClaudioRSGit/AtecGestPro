function toggleFieldsQuantity() {

    const sizeCheckboxes = document.querySelectorAll('.size-checkbox');
    const quantityInputs = document.querySelectorAll('.quantity-input');

    sizeCheckboxes.forEach((checkbox, index) => {
        quantityInputs[index].disabled = !checkbox.checked;
    });

}

setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);
