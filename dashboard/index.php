<?php
require '../includes/header.php';

// Verificar token (simplificado para exemplo)
if (!isset($_COOKIE['token'])) {
    header('Location: /login');
    exit;
}
?>

<div class="dashboard">
    <aside class="sidebar">
        <!-- Menu lateral -->
    </aside>
    
    <main class="content">
        <h1>Minha Campanha</h1>
        
        <div class="campaign-status">
            <div class="status-info">
                <span id="statusIndicator" class="indicator"></span>
                <span id="statusText">Carregando...</span>
            </div>
            <label class="switch">
                <input type="checkbox" id="toggleCampaign">
                <span class="slider"></span>
            </label>
        </div>
        
        <div class="campaign-stats">
            <!-- Estatísticas -->
        </div>
    </main>
</div>

<script>
// Obter token do localStorage ou cookie
const token = localStorage.getItem('token') || '<?= $_COOKIE['token'] ?? '' ?>';

// Carregar status da campanha
async function loadCampaignStatus() {
    try {
        const response = await fetch('/api/campaign/status', {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        });
        
        const data = await response.json();
        
        document.getElementById('statusText').textContent = 
            data.status === 'active' ? 'Sua campanha está ATIVA' : 'Sua campanha está INATIVA';
            
        document.getElementById('toggleCampaign').checked = data.status === 'active';
    } catch (error) {
        console.error('Erro:', error);
    }
}

// Alternar status da campanha
document.getElementById('toggleCampaign').addEventListener('change', async function() {
    try {
        const response = await fetch('/api/campaign/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify({
                status: this.checked ? 'active' : 'inactive'
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadCampaignStatus();
        } else {
            alert('Erro ao atualizar status');
            this.checked = !this.checked;
        }
    } catch (error) {
        console.error('Erro:', error);
        this.checked = !this.checked;
    }
});

// Carregar dados iniciais
loadCampaignStatus();
</script>

<?php
require '../includes/footer.php';