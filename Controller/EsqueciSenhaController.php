<?php
require_once "../src/Model/UsuarioModel.php";
require_once "../config/SmtpConfig.php";
require_once "..//config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $rm = trim($_POST['rm']);

    $usuario = UsuarioModel::buscarUsuarioPorRmEEmail($rm, $email);

    if (!$usuario) {
        echo "<script>alert('Usuário não encontrado. Verifique o e-mail e o RM.'); window.history.back();</script>";
        exit;
    }

    // Gera token e expiração
    $token = bin2hex(random_bytes(32));
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO redefinicoes_senha (email, token, expira_em) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $token, $expira);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Links
    $linkRedefinicao = "http://localhost:9090/public/PaginaNovaSenha.php?token=" . $token;
    $linkSuporte = "http://localhost/FalaI/public/PaginaSuporte.php";

    if (enviarEmailRedefinicao($email, $rm, $linkRedefinicao, $linkSuporte)) {
        echo "<script>alert('Um link foi enviado para seu e-mail. Verifique sua caixa de entrada.'); window.location.href='../public/PaginaLogin.php';</script>";
    } else {
        echo "<script>alert('Erro ao enviar o e-mail. Tente novamente mais tarde.'); window.history.back();</script>";
    }
}
