<?php
// Caminhos absolutos
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$cssPath = $docRoot . '/lovechat/login/css/style.css';
$cssWebPath = '/lovechat/login/css/style.css';

// Verificação com feedback visual
if (!file_exists($cssPath)) {
    echo "<div style='font-family:Arial;padding:20px;max-width:600px;margin:50px auto;border:2px solid red;border-radius:10px;'>
        <h2 style='color:red'>ERRO: Arquivo CSS não encontrado</h2>
        <p><strong>Caminho verificado:</strong><br>$cssPath</p>
        <p>Por favor:</p>
        <ol>
            <li>Verifique se o arquivo <code>style.css</code> existe neste local</li>
            <li>Confira as permissões do arquivo (deve ser 644)</li>
            <li>Verifique o caminho no Gerenciador de Arquivos</li>
        </ol>
        <p>Se precisar de ajuda, mostre esta mensagem ao suporte.</p>
    </div>";
    exit;
}

require '../includes/header.php';
?>

<div class="login-container register-container">
    <h2>Crie sua conta</h2>
    <form id="registerForm">
        <div class="form-group-row">
            <div class="form-group">
                <label>Nome Completo*</label>
                <input type="text" name="name" required placeholder="Seu nome completo">
            </div>
            <div class="form-group">
                <label>Telefone (WhatsApp)*</label>
                <input type="tel" name="phone" required placeholder="(34) 98765-4321">
            </div>
        </div>
        
        <div class="form-group">
            <label>Email*</label>
            <input type="email" name="email" required placeholder="seu@email.com">
        </div>
        
        <div class="form-group-row">
            <div class="form-group">
                <label>Senha*</label>
                <input type="password" name="password" required placeholder="Mínimo 8 caracteres">
            </div>
            <div class="form-group">
                <label>Confirme a Senha*</label>
                <input type="password" name="passwordConfirm" required placeholder="Digite novamente">
            </div>
        </div>
        
        <div class="terms">
            <input type="checkbox" id="terms" required>
            <label for="terms">Eu li e aceito os <a href="/termos" target="_blank">Termos de Uso</a> e <a href="/privacidade" target="_blank">Política de Privacidade</a></label>
        </div>
        
        <button type="submit">
            <i class="fas fa-user-plus"></i> Criar minha conta
        </button>
    </form>
    
    <div class="login-link">
        Já tem uma conta? <a href="index.php">Faça login aqui</a>
    </div>
</div>

<style>
/* Estilos adicionais específicos para esta página */
.login-link {
    text-align: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

button[type="submit"] i {
    margin-right: 8px;
}
</style>

<script>
// Seu código JavaScript permanece o mesmo
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if(this.password.value !== this.passwordConfirm.value) {
        alert('As senhas não coincidem!');
        return;
    }

    if(!this.terms.checked) {
        alert('Você precisa aceitar os termos de uso!');
        return;
    }

    const formData = {
        name: this.name.value,
        email: this.email.value,
        phone: this.phone.value,
        password: this.password.value
    };
    
    try {
        const response = await fetch('/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Cadastro realizado com sucesso!');
            window.location.href = 'index.php';
        } else {
            alert('Erro: ' + (data.message || 'Falha no cadastro'));
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao cadastrar');
    }
});
</script>

<?php require '../includes/footer.php'; ?>