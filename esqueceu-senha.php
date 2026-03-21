<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Recuperação de conta - WorkBY</title>
</head>
<body>
    <button class="toggle-theme" onclick="toggleTheme()">☀️ Light</button>
    <div class="login-container">
        <h2>Recupere sua conta</h2>
        <form class="formulario">
            <label for="">E-mail ou nome de usuário</label>
            <input type="name" placeholder="Digite seu email ou nome de usuário" name="email">
            <button type="submit">Enviar código para redefinir</button>
        </form>
        <a href="index.php">Fazer seu cadastro ou login!</a>
    </div>
    <div class="popup-sucesso" id="popup">
        <div class="popup-box">
            <h3>✅ Sucesso!</h3>
            <p>Código enviado com sucesso!</p>
            <button onclick="fecharPopup()"><a href="inicial.php">Continuar</a></button>
        </div>
    </div>
<script src="assets/script.js"></script>
</body>
</html>