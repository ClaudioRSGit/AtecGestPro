function triggerIntroducaoVestuario() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Vestuário',
                intro: 'Seja bem-vindo à página de vestuário. Aqui poderá visualizar e gerir todas as informações relacionadas ao vestuário dos formandos',
                position: 'center'
            },
            {
                title: 'Botão Criar Turma',
                element: document.querySelector('.btn.btn-primary'),
                intro: 'Crie uma nova turma ao clicar neste botão',
                position: 'left'
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.search-container'),
                intro: 'Utilize este campo de pesquisa para encontrar informações específicas',
                position: 'right'
            },
            {
                title: 'Lista de Formandos',
                element: document.querySelector('.tab-content #formandos'),
                intro: 'Esta secção apresenta a lista de formandos, selecione uma turma e pode atribuir vestuário a cada formando',
                position: 'center'
            },

        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
