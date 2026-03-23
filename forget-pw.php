<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    require 'conn.php';

    $pdo = $conn;

    header('Content-Type: application/json');

    $input = trim($_POST['email'] ?? '');

    if (empty($input)) {
        echo json_encode(['erro' => 'Informe seu e-mail ou nome de usuário.']);
    exit;
    }
        $stmt = $pdo->prepare("
        SELECT id_cad, email_cad from cadastros
        WHERE email_cad = :input OR nome_id = :input
        LIMIT 1
        ");
    $stmt->execute([':input' => $input]);
    $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioEncontrado){
        echo json_encode(['mensagem' => 'Se encontrarmos sua conta, enviaremos o link']);
        exit;
    }

    $token = bin2hex(random_bytes(32));
    $expire = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $stmt = $pdo->prepare("
    UPDATE cadastros
    SET reset_token = :token, reset_token_expiry = :expiry
    WHERE id_cad = :id
    ");
    $stmt->execute([
        ':token' => $token,
        ':expiry' => $expire,
        ':id' => $usuarioEncontrado['id_cad']
    ]);
    $link = "localhost/tela-de-login/esqueceu-senha.php?token=$token";

    $mail = new PHPMailer(true);
 
    try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true
    )
    );
    $mail->Username   = 'guilhermeramos040620@gmail.com';   // ← seu Gmail
    $mail->Password   = 'sqtdoifbosqpentj';      // ← senha de app (16 dígitos sem espaços)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
 
    $mail->setFrom('guilhermeramos040620@gmail.com', 'WorkBY');
    $mail->addAddress($usuarioEncontrado['email_cad']);
    $mail->Subject = 'WorkBY - Redefinição de Senha';
    $mail->isHTML(true);
    $mail->Body = "
        <div style='font-family: sans-serif; max-width: 500px; margin: auto; padding: 32px; border: 1px solid #e5e7eb; border-radius: 8px;'>
            <h2 style='color: #111827;'>Redefinição de Senha</h2>
            <p style='color: #374151;'>Recebemos uma solicitação para redefinir a senha da sua conta <strong>WorkBY</strong>.</p>
            <p style='color: #374151;'>Clique no botão abaixo. O link é válido por <strong>1 hora</strong>.</p>
            <a href='$link' style='
                display: inline-block;
                margin: 16px 0;
                padding: 12px 28px;
                background-color: #4f46e5;
                color: #ffffff;
                text-decoration: none;
                border-radius: 6px;
                font-weight: bold;
            '>Redefinir minha senha</a>
            <p style='color: #6b7280; font-size: 13px;'>Se você não solicitou a redefinição, ignore este e-mail. Sua senha permanece a mesma.</p>
            <hr style='border: none; border-top: 1px solid #e5e7eb; margin-top: 24px;'>
            <p style='color: #9ca3af; font-size: 12px;'>WorkBY - Sistema de Gestão</p>
        </div>
    ";
 
    $mail->AltBody = "Acesse o link para redefinir sua senha (válido por 1 hora): $link";
 
    $mail->send();
    echo json_encode(['mensagem' => 'E-mail enviado com sucesso!']);
 
    } catch (Exception $e) {
    echo json_encode(['erro' => $mail->ErrorInfo]);
    }

?>