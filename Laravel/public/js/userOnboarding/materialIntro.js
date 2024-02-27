function triggerMaterialIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Lista de Materiais',
                intro: 'Esta é a lista de materiais. Aqui pode visualizar todos os materiais disponíveis',
                position: 'center'
            },
            {
                title: 'Separadores de Materiais',
                element: document.querySelector('#userTabs'),
                intro: 'Os separadores de materiais permitem-nos navegar entre todos os materiais e materiais na reciclagem',
            },
            {
                title: 'Botão de Novo Material',
                element: document.querySelector('.btn-primary'),
                intro: 'Crie um novo material clicando neste botão',
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.materials-searchBar'),
                intro: 'Use este campo de pesquisa para encontrar materiais específicos',
            },
            {
                title: 'Botões de Ação',
                element: document.querySelector('.buttons'),
                intro: 'Os botões de ação servem para apagar os materiais selecionados e filtrar materiais por tipo',
            },
            {
                title: 'Tabela de Materiais',
                element: document.querySelector('.table'),
                intro: 'Aqui pode encontrar todos os materiais disponíveis',
            },
            {
                title: 'Nome do Material',
                element: document.querySelector('.material-name'),
                intro: 'Clique no nome do material para ver os detalhes do mesmo',
            },
            {
                title: 'Ações do Material',
                element: document.querySelector('.editDelete'),
                intro: 'Aqui pode editar ou apagar um material',
            },
        ]
    });
    intro.start();
}
function changeUserTab(){
    $(document).ready(function() {
            $('#userTabs a[href="#materiais"]').tab('show');
    });
}
