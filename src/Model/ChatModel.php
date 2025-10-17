<?php
require __DIR__ . '/../../vendor/autoload.php';

use Google\GenerativeAI\Client;
use Google\GenerativeAI\GenerativeModel;

class ChatModel
{
    public static function gerarResposta($pergunta)
    {
        // 🧠 Sua chave da API Gemini
        $apiKey = 'AIzaSyCanZLcT_cmDQvWOiseQE1HxTXOU_PoYWY'; // <-- substitua pela sua chave

        try {
            // Cria o cliente
            $client = new Client([
                'api_key' => $apiKey
            ]);

            // Cria o modelo Gemini
            $model = new GenerativeModel('gemini-1.5-flash', $client);

            // Gera o conteúdo
            $result = $model->generateContent($pergunta);

            // Retorna o texto gerado
            return $result->getText() ?? 'Não consegui gerar uma resposta.';
        } catch (Exception $e) {
            return 'Erro ao gerar resposta: ' . $e->getMessage();
        }
    }
}
?>
