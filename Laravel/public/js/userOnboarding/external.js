function triggerExternalIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Turmas',
                intro: 'Bem-vindo à página de turmas. Aqui você pode visualizar e gerenciar todas as turmas disponíveis.',
                position: 'center'
            },
            {
                title: 'Botão de Criar Turma',
                element: document.querySelector('.buttons .btn-primary'),
                intro: 'Crie uma nova turma ao clicar neste botão.',
                position: 'left'
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.search-container input'),
                intro: 'Utilize este campo de pesquisa para encontrar turmas específicas.',
                position: 'right'
            },
            {
                title: 'Filtrar por Curso',
                element: document.querySelector('#myTabs'),
                intro: 'Filtre as turmas por curso selecionando uma opção na lista de abas.',
                position: 'bottom'
            },
            {
                title: 'Lista de Turmas',
                element: document.querySelector('#externalTable'),
                intro: 'Mostra todas as turmas, organizadas em uma tabela.',
                position: 'top'
            },
            {
                title: 'Detalhes da Turma',
                element: document.querySelector('.customTableStyling .clickable'),
                intro: 'Clique em uma turma para expandir e ver os detalhes, incluindo os formandos.',
                position: 'top'
            },
            {
                title: 'Ações da Turma',
                element: document.querySelector('.editDelete'),
                intro: 'Podemos editar ou apagar uma turma.',
                position: 'left'
            },
        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
function openFirstTab(){
    const firstTab = document.querySelector('.firstTab');
    firstTab.click();
}
