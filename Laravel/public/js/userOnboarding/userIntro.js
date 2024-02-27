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
                title: 'Botões de Ação',
                intro: 'Aqui pode encontrar botões para criar um novo utilizador, importar utilizadores, excluir utilizadores selecionados e filtrar utilizadores por função',
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.search-container'),
                intro: 'Pesquise utilizadores por nome de utilizador',
            },
            {
                title: 'Tabela de Utilizadores',
                element: document.querySelector('.usersTable'),
                intro: 'Aqui pode encontrar todos os utilizadores disponíveis',
            },
            {
                title: 'Ações de Utilizador',
                element: document.querySelector('.editDelete'),
                intro: 'Aqui pode editar ou excluir um utilizador',
            },
        ]
    });
    intro.start();
}
