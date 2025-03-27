<?php
class Config {
    // Banco de Dados
    const DB_HOST = 'localhost';
    const DB_NAME = 'lovechat_db';
    const DB_USER = 'seu_usuario';
    const DB_PASS = 'sua_senha';
    
    // JWT
    const JWT_SECRET = 'seu_segredo_super_secreto';
    const JWT_EXPIRES = 86400; // 1 dia em segundos
    
    // WhatsApp (Twilio)
    const TWILIO_SID = 'seu_account_sid';
    const TWILIO_TOKEN = 'seu_auth_token';
    const TWILIO_PHONE = '+5511999999999';
}