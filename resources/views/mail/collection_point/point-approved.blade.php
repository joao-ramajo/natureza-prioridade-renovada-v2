<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponto de Coleta Aprovado</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            color: #333333;
        }
        a.button {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Parabéns, {{ $name }}! 🎉</h1>
        <p>O seu ponto de coleta <strong>{{ $pointName }}</strong> foi <strong>aprovado</strong> com sucesso.</p>
        <p>Você pode acessá-lo clicando no botão abaixo:</p>
        <a href="{{ $link }}" class="button">Ver Ponto de Coleta</a>
        <p>Obrigado por contribuir para um mundo mais sustentável!</p>
    </div>
</body>
</html>
