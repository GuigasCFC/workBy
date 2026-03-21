    <?php
        session_start();
        include "conn.php";

        $erro_cadastro = "";

        if(isset($_POST['grava'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nome  = $_POST['nome'];

    // Verifica se email ou nome já existem
        $verifica = $conn->prepare('SELECT * FROM cadastros WHERE email_cad = :pemail OR nome_id = :pnome');
        $verifica->bindValue(':pemail', $email);
        $verifica->bindValue(':pnome',  $nome);
        $verifica->execute();
        $existente = $verifica->fetch(PDO::FETCH_ASSOC);

        if($existente){
            if($existente['email_cad'] === $email){
                $erro_cadastro = "Este e-mail já está em uso.";
            } else {
                $erro_cadastro = "Este nome de usuário já está em uso.";
            }
        } else {
            $grava = $conn->prepare('INSERT INTO cadastros (id_cad, email_cad, senha_cad, nome_id) VALUES (NULL, :pemail, :psenha, :pnome)');
            $grava->bindValue(':pemail', $email);
            $grava->bindValue(':psenha', $senha);
            $grava->bindValue(':pnome',  $nome);
            $grava->execute();

            $_SESSION['usuario'] = $nome;
            $_SESSION['email']   = $email;

            echo "<script>window.mostrarPopup = true;</script>";
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
    <title>Login</title>
</head>
<body>
    <button class="toggle-theme">☀️ Light</button>
    <div class="login-container">
        <h2>Cadastre-se</h2>
        <form action="index.php" method="POST">
            <label for="">E-mail</label>
            <input type="email" placeholder="Digite seu email" name="email">
            <label for="">Senha</label>
            <input type="password" placeholder="Digite sua senha" name="senha">
            <label for="">Nome de Usuário</label>
            <input type="text" placeholder="Crie um nome de usuário" name="nome">
            <?php if($erro_cadastro): ?>
                <p style="color:#f87171; font-size:13px; margin-top:6px;"><?= $erro_cadastro ?></p>
            <?php endif; ?>
            <button type="submit" name="grava">Cadastrar</button>
        </form>
        <a href="login.php">Já tem uma conta? Faça login agora!</a>
    </div>
    <div class="popup-sucesso" id="popup">
        <div class="popup-box">
            <h3>✅ Sucesso!</h3>
            <p>Cadastro realizado com sucesso!</p>
            <button onclick="fecharPopup()"><a href="inicial.php">Continuar</a></button>
        </div>
    </div>



</body>
</html>