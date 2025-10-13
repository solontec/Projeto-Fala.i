<?php

require_once "../../config/config.php";
require_once __DIR__ . '../../model/UsuarioModel.php';


if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $rm = $_POST["rm"];
        $senha = $_POST["senha"];
        $confirmarSenha = $_POST["confirmarSenha"];

        UsuarioModel::cadastrar($nome, $email, $rm, $senha);

        echo "usuario cadastrado";

        
        exit;
        
}
