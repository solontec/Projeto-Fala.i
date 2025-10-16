<?php
require_once "../config/config.php";
require_once "../src/Model/AgendaModel.php";
session_start();

header("Content-Type: application/json"); // todas as respostas serão JSON


$method = $_SERVER["REQUEST_METHOD"];
$action = $_GET["action"] ?? null; // ex: AgendaController.php?action=listar

if ($method === "POST" && !$action) {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $dataHora = $_POST["data_tarefa"];
    $usuario_id = $_SESSION["usuario_id"] ?? 1; // temporário

    if (AgendaModel::criarTarefa($usuario_id, $titulo, $descricao, $dataHora)) {
        echo json_encode(["success" => true, "message" => "Tarefa cadastrada com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao cadastrar tarefa."]);
    }
    exit;
}


if ($method === "GET" && $action === "listar") {
    $usuario_id = $_SESSION["usuario_id"] ?? 1;

    $tarefas = AgendaModel::listarTarefas($usuario_id);

    echo json_encode([
        "success" => true,
        "tarefas" => $tarefas
    ]);
    exit;
}


echo json_encode([
    "success" => false,
    "message" => "Rota inválida ou método não suportado."
]);
exit;

if ($method === "POST" && $action === "editar") {
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $dataHora = $_POST["data_tarefa"];
    $usuario_id = $_SESSION["usuario_id"] ?? 1;

    if (AgendaModel::editarTarefa($id, $usuario_id, $titulo, $descricao, $dataHora)) {
        echo json_encode(["success" => true, "message" => "Tarefa atualizada com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao atualizar tarefa."]);
    }
    exit;
}

if ($method === "POST" && $action === "excluir") {
    $id = $_POST["id"];
    $usuario_id = $_SESSION["usuario_id"] ?? 1;

    if (AgendaModel::excluirTarefa($id, $usuario_id)) {
        echo json_encode(["success" => true, "message" => "Tarefa excluída com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao excluir tarefa."]);
    }
    exit;
}

