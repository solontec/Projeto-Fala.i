<?php


require_once "../src/model/UsuarioModel.php";

use Model\ChatModel;

class ChatbotController {

    public static function exibirPagina() {
        $pergunta = $_POST['pergunta'] ?? '';
        $resposta = '';

        if ($pergunta) {
            $resposta = ChatModel::gerarResposta($pergunta);
        }

        include __DIR__ . '/../public/chat.php';
    }
}
