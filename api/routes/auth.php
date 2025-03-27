<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $uriParts[3] === 'login') {
    // Lógica de login
    $data = json_decode(file_get_contents("php://input"));
    
    // Validar dados
    // Verificar no banco de dados
    // Gerar token JWT
    
    $token = [
        "iss" => "lovechat",
        "iat" => time(),
        "exp" => time() + Config::JWT_EXPIRES,
        "data" => [
            "user_id" => $user->id,
            "email" => $user->email
        ]
    ];
    
    $jwt = JWT::encode($token, Config::JWT_SECRET, 'HS256');
    
    http_response_code(200);
    echo json_encode([
        "success" => true,
        "token" => $jwt
    ]);
    exit;
}