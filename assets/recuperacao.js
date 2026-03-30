// ─── Verifica se há token na URL ─────────────────────────────────────────────
const params = new URLSearchParams(window.location.search);
const token  = params.get('token');

if (token) {
    document.getElementById('formRecuperacaoContainer').style.display = 'none';
    document.getElementById('formResetContainer').style.display       = 'block';
}

// ─── Formulário 1: Enviar e-mail de recuperação ───────────────────────────────
document.getElementById('formRecuperacao').addEventListener('submit', async function (e) {
    e.preventDefault();

    const btn = document.getElementById('btnEnviar');
    const erro = document.getElementById('mensagem-erro');
    const email = document.getElementById('email').value;

    btn.disable = true;
    btn.textContent = 'Enviando...';
    erro.style.display = 'none';

    try {
        const response = await fetch('forget-pw.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `email=${encodeURIComponent(email)}`
        });
        const data = await response.json()

        if (data.erro) {
            erro.textContent = data.erro;
            erro.style.display = 'block';
        } else {
            document.getElementById('popup').style.display = 'flex';
        }
    } catch (err){
        erro.textContent = 'Erro de conexão. Tente novamente.';
        erro.style.display = 'block';
    } finally {
        btn.disable = false;
        btn.textContent = 'Enviar código para redefinir';
    }
});

// ─── Formulário 2: Salvar nova senha ─────────────────────────────────────────
document.getElementById('formReset').addEventListener('submit', async function(e) {
    e.preventDefault();

    const btn            = document.getElementById('btnSalvar');
    const erro           = document.getElementById('erroReset');
    const novaSenha      = document.getElementById('nova_senha').value;
    const confirmarSenha = document.getElementById('confirmar_senha').value;

    erro.style.display = 'none';

    if (novaSenha !== confirmarSenha) {
        erro.textContent   = 'As senhas não coincidem.';
        erro.style.display = 'block';
        return;
    }

    if (novaSenha.length < 6) {
        erro.textContent   = 'A senha deve ter pelo menos 6 caracteres.';
        erro.style.display = 'block';
        return;
    }

    btn.disabled    = true;
    btn.textContent = 'Salvando...';

    try {
        const response = await fetch('process-reset.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `token=${encodeURIComponent(token)}&nova_senha=${encodeURIComponent(novaSenha)}`
        });

        const data = await response.json();

        if (data.erro) {
            if (data.erro.includes('inválido') || data.erro.includes('expirado')) {
                document.getElementById('formResetContainer').style.display = 'none';
                document.getElementById('tokenInvalido').style.display      = 'block';
            } else {
                erro.textContent   = data.erro;
                erro.style.display = 'block';
            }
        } else {
            document.getElementById('popupSenha').style.display = 'flex';
        }
    } catch (err) {
    erro.textContent = 'Erro: ' + err.message;
    erro.style.display = 'block';
    console.error(err);
    } finally {
        btn.disabled    = false;
        btn.textContent = 'Salvar nova senha';
    }
});