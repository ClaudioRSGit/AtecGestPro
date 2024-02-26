<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro 404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            width: 60%;
            text-align: center;
        }

        .error-text {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        .error-code {
            color: #555;
            font-size: 100px;
            font-weight: bold;
            margin: 0;
        }

        .error-description {
            color: #555;
            font-size: 18px;
        }

        .error-image {
            width: 40%;
            text-align: center;
        }

        .error-image img {
            max-width: 80%;
            height: auto;
            margin-right: 30%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error-text">
        <h2>Oops! Parece que alguém se perdeu...</h2>
    </div>
    <h1 class="error-code">404</h1>

    <div class="error-description">
        <h2><strong>Página não encontrada</strong></h2>
    </div>

    <div id="redirect-counter">Será redirecionado em <span id="countdown">5</span> segundos.</div>
</div>
<div class="error-image">
    <img src="{{ asset('assets/404.png') }}">
</div>

<script>
    function countdownRedirect() {
        var seconds = 5;
        var countdownElement = document.getElementById("countdown");
        var countdownInterval = setInterval(function() {
            seconds--;
            countdownElement.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "/";
            }
        }, 1000);
    }

    countdownRedirect();
</script>
</body>
</html>
