function triggerMaterialIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Lista de Materiais',
                intro: 'Esta é a lista de materiais. Aqui poderá visualizar todos os materiais disponíveis',
                position: 'center'
            },
            {
                title: 'Separadores de Materiais',
                element: document.querySelector('#userTabs'),
                intro: 'Os separadores de materiais permitem a navegação entre todos os materiais reciclagem',
            },
            {
                title: 'Botão de Novo Material',
                element: document.querySelector('.btn-primary'),
                intro: 'Crie um novo material clicando neste botão',
                position: 'left'
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.materials-searchBar'),
                intro: 'Use este campo de pesquisa para encontrar materiais específicos',
            },
            {
                title: 'Botões de Ação',
                element: document.querySelector('.buttons'),
                intro: 'Os botões de ação servem para apagar os materiais selecionados e filtrar por tipo',
            },
            {
                title: 'Tabela de Materiais',
                element: document.querySelector('.table'),
                intro: 'Aqui encontrará todos os materiais disponíveis',
            },
            {
                title: 'Nome do Material',
                element: document.querySelector('.material-name'),
                intro: 'Clique no nome do material para ver os detalhes do mesmo',
            },
            {
                title: 'Ações do Material',
                element: document.querySelector('.editDelete'),
                intro: 'Aqui poderá editar ou apagar um material',
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
            $('#userTabs a[href="#materiais"]').tab('show');
    });
}
