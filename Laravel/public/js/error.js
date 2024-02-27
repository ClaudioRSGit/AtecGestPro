function countdownRedirect() {
    let seconds = 5;
    let countdownElement = document.getElementById("countdown");
    let countdownInterval = setInterval(function() {
        seconds--;
        countdownElement.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(countdownInterval);
            window.location.href = "/";
        }
    }, 1000);
}

countdownRedirect();

