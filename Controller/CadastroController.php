<?php

require_once "../config/config.php";
require_once "../src/Model/UsuarioModel.php";


if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $rm = $_POST["rm"];
        $senha = $_POST["senha"];
        $confirmarSenha = $_POST["confirmarSenha"];

        
        UsuarioModel::cadastrar($nome, $rm, $email, $senha);

        echo "usuario cadastrado";
        header("Location: ../public/PaginaLogin.php");
        exit;
        
}
