<?php
require_once "../src/Model/UsuarioModel.php";

class ExcluirController {

    public static function excluirConta() {
        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            echo "Você precisa estar logado para excluir sua conta.";
            return;
        }

        $id = $_SESSION['usuario_id'];
        $sucesso = UsuarioModel::excluirUsuario($id);

        if ($sucesso) {
            session_destroy();
            header("Location: ../public/PaginaLogin.php?msg=Conta+excluída+com+sucesso");
            exit;
        } else {
            echo "Erro ao excluir a conta ou usuário não encontrado.";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirmar"])) {
    ExcluirController::excluirConta();
}
