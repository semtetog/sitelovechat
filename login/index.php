<?php
require '../includes/header.php';
?>

<div class="login-container">
    <h2>Login Love Chat</h2>
    <form id="loginForm">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="register.php">Cadastre-se</a></p>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        email: this.email.value,
        password: this.password.value
    };
    
    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            localStorage.setItem('token', data.token);
            window.location.href = '/dashboard';
        } else {
            alert('Login falhou: ' + (data.message || 'Credenciais inválidas'));
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao fazer login');
    }
});
</script>

<?php
require '../includes/footer.php';