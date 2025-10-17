<?php
require_once "../config/config.php";
require_once "../src/Model/AgendaModel.php";
session_start();

$method = $_SERVER["REQUEST_METHOD"];
$action = $_POST["acao"] ?? $_GET["action"] ?? null;
$usuario_id = $_SESSION["usuario_id"] ?? 1;

// --- Criar tarefa ---
if ($method === "POST" && $action === "criar") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $dataHora = $_POST["data_tarefa"];

    if (AgendaModel::criarTarefa($usuario_id, $titulo, $descricao, $dataHora)) {
        header("Location: ../View/PaginaAgenda.php?msg=sucesso");
    } else {
        header("Location: ../View/PaginaAgenda.php?msg=erro");
    }
    exit;
}

// --- Editar tarefa ---
if ($method === "POST" && $action === "editar") {
    $id = $_POST["tarefa_id"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $dataHora = $_POST["data_tarefa"];

    if (AgendaModel::editarTarefa($id, $usuario_id, $titulo, $descricao, $dataHora)) {
        header("Location: ../View/PaginaAgenda.php?msg=atualizado");
    } else {
        header("Location: ../View/PaginaAgenda.php?msg=erro");
    }
    exit;
}

// --- Excluir tarefa ---
if ($method === "POST" && $action === "excluir") {
    $id = $_POST["tarefa_id"];

    if (AgendaModel::excluirTarefa($id, $usuario_id)) {
        header("Location: ../View/PaginaAgenda.php?msg=excluido");
    } else {
        header("Location: ../View/PaginaAgenda.php?msg=erro");
    }
    exit;
}

// --- Listar tarefas (opcional via GET) ---
if ($method === "GET" && $action === "listar") {
    $tarefas = AgendaModel::listarTarefas($usuario_id);
    echo json_encode($tarefas);
    exit;
}

echo "Rota inválida ou método não suportado.";
exit;
?>
