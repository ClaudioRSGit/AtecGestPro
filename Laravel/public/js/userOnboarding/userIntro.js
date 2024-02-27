function triggerUserIntro() {
    const intro = introJs();
    intro.setOptions({
        steps: [
            {
                title: 'User!!',
                intro: '<div style="text-align: center;"><div class="introjs-tooltiptext">Este é um guia rápido para ajudá-lo a conhecer a nossa aplicação<img src="https://atecgestpro.atec-porto.eu/assets/logo.png" style="width: 50%; margin-top: 10px;"></div></div>',
                position: 'center'
            },
        ]
    });
    intro.start();
}
