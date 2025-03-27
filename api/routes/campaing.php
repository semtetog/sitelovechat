<?php
// Verificar token JWT
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
$token = str_replace('Bearer ', '', $authHeader);

try {
    $decoded = JWT::decode($token, new Key(Config::JWT_SECRET, 'HS256'));
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode(["message" => "Acesso não autorizado"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $uriParts[3] === 'status') {
    // Obter status da campanha do banco de dados
    $campaign = []; // Substituir por consulta real
    
    http_response_code(200);
    echo json_encode($campaign);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $uriParts[3] === 'toggle') {
    // Atualizar status no banco de dados
    $data = json_decode(file_get_contents("php://input"));
    
    // Aqui você pode enviar um email/notificação para você
    mail('seu@email.com', 'Campanha Alterada', "Usuário {$decoded->data->user_id} alterou status para {$data->status}");
    
    http_response_code(200);
    echo json_encode(["success" => true]);
    exit;
}