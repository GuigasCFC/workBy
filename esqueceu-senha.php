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
 
    <!-- ─── Formulário 1: Solicitar recuperação (sem token na URL) ─── -->
    <div class="login-container" id="formRecuperacaoContainer">
        <h2>Recupere sua conta</h2>
        <form class="formulario" id="formRecuperacao">
            <label for="email">E-mail ou nome de usuário</label>
            <input type="text" id="email" placeholder="Digite seu email ou nome de usuário" name="email" required>
            <p id="mensagem-erro" style="color: red; display: none; margin: 0;"></p>
            <button type="submit" id="btnEnviar">Enviar código para redefinir</button>
        </form>
    </div>
 
    <!-- ─── Formulário 2: Definir nova senha (com token na URL) ─── -->
    <div class="login-container" id="formResetContainer" style="display: none;">
        <h2>Nova Senha</h2>
        <form class="formulario" id="formReset">
            <label for="nova_senha">Nova senha</label>
            <input type="password" id="nova_senha" placeholder="Digite sua nova senha" required minlength="6">
 
            <label for="confirmar_senha">Confirmar senha</label>
            <input type="password" id="confirmar_senha" placeholder="Confirme sua nova senha" required minlength="6">
 
            <p id="erroReset" style="color: red; display: none; margin: 0;"></p>
            <button type="submit" id="btnSalvar">Salvar nova senha</button>
        </form>
    </div>
 
    <!-- ─── Token inválido ou expirado ─── -->
    <div class="login-container" id="tokenInvalido" style="display: none;">
        <h2>⚠️ Link inválido</h2>
        <p>Este link de redefinição é inválido ou já expirou.</p>
        <a href="esqueceu-senha.php" style="margin-top: 12px; display: inline-block;">Solicitar novo link</a>
    </div>
 
    <!-- ─── Popup de sucesso (envio do e-mail) ─── -->
    <div class="popup-sucesso" id="popup">
        <div class="popup-box">
            <h3>✅ Sucesso!</h3>
            <p>Código enviado com sucesso!</p>
            <button onclick="fecharPopup()"><a href="login.php">Continuar</a></button>
        </div>
    </div>
 
    <!-- ─── Popup de sucesso (senha redefinida) ─── -->
    <div class="popup-sucesso" id="popupSenha" style="display: none;">
        <div class="popup-box">
            <h3>✅ Senha redefinida!</h3>
            <p>Sua senha foi alterada com sucesso.</p>
            <button><a href="login.php">Fazer login</a></button>
        </div>
    </div>
 
    <script src="assets/script.js"></script>
    <script src="assets/recuperacao.js"></script>
</body>
</html>