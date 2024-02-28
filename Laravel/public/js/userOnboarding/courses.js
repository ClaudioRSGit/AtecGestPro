function triggerCoursesIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Lista de Cursos',
                intro: 'Seja bem-vindo à página de listagem de cursos. Aqui poderá visualizar e gerir todos os cursos disponíveis.',
                position: 'center'
            },
            {
                title: 'Botão Novo Curso',
                element: document.querySelector('.newCourse'),
                intro: 'Crie um novo curso ao clicar neste botão.',
                position: 'left'
            },
            {
                title: 'Campo de Pesquisa',
                element: document.querySelector('#courseSearch'),
                intro: 'Utilize este campo de pesquisa para encontrar cursos específicos.',
                position: 'right'
            },
            {
                title: 'Tabela de Cursos',
                element: document.querySelector('#courseTable'),
                intro: 'Esta tabela apresenta todos os cursos disponíveis organizados por código e descrição.',
                position: 'center'
            },
            {
                title: 'Detalhes do Curso',
                element: document.querySelector('.courses-row'),
                intro: 'Clique num curso para visualizar mais detalhes.',
                position: 'center'
            },
            {
                title: 'Ações do Curso',
                element: document.querySelector('.editDelete'),
                intro: 'Pode editar ou eliminar um curso nesta secção.',
                position: 'left'
            },
        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
