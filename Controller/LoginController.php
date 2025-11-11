<?php
// Arquivo: LoginController.php

require_once "../config/config.php";
require_once "../src/Model/UsuarioModel.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $rm = $_POST["rm"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    
    $usuario = UsuarioModel::logarUsuario($rm, $email, $senha);

    if ($usuario) {
        
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_rm'] = $usuario['rm'];
        $_SESSION['usuario_nome'] = $usuario['nome']; // Adicionado para ser útil

        
        header("Location: ../public/PaginaInicial.php");
        // aqui vou inserir a lógica,
        exit;
    } else {
       
        $_SESSION['erro_login'] = "Credenciais inválidas. Verifique RM, e-mail ou senha.";
        
       
        header("Location: ../public/PaginaLogin.php"); 
        
        
        exit;
    }
}