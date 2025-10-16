<?php
require_once __DIR__ . '/../Model/ChatModel.php';

class ChatbotController
{
    public static function exibirPagina()
    {
        $pergunta = '';
        $resposta = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pergunta = $_POST['pergunta'] ?? '';

            if (!empty($pergunta)) {
                $resposta = ChatModel::gerarResposta($pergunta);
            } else {
                $resposta = 'Por favor, digite uma pergunta.';
            }
        }

        include __DIR__ . '/../../PaginaChatbot.php';
    }

    public static function api()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $pergunta = $data['message'] ?? '';

        if (!empty($pergunta)) {
            $resposta = ChatModel::gerarResposta($pergunta);
            echo json_encode(['resposta' => $resposta]);
        } else {
            echo json_encode(['resposta' => 'Pergunta inválida.']);
        }

        exit;
    }
}
?>
