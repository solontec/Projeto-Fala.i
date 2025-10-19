<?php
require_once "../config/config.php";
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../View/PaginaLogin.php");
    exit;
}

$usuario_id = $_SESSION["usuario_id"];

if (isset($_FILES["adicionarFoto"]) && $_FILES["adicionarFoto"]["error"] === UPLOAD_ERR_OK) {
    $fotoTmp = $_FILES["adicionarFoto"]["tmp_name"];
    $fotoNome = basename($_FILES["adicionarFoto"]["name"]);

    
    $pastaDestino = "../uploads/";

    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }

    
    $novoNome = uniqid() . "_" . $fotoNome;
    $caminhoFinal = $pastaDestino . $novoNome;

    if (move_uploaded_file($fotoTmp, $caminhoFinal)) {
        $caminhoBanco = "uploads/" . $novoNome;

        $conn = getConnection();
        $stmt = $conn->prepare("UPDATE usuarios SET imagem_usuario = ? WHERE id = ?");
        $stmt->bind_param("si", $caminhoBanco, $usuario_id);
        $stmt->execute();

        header("Location: ../public/PaginaConta.php");
        exit;
    } else {
        echo "Erro ao mover a imagem.";
    }
} else {
    echo "Nenhuma imagem enviada.";
}
