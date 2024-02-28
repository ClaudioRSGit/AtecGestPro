function triggerTicketIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Secção de Tickets',
                intro: 'Este é um guia rápido para ajudá-lo a conhecer a nossa secção de tickets',
                position: 'center'
            },
            {
                title: 'Separadores de Tickets',
                element: document.querySelector('.tickets-tabs'),
                intro: 'Os separadores de tickets permitem-nos navegar entre as tabelas de Todos os Tickets, Fila de Espera e Reciclagem',
            },
            {
                title: 'Botão de criação de tickets',
                element: document.querySelector('.tickets-newTicketBtn'),
                intro: 'Crie um novo ticket ao clicar neste botão',
            },
            {
                title: 'Barra de pesquisa de tickets',
                element: document.querySelector('.tickets-searchBar'),
                intro: 'Pesquise tickets por título e por solicitador',
            },
            {
                title: 'Filtros de tickets',
                element: document.querySelector('.tickets-filters'),
                intro: 'Filtre tickets por categoria, estado e prioridade',
            },
            {
                title: 'Tabela de Tickets',
                element: document.querySelector('.ticketsTable'),
                intro: 'Aqui pode encontrar todos os tickets disponíveis',
            },
            {
                title: 'Título de Ticket',
                element: document.querySelector('.tickets-title'),
                intro: 'Clique no título do ticket para ver os detalhes do mesmo',
            },
            {
                title: 'Solicitador do ticket',
                element: document.querySelector('.tickets-requester'),
                intro: 'Clique no nome do solicitador para ver os detalhes do mesmo',
            },
            {
                title: 'Técnico atribuído',
                element: document.querySelector('.tickets-tech'),
                intro: 'Clique no nome do técnico para ver os detalhes do mesmo',
            },
            {
                title: 'Ações de Ticket',
                element: document.querySelector('.tickets-actions'),
                intro: 'Aqui pode editar ou apagar um ticket',
            },
        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
function changeTicketTab(){
    $(document).ready(function() {
        $('#myTab a[href="#tickets"]').tab('show');
    });
}
