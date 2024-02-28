function triggerExternalIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Formações Externas de Mercado',
                intro: 'Bem-vindo à página de formações externas de mercado. Aqui pode visualizar e gerir todas as formações externas.',
                position: 'center'
            },
            {
                title: 'Botão de Criar Formação Externa',
                element: document.querySelector('.newTrainingBtn'),
                intro: 'Clique neste botão para criar uma nova formação externa.',
                position: 'left'
            },
            {
                title: 'Barra de Pesquisa',
                element: document.querySelector('.search-container input'),
                intro: 'Utilize este campo de pesquisa para encontrar formações externas específicas.',
                position: 'right'
            },
            {
                title: 'Separador de Formações',
                element: document.querySelector('#myTabs'),
                intro: 'Clique num separador para visualizar parceiros ou formações externas.',
                position: 'bottom'
            },
            {
                title: 'Tabela de Formações',
                element: document.querySelector('#externalTable'),
                intro: 'Mostra todas as formações, organizadas numa tabela.',
                position: 'top'
            },
            {
                title: 'Detalhes da Formação',
                element: document.querySelector('.customTableStyling .clickable'),
                intro: 'Clique numa formação para ver os detalhes.',
                position: 'top'
            },
            {
                title: 'Botões de Ação',
                element: document.querySelector('.editDelete'),
                intro: 'Utilize estes botões para editar ou apagar uma formação.',
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
