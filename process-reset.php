<?php
require 'conn.php';
$pdo = $conn;

header('Content-Type: application/json');

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

// ─── Valida o token (deve existir e não estar expirado) ───────────────────────
$stmt = $pdo->prepare("
    SELECT id FROM usuarios
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
    UPDATE usuarios
    SET senha = :senha, reset_token = NULL, reset_token_expiry = NULL
    WHERE id = :id
");
$stmt->execute([
    ':senha' => $hash,
    ':id'    => $usuarioEncontrado['id']
]);

echo json_encode(['mensagem' => 'Senha redefinida com sucesso!']);