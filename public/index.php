<?php
// Mostrar erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Controller do chatbot
require_once __DIR__ . '/../Controller/ChatbotController.php';

// Exibe a página
ChatbotController::exibirPagina();
