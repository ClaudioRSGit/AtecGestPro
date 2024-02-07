function toggleFieldsQuantity() {
    const sizeCheckboxes = document.querySelectorAll('.size-checkbox');
    const quantityInputs = document.querySelectorAll('.quantity-input');

    sizeCheckboxes.forEach((checkbox, index) => {
        quantityInputs[index].disabled = !checkbox.checked;
    });
}

function toggleFields() {
    let isInternalElement = document.getElementById('isInternal');
    let isClothingElement = document.getElementById('isClothing');
    let gender = document.getElementById('gender');
    let quantity = document.getElementById('quantity');
    let hide = document.getElementById('hide');

    if (isInternalElement.value == 0) {
        isClothingElement.value = 0;
        warningMessage.style.display = 'block';
    } else {
        warningMessage.style.display = 'none';
    }

    if (isClothingElement.value == 1) {
        isInternalElement.value = 1;
    }

    gender.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
    quantity.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'none' : 'block';
    hide.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', toggleFields);
document.getElementById('isInternal').addEventListener('change', toggleFields);
document.getElementById('isClothing').addEventListener('change', toggleFields);

flatpickr(".flatpickr", {
    inline: true,
    altInput: true,
    altFormat: "F j, Y H:i",
    dateFormat: "Y-m-d\TH:i:s",
    minDate: "today",
});

