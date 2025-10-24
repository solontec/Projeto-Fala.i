<?php
function enviarMensagemGemini($mensagem) {
    $url = "http://localhost:5000/mensagem"; // o servidor Flask

    $dados = json_encode(["mensagem" => $mensagem]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);

    $resposta = curl_exec($ch);
    curl_close($ch);

    return json_decode($resposta, true);
}
