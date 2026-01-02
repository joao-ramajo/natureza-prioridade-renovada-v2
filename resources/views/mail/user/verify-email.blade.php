<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifique seu email</title>
</head>
<body>
    <h2>Olá, {{ $name }}!</h2>

    <p>Obrigado por se cadastrar. Clique no link abaixo para verificar seu email:</p>

    <p>
        <a href="{{ $link }}" style="display:inline-block; padding:10px 20px; background:#3490dc; color:#fff; text-decoration:none; border-radius:5px;">
            Verificar Email
        </a>
    </p>

    <p>Se você não se cadastrou, ignore este email.</p>

    <p>Atenciosamente,<br>Equipe do Seu App</p>
</body>
</html>
