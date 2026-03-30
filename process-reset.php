<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(0);
require 'conn.php';
$pdo = $conn;

ob_clean();
header('Content-Type: application/json');

set_exception_handler(function($e) {
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode(['erro' => $e->getMessage()]); // ← mostra o erro real
    exit;
});

// ─── Recebe os dados ──────────────────────────────────────────────────────────
$token      = trim($_POST['token'] ?? '');
$nova_senha = trim($_POST['nova_senha'] ?? '');

if (empty($token) || empty($nova_senha)) {
    echo json_encode(['erro' => 'Dados incompletos.']);
    exit;
}

if (strlen($nova_senha) < 6) {
    echo json_encode(['erro' => 'A senha deve ter pelo menos 6 caracteres.']);
    exit;
}

$stmt = $pdo->prepare("
    SELECT id_cad FROM cadastros
    WHERE reset_token = :token AND reset_token_expiry > NOW()
    LIMIT 1
");
$stmt->execute([':token' => $token]);
$usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuarioEncontrado) {
    echo json_encode(['erro' => 'Token inválido ou expirado. Solicite um novo link.']);
    exit;
}

// ─── Atualiza a senha e limpa o token ────────────────────────────────────────
$hash = password_hash($nova_senha, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("
    UPDATE cadastros
    SET senha_cad = :senha, reset_token = NULL, reset_token_expiry = NULL
    WHERE id_cad = :id
");
$ok = $stmt->execute([
    ':senha' => $hash,
    ':id'    => $usuarioEncontrado['id_cad']
]);
if ($ok) {
    echo json_encode(['mensagem' => 'Senha redefinida com sucesso!']);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Falha ao atualizar a senha.']);
}
exit;