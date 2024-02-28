function triggerUserIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Secção de Utilizadores',
                intro: 'Este é um guia rápido para ajudá-lo a conhecer a secção de utilizadores',
                position: 'center'
            },
            {
                title: 'Separadores de Utilizadores',
                element: document.querySelector('#userTabs'),
                intro: 'Os separadores de utilizadores permitem a navegação entre a lista de todos os utilizadores e a lista de utilizadores na reciclagem',
            },
            {
                title: 'Botão de criação de Utilizadores',
                element: document.querySelector('.users-newUserBtn'),
                intro: 'Crie um novo ticket ao clicar neste botão',
                position: 'left'
            },
            {
                title: 'Botões de Ação',
                element: document.querySelector('.buttons'),
                intro: 'Aqui poderá encontrar botões para importar utilizadores, apagar utilizadores selecionados e filtrar por função',
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.users-searchBar'),
                intro: 'Pesquise utilizadores por nome',
            },
            {
                title: 'Tabela de Utilizadores',
                element: document.querySelector('.usersTable'),
                intro: 'Aqui poderá encontrar todos os utilizadores disponíveis',
                position: 'center'
            },
            {
                title: 'Nome do Utilizador',
                element: document.querySelector('.users-name'),
                intro: 'Clique no nome do utilizador para ver os detalhes do mesmo',
            },
            {
                title: 'Ações de Utilizador',
                element: document.querySelector('.editDelete'),
                intro: 'Aqui poderá editar ou excluir um utilizador',
                position: 'left'
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
