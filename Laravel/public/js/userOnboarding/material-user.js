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
                intro: 'Esta secção apresenta a lista de formandos.Selecione uma turma para atribuir vestuário a um formando especifico',
                position: 'center'
            },
            {
                title: 'Nome do Formando',
                element: document.querySelector('.studentName'),
                intro: 'Clique no nome do formando para visualizar e gerir as informações relacionadas ao vestuário do mesmo',
                position: 'right'
            },
            {
                title: 'Botão Editar',
                element: document.querySelector('.editBtn'),
                intro: 'Clique no botão "editar" para alterar a entrega do vestuário do formando',
                position: 'right'
            },

        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
function openFirstTab(){
    const firstTab = document.querySelector('.tabOpeningBtn');
    const clickFormandos = document.querySelector('.clickFormandos');
    firstTab.click();
    clickFormandos.click();
}
