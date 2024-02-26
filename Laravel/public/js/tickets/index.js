
document.addEventListener('DOMContentLoaded', function () {
    let deleteButtons = document.querySelectorAll('button[class="modalBtn"]');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            let message = button.getAttribute('data-message');
            document.getElementById('modalBody').textContent = message;

            $('#deleteModal').modal('show');

            $('#deleteBtn').click(function () {
                button.closest('form').submit();
            });
        });
    });
});

function submitCategoryForm() {
    document.getElementById("filterCategoryForm").submit();
}

function submitFilaCategoryForm() {
    document.getElementById("filterFilaCategoryForm").submit();
}

function submitRecyclingCategoryForm() {
    document.getElementById("filterRecyclingCategoryForm").submit();
}

function submitCategoryFilaForm() {
    document.getElementById("filterCategoryFilaForm").submit();
}

function submitStatusForm() {
    document.getElementById("filterStatusForm").submit();
}

function submitRecyclingStatusForm() {
    document.getElementById("filterRecyclingStatusForm").submit();
}

function submitPriorityForm() {
    document.getElementById("filterPriorityForm").submit();
}

function submitRecyclingPriorityForm() {
    document.getElementById("filterRecyclingPriorityForm").submit();
}

window.setTimeout(function () {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 2000);

$(document).ready(function () {
    function determineContext() {
        return 'pagination';
    }

    function getFragment() {
        return window.location.hash.substring(1);
    }

    function setFragment(fragment) {
        history.pushState(null, null, '#' + fragment);
    }

    function setActiveTab(tabId) {
        $(`#myTab a[href="#${tabId}"]`).tab('show');
    }

    const activeTabInfo = localStorage.getItem('activeTabInfo');

    if (activeTabInfo) {
        const {tabId, context} = JSON.parse(activeTabInfo);
        setActiveTab(tabId);
        setFragment(tabId);
    }

    $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        const tabId = $(e.target).attr('href').substring(1);
        const context = determineContext();

        const activeTabInfo = JSON.stringify({tabId, context});
        localStorage.setItem('activeTabInfo', activeTabInfo);

        setFragment(tabId);
    });

    window.addEventListener('hashchange', function () {
        const fragment = getFragment();
        setActiveTab(fragment);
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var tabId = $(e.target).attr('href');
        history.pushState(null, null, tabId);
    });

    window.addEventListener('beforeunload', function () {
        history.pushState("", document.title, window.location.pathname + window.location.search);
        localStorage.removeItem('activeTabInfo');

    });
});
function showOptions() {
    document.getElementById("options").classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('#open')) {
        var dropdowns = document.getElementsByClassName("options");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

function showQuickTicket() {
    let quickTicket = document.querySelector('.quickTicket');
    quickTicket.style.transition = 'opacity 1s ease, visibility 1s ease';
    quickTicket.style.opacity = '1';
    quickTicket.style.visibility = 'visible';
    document.querySelector('.container').classList.add('w-70');
}
