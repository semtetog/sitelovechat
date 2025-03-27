<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/db.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriParts = explode('/', $requestUri);

// Rotas da API
switch ($uriParts[2]) {
    case 'auth':
        require __DIR__ . '/routes/auth.php';
        break;
    case 'campaign':
        require __DIR__ . '/routes/campaign.php';
        break;
    case 'user':
        require __DIR__ . '/routes/user.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada"]);
        break;
}