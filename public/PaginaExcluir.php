<?php
session_start();

// Exemplo: verifica se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Conta</title>
</head>
<body>
    <h1>Excluir Conta</h1>
    <p>Tem certeza de que deseja excluir sua conta? Essa ação não pode ser desfeita!</p>

    <form method="POST" action="../Controller/ExcluirController.php">

        <button type="submit" name="confirmar" value="1">Excluir minha conta</button>
    </form>
</body>
</html>
