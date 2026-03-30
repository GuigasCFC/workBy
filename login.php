<?php
session_start();
if(isset($_SESSION['usuario'])){
    header("Location: inicial.php");
    exit();
}
include "conn.php";

$erro = "";

if(isset($_POST['entrar'])){
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query = $conn->prepare('SELECT * FROM cadastros WHERE email_cad = :plogin OR nome_id = :plogin2');
    $query->bindValue(':plogin',  $login);
    $query->bindValue(':plogin2', $login);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if($usuario && password_verify($senha, $usuario['senha_cad'])){
        $_SESSION['usuario'] = $usuario['nome_id'];
        $_SESSION['email']   = $usuario['email_cad'];
        header("Location: inicial.php");
        exit();
    } else {
        $erro = "Usuário/e-mail ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
    <title>Login - WorkBY</title>
</head>
<body>
    <button class="toggle-theme">☀️ Light</button>
    <div class="login-container">
        <h2>Bem-vindo de volta!</h2>
        <form action="login.php" method="POST">
            <label>E-mail ou usuário</label>
            <input type="text" placeholder="Digite seu e-mail ou usuário" name="login" required>
            <label>Senha</label>
            <input type="password" placeholder="Digite sua senha" name="senha" required>
            <?php if($erro): ?>
                <p style="color:#f87171; font-size:13px; margin-top:6px;"><?= $erro ?></p>
            <?php endif; ?>
            <button type="submit" name="entrar">Entrar</button>
        </form>
        <a href="esqueceu-senha.php">Esqueceu sua senha? Recupere sua senha!</a>
        <br>
        <a href="index.php">Não tem uma conta? Faça seu cadastro!</a>
    </div>
</body>
</html>