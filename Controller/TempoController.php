<?php
session_start();
require_once "../config/config.php";
require_once "../src/Model/RankingModel.php";

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    exit("Usuário não autenticado");
}

$usuario_id = $_SESSION['usuario_id'];

// Adiciona pontos por tempo
RankingModel::adicionarPontos($usuario_id, 'tempo');

echo json_encode(["status" => "ok"]);
