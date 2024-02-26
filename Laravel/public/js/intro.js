function iniciarIntro() {
    var intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'Bem-vindo!',
                intro: 'Bem-vindo ao AtecGest Pro! Este é um guia rápido para ajudá-lo a conhecer a nossa aplicação.',
                position: 'center'
            },
            {
                element: document.querySelector('.sidebarContent'),
                intro: 'Esta é a barra lateral de navegação da sua aplicação. Aqui pode navegar entre todas as funcionalidades disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.logo'),
                intro: 'Ao clicar no logótipo da aplicação, será redirecionado para a página inicial.',
                position: 'right'
            },
            {
                element: document.querySelector('.tickets'),
                intro: 'Aqui pode encontrar os tickets disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.dashboard'),
                intro: 'Aqui pode encontrar os dashboards disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.users'),
                intro: 'Aqui pode encontrar os utilizadores disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.material'),
                intro: 'Aqui pode encontrar os materiais disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.trainings'),
                intro: 'Aqui pode encontrar os treinos disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.classes'),
                intro: 'Aqui pode encontrar as aulas disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.clothing'),
                intro: 'Aqui pode encontrar a roupa disponível.',
                position: 'right'
            },
            {
                element: document.querySelector('.courses'),
                intro: 'Aqui pode encontrar os cursos disponíveis.',
                position: 'right'
            },
            {
                element: document.querySelector('.ticketsTable'),
                intro: 'Aqui pode encontrar a tabela de tickets disponíveis.',
                position: 'right',
            }
        ]
    });
    intro.start();
}

function mudarDeRota(novaRota) {
    window.location.href = novaRota;
}
