<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponto de Coleta Reprovado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 40px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #f44336;
            /* vermelho para reprovação */
        }

        p {
            font-size: 16px;
            color: #333333;
        }

        a.button {
            display: inline-block;
            background-color: #f44336;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        a.button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Olá, {{ $name }}</h1>
        <p>O seu ponto de coleta <strong>{{ $pointName }}</strong> infelizmente foi <strong>reprovado</strong>.</p>
        <p><strong>Motivo:</strong> {{ $reason }}</p>
        <p>Você pode acessar seu ponto de coleta clicando no botão abaixo para mais detalhes:</p>
        <a href="{{ $link }}" class="button">Ver Ponto de Coleta</a>
        <p>Obrigado por sua contribuição. Esperamos que você possa ajustar o ponto conforme necessário e tentar
            novamente!</p>
    </div>
</body>

</html>
