

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquecimento de Voz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f8f9fa;
            margin-top: 60px;
        }

        textarea {
            width: 40%;
            height: 120px;
            margin: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 8px;
            resize: none;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        #resultado {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>🎤 Aquecimento de Voz</h1>
    <p>1️⃣ Clique em "Gerar Texto"<br>2️⃣ Leia em voz alta com "Ler"<br>3️⃣ Veja sua nota!</p>

    <div>
        <textarea id="texto" placeholder="Texto gerado aqui..."></textarea>
        <textarea id="textoLido" placeholder="Texto lido (gerado automaticamente)..."></textarea>
    </div>

    <div>
        <button onclick="gerarTexto()">Gerar Texto</button>
        <button onclick="lerTexto()">Ler</button>
    </div>

    <p id="resultado"></p>

    <script>
function gerarTexto() {
  fetch('gerar_texto.php')
    .then(res => res.text())
    .then(texto => {
      document.getElementById('texto').value = texto;
      document.getElementById('textoLido').value = "";
      document.getElementById('resultado').innerText = "";
    })
    .catch(err => alert("Erro ao gerar texto: " + err));
}

function lerTexto() {
  if (!('webkitSpeechRecognition' in window)) {
    alert("Seu navegador não suporta reconhecimento de voz.");
    return;
  }

  const recognition = new webkitSpeechRecognition();
  recognition.lang = "pt-BR";
  recognition.continuous = false;
  recognition.interimResults = false;

  recognition.start();

  recognition.onstart = function() {
    document.getElementById('resultado').innerText = "🎙️ Fale agora...";
  };

  recognition.onresult = function(event) {
    const textoLido = event.results[0][0].transcript;
    document.getElementById('textoLido').value = textoLido;
    compararTextos();
  };

  recognition.onerror = function(event) {
    alert("Erro no reconhecimento: " + event.error);
  };
}

// 🔍 Função que compara e mostra o que o usuário errou
function compararTextos() {
  const original = document.getElementById('texto').value.trim().toLowerCase();
  const lido = document.getElementById('textoLido').value.trim().toLowerCase();

  const palavrasOriginais = original.split(/\s+/);
  const palavrasLidas = lido.split(/\s+/);

  let acertos = 0;
  let palavrasCorretas = [];
  let palavrasErradas = [];

  const palavrasFaladas = new Set(palavrasLidas);

  // Verifica o que foi falado certo ou não
  palavrasOriginais.forEach(p => {
    if (palavrasFaladas.has(p)) {
      acertos++;
      palavrasCorretas.push(p);
    } else {
      palavrasErradas.push(p);
    }
  });

  const porcentagem = (acertos / palavrasOriginais.length) * 100;
  const nota = Math.round(porcentagem / 10);

  // 🧠 Monta o resultado completo
  let resultadoTexto = `✅ Acertos: ${porcentagem.toFixed(1)}% — 🏆 Nota: ${nota}/10\n\n`;

  if (palavrasErradas.length > 0) {
    resultadoTexto += `❌ Palavras que você errou ou esqueceu:\n${palavrasErradas.join(", ")}\n\n`;
  }

  if (palavrasCorretas.length > 0) {
    resultadoTexto += `✅ Palavras corretas:\n${palavrasCorretas.join(", ")}`;
  }

  document.getElementById('resultado').innerText = resultadoTexto;
}
</script>

</body>
</html>
