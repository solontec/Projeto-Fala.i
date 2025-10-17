<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Gemini\Client;

class ChatModel
{
    public static function gerarResposta($mensagem)
    {
        // Cria o cliente corretamente
        $client = Client::factory([
            'api_key' => getenv('GEMINI_API_KEY') ?: 'AIzaSyCanZLcT_cmDQvWOiseQE1HxTXOU_PoYWY'
        ]);

        // Escolhe o modelo
        $model = $client->geminiPro();

        // Gera a resposta
        $response = $model->generateContent($mensagem);

        // Retorna apenas o texto da resposta
        return $response->text();
    }
}
