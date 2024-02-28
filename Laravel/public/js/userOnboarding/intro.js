function triggerIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Bem-vindo ao AtecGest Pro!',
                intro: '<div style="text-align: center;"><div class="introjs-tooltiptext">Este é um guia rápido para ajudá-lo a conhecer a nossa aplicação<img src="https://atecgestpro.atec-porto.eu/assets/logo.png" style="width: 50%; margin-top: 10px;"></div></div>',
                position: 'center'
            },
            {
                title: 'Secção de Navegação',
                element: document.querySelector('.sidebarContent'),
                intro: 'Aqui está a barra lateral de navegação. Poderá navegar entre todas as funcionalidades disponíveis',
                position: 'right'
            },
            {
                title: 'Logotipo da aplicação',
                element: document.querySelector('.logo'),
                intro: 'Ao clicar no logótipo da aplicação será redirecionado para a página inicial',
                position: 'right'
            },
            {
                title: 'Secção de tickets',
                element: document.querySelector('.tickets'),
                intro: 'Nesta secção poderá encontrar e gerir todos os tickets disponíveis. Crie, edite, apague, ou veja os detalhes dos tickets',
                position: 'right'
            },
            {
                title: 'Dashboard',
                element: document.querySelector('.dashboard'),
                intro: 'Na dashboard encontrará indicadores importantes sobre a sua aplicação',
                position: 'right'
            },
            {
                title: 'Gestão de Utilizadores',
                element: document.querySelector('.users'),
                intro: 'Aqui poderá gerir todos os utilizadores da aplicação. Adicione, edite ou remova utilizadores conforme necessário',
                position: 'right'
            },
            {
                title: 'Gestão de Material',
                element: document.querySelector('.material'),
                intro: 'Na secção de material poderá criar, visualizar, editar ou apagar materiais',
                position: 'right'
            },
            {
                title: 'Formações Externas',
                element: document.querySelector('.trainings'),
                intro: 'Encontre e explore formações externas de mercado disponíveis. Veja os parceiros, crie novas formações ou edite as existentes',
                position: 'right'
            },
            {
                title: 'Gestão de Turmas',
                element: document.querySelector('.classes'),
                intro: 'Aqui poderá gerir todas as turmas. Crie, edite, visualize ou remova turmas conforme necessário',
                position: 'right'
            },
            {
                title: 'Gestão de Vestuário',
                element: document.querySelector('.clothing'),
                intro: 'Nesta secção, poderá realizar atribuição de vestuário aos docentes e gerir as mesmas. Edite, crie ou apague as atribuições',
                position: 'right'
            },
            {
                title: 'Gestão de Cursos',
                element: document.querySelector('.courses'),
                intro: 'Aqui poderá gerir todos os cursos. Crie, edite, visualize ou remova cursos conforme necessário',
                position: 'right'
            },
            {
                title: 'Notificações',
                element: document.querySelector('#notificacoesDropdown'),
                intro: 'Aqui poderá visualizar as notificações',
                position: 'right'
            },
            {
                title: 'Perfil',
                element: document.querySelector('#navbarDropdown'),
                intro: 'Na área de perfil, poderá visualizar e editar o seu perfil. Também é possivel fazer logout',
                position: 'right'
            },
        ],
        prevLabel: 'Anterior',
        nextLabel: 'Próximo',
        doneLabel: 'Concluir'
    });
    intro.start();
}
