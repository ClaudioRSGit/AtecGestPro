setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.form-check-input');

    $(document).ready(function () {
        $('.material-row .size-select').each(function (index, select) {
            var quantityInput = $('.material-row .quantity-input').eq(index);
            $(select).change(function () {
                var selectedOption = $(this).children("option:selected");
                var stock = parseInt(selectedOption.data('stock'));
                quantityInput.attr('max', stock);

                if (parseInt(quantityInput.val()) > stock) {
                    quantityInput.val(stock);
                }
            }).trigger('change');

            quantityInput.on('input', function () {
                var max = parseInt($(this).attr('max'));
                if (parseInt($(this).val()) > max) {
                    $(this).val(max);
                }
            });
        });
    });

    function updateFormData() {
        const formData = new FormData(document.querySelector('form'));

        document.querySelectorAll('.form-check-input:checked').forEach(function (checkbox) {
            const clothingId = checkbox.value;
            const selectElement = document.querySelector(`.size-select[data-clothing-id="${clothingId}"]`);
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const materialSizeId = selectedOption.value;

            formData.set(`material_size_id[${clothingId}]`, materialSizeId);
        });

        document.querySelectorAll('.material-row .size-select:not(:checked)').forEach(function (select) {
            const clothingId = select.getAttribute('data-clothing-id');
            formData.delete(`material_size_id[${clothingId}]`);
        });


    }


    document.querySelector('form').addEventListener('submit', function (e) {
        updateFormData();
    });


    selectAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                'input[name="selectedClothing[]"]:checked').length;
        });
    });


    $(document).ready(function () {
        $('form').on('keydown', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    });
});

document.querySelectorAll('.delivery_date').forEach(function (inputField) {
    inputField.addEventListener('change', function () {
        let inputDate = new Date(this.value);
        let today = new Date();
        today.setHours(0, 0, 0, 0);

        let parentDiv = this.parentNode.querySelector('.warning-icon');

        if (inputDate < today) {
            parentDiv.style.display = 'inline';
        } else {
            parentDiv.style.display = 'none';
        }
    });
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
