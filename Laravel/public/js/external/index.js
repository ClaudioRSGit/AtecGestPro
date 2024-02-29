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
        $(`#myTabs a[href="#${tabId}"]`).tab('show');
    }

    const pageName = window.location.pathname.split('/').pop();
    const activeTabInfo = localStorage.getItem(`activeTabInfo_${pageName}`);

    if (activeTabInfo) {
        const {tabId, context} = JSON.parse(activeTabInfo);
        setActiveTab(tabId);
        setFragment(tabId);
    }

    $('#myTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        const tabId = $(e.target).attr('href').substring(1);
        const context = determineContext();

        const activeTabInfo = JSON.stringify({tabId, context});
        localStorage.setItem(`activeTabInfo_${pageName}`, activeTabInfo);

        setFragment(tabId);
    });

    window.addEventListener('hashchange', function () {
        const fragment = getFragment();
        setActiveTab(fragment);
    });

    window.addEventListener('beforeunload', function () {
        history.pushState("", document.title, window.location.pathname + window.location.search);
    });
});



$(document).ready(function() {
$('.viewPartnersForm').on('submit', function(e) {
    e.preventDefault();
    window.location.hash = 'formacoes_externas';
    this.submit();

});
});
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
