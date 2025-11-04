<?php
header("Content-Type: text/plain; charset=UTF-8");

// 🔥 Recebe o nível (caso venha via GET, ex: gerar_texto.php?nivel=2)
$nivel = isset($_GET['nivel']) ? intval($_GET['nivel']) : 1;

// 🧠 Textos de aquecimento — divididos por dificuldade
$textosn1 = [
    "O rato roeu a roupa do rei de Roma.",
    "Três pratos de trigo para três tigres tristes.",
    "Casa suja, chão sujo.",
    "O tempo perguntou ao tempo quanto tempo o tempo tem.",
    "O sabiá sabia assobiar e assobiava o que sabia.",
    "Fala rápido sem tropeçar para aquecer sua voz."
];

$textosn2 = [
    "A aranha arranha a rã, a rã arranha a aranha.",
    "O doce perguntou pro doce qual é o doce mais doce.",
    "O padre pede pão pra pobre prima.",
    "Pinga a pipa na ponta do prego.",
    "O bispo de Constantinopla é um bom desconstantinopolizador."
];

$textosn3 = [
    "Num ninho de mafagafos há sete mafagafinhos.",
    "Bagre branco, branco bagre, bagre branco, branco bagre.",
    "Farofa feita com muita farinha fofa.",
    "Pedro pregou um prego na porta preta.",
    "Três pratos de trigo para três tigres tristes que tropeçam."
];

// 🎚️ Define qual array usar com base no nível
switch ($nivel) {
    case 2:
        $textos = $textosn2;
        break;
    case 3:
        $textos = $textosn3;
        break;
    default:
        $textos = $textosn1;
        break;
}

// 🚨 Segurança: evita erro se o array estiver vazio
if (empty($textos)) {
    echo "Nenhum texto disponível para este nível ainda. 😢";
    exit;
}

// 🎯 Escolhe uma frase aleatória e envia
echo $textos[array_rand($textos)];
?>
