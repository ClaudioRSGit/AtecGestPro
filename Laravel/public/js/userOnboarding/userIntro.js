function triggerUserIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Secção de Utilizadores',
                intro: 'Este é um guia rápido para ajudá-lo a conhecer a nossa secção de utilizadores',
                position: 'center'
            },
            {
                title: 'Separadores de Utilizadores',
                element: document.querySelector('#userTabs'),
                intro: 'Os separadores de utilizadores permitem-nos navegar entre a lista de todos os utilizadores e a lista de utilizadores na reciclagem',
            },
            {
                title: 'Botão de criação de Utilizadores',
                element: document.querySelector('.users-newUserBtn'),
                intro: 'Crie um novo ticket ao clicar neste botão',
            },
            {
                title: 'Botões de Ação',
                element: document.querySelector('.buttons'),
                intro: 'Aqui pode encontrar botões para importar utilizadores, apagar utilizadores selecionados e filtrar utilizadores por função',
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.users-searchBar'),
                intro: 'Pesquise utilizadores por nome de utilizador',
            },
            {
                title: 'Tabela de Utilizadores',
                element: document.querySelector('.usersTable'),
                intro: 'Aqui pode encontrar todos os utilizadores disponíveis',
            },
            {
                title: 'Nome do Utilizador',
                element: document.querySelector('.users-name'),
                intro: 'Clique no nome do utilizador para ver os detalhes do mesmo',
            },
            {
                title: 'Ações de Utilizador',
                element: document.querySelector('.editDelete'),
                intro: 'Aqui pode editar ou excluir um utilizador',
            },
        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
function changeUserTab(){
    $(document).ready(function() {
            $('#userTabs a[href="#utilizadores"]').tab('show');
    });
}
