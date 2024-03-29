function triggerCourseClassIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Turmas',
                intro: 'Bem-vindo à página de turmas. Aqui poderá visualizar e gerir todas as turmas disponíveis.',
                position: 'center'
            },
            {
                title: 'Botão de Criar Turma',
                element: document.querySelector('.classes-createBtn'),
                intro: 'Crie uma nova turma ao clicar neste botão.',
                position: 'left'
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.search-container input'),
                intro: 'Use este campo de pesquisa para encontrar turmas específicas',
            },
            {
                title: 'Filtrar por Curso',
                element: document.querySelector('#courseFilter'),
                intro: 'Filtre as turmas por curso selecionando na lista',
            },
            {
                title: 'Lista de Turmas',
                element: document.querySelector('#accordion'),
                intro: 'Mostra todas as turmas, organizadas em formato de acordeão',
            },
            {
                title: 'Detalhes da Turma',
                element: document.querySelector('.card-header'),
                intro: 'Clique numa turma para expandir e ver os detalhes, incluindo os formandos',
            },
            {
                title: 'Ações da Turma',
                element: document.querySelector('.editDelete'),
                intro: 'É possivel editar ou apagar uma turma',
                position: 'left'
            },
        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
