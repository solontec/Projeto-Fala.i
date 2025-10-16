<?php
require_once "../src/model/UsuarioModel.php";
require_once "../config/smtp.php";

class AuthController {

    public static function esqueciSenha() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $rm = $_POST['rm'];

            $usuario = UsuarioModel::buscarUsuarioPorRmEEmail($rm, $email);

            if (!$usuario) {
                echo "<script>alert('Usuário não encontrado! Verifique seu RM e email.');window.location.href='../public/PaginaEsqueciSenha/PaginaEsqueciSenha.html';</script>";
                exit;
            }

            // Links
            $linkRedefinicao = "https://chatbot-tcc.onrender.com/nova_senha";
            $linkSuporte = "http://localhost:5000/inicio?email=" . urlencode($email);

            $emailEnviado = enviarEmailRedefinicao($email, $rm, $linkRedefinicao, $linkSuporte);

            if ($emailEnviado) {
                echo "<script>alert('Email enviado com sucesso! Verifique sua caixa de entrada.');window.location.href='../public/index.php';</script>";
            } else {
                echo "<script>alert('Erro ao enviar o email. Tente novamente.');window.location.href='../public/PaginaEsqueciSenha/PaginaEsqueciSenha.html';</script>";
            }
        }
    }
}
