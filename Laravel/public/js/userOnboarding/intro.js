function iniciarIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Bem-vindo ao AtecGest Pro!',
                intro: 'Este é um guia rápido para ajudá-lo a conhecer a nossa aplicação.',
                position: 'center'
            },
            {
                title: 'Secção de Navegação',
                element: document.querySelector('.sidebarContent'),
                intro: 'Aqui está a barra lateral de navegação da sua aplicação. Você pode navegar entre todas as funcionalidades disponíveis.',
                position: 'right'
            },
            {
                title: 'Logotipo da aplicação',
                element: document.querySelector('.logo'),
                intro: 'Ao clicar no logótipo da aplicação, será redirecionado para a página inicial.',
                position: 'right'
            },
            {
                title: 'Secção de tickets',
                element: document.querySelector('.tickets'),
                intro: 'Nesta secção, pode encontrar e gerir todos os tickets disponíveis. Crie, edite, apague, ou veja os detalhes dos tickets.',
                position: 'right'
            },
            {
                title: 'Dashboard',
                element: document.querySelector('.dashboard'),
                intro: 'Na dashboard, encontrará indicadores importantes sobre o desempenho da sua aplicação.',
                position: 'right'
            },
            {
                title: 'Gestão de Utilizadores',
                element: document.querySelector('.users'),
                intro: 'Aqui pode gerir todos os utilizadores da aplicação. Adicione, edite ou remova utilizadores conforme necessário.',
                position: 'right'
            },
            {
                title: 'Gestão de Material',
                element: document.querySelector('.material'),
                intro: 'Na secção de material, pode criar, visualizar, editar ou apagar materiais disponíveis.',
                position: 'right'
            },
            {
                title: 'Formações Externas',
                element: document.querySelector('.trainings'),
                intro: 'Encontre e explore formações externas de mercado disponíveis. Veja os parceiros, crie novas formações ou edite as existentes.',
                position: 'right'
            },
            {
                title: 'Gestão de Turmas',
                element: document.querySelector('.classes'),
                intro: 'Aqui pode gerir todas as turmas. Crie, edite, atribua ou remova turmas conforme necessário.',
                position: 'right'
            },
            {
                title: 'Gestão de Vestuário',
                element: document.querySelector('.clothing'),
                intro: 'Nesta secção, pode atribuir vestuário aos docentes e gerir as atribuições. Edite, crie ou apague atribuições de vestuário.',
                position: 'right'
            },
            {
                title: 'Gestão de Cursos',
                element: document.querySelector('.courses'),
                intro: 'Aqui pode gerir todos os cursos. Crie, edite, atribua ou remova cursos conforme necessário.',
                position: 'right'
            },
            {
                title: 'Notificações',
                element: document.querySelector('#notificacoesDropdown'),
                intro: 'Aqui pode visualizar todas as notificações relevantes da sua aplicação.',
                position: 'right'
            },
            {
                title: 'Perfil',
                element: document.querySelector('#navbarDropdown'),
                intro: 'Gira o seu perfil aqui. Edite suas informações pessoais, configure suas preferências e muito mais.',
                position: 'right'
            },
        ]
    });
    intro.start();
}
