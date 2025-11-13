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
      background: #0a0a0a;
      color: #00ff9d;
      margin-top: 60px;
    }

    textarea {
      width: 40%;
      height: 120px;
      margin: 10px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #00ff9d;
      padding: 8px;
      resize: none;
      background: #1a1a1a;
      color: #00ff9d;
    }

    button, select {
      background: #00ff9d;
      color: #0a0a0a;
      border: none;
      padding: 10px 20px;
      margin: 10px;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
    }

    button:hover {
      background: #00e68a;
    }

    #resultado {
      font-weight: bold;
      font-size: 18px;
      margin-top: 20px;
      white-space: pre-line;
    }
  </style>
</head>
<body>
  <h1>🎤 Aquecimento de Voz</h1>
  <p>1️⃣ Escolha o nível • 2️⃣ Clique em "Gerar Texto" • 3️⃣ Leia em voz alta com "Ler"</p>

  <div>
    <label for="nivel">Dificuldade:</label>
    <select id="nivel">
      <option value="1">Nível 1 (Fácil)</option>
      <option value="2">Nível 2 (Médio)</option>
      <option value="3">Nível 3 (Difícil)</option>
    </select>
  </div>

  <div>
    <textarea id="texto" placeholder="Texto gerado aqui..." readonly></textarea>
    <textarea id="textoLido" placeholder="Texto reconhecido..." readonly></textarea>

  </div>

  <div>
    <button onclick="gerarTexto()">Gerar Texto</button>
    <button onclick="lerTexto()">Ler</button>
  </div>

  <p id="resultado"></p>


<script>
let tempoInicio = 0;   // armazena o início da fala
let tempoFim = 0;      // armazena o fim

function gerarTexto() {
  const nivel = document.getElementById("nivel").value;
  fetch("gerar_texto.php?nivel=" + nivel)
    .then(res => res.text())
    .then(texto => {
      document.getElementById("texto").value = texto;
      document.getElementById("textoLido").value = "";
      document.getElementById("resultado").innerHTML = "";
    })
    .catch(err => alert("Erro ao gerar texto: " + err));
}

function normalizarTexto(texto) {
  return texto
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/[.,!?;:]/g, "")
    .toLowerCase()
    .trim();
}

function similaridade(a, b) {
  if (a === b) return true;

  let dp = Array(a.length + 1).fill().map(() => Array(b.length + 1).fill(0));
  for (let i = 0; i <= a.length; i++) dp[i][0] = i;
  for (let j = 0; j <= b.length; j++) dp[0][j] = j;

  for (let i = 1; i <= a.length; i++) {
    for (let j = 1; j <= b.length; j++) {
      const custo = a[i - 1] === b[j - 1] ? 0 : 1;
      dp[i][j] = Math.min(
        dp[i - 1][j] + 1,
        dp[i][j - 1] + 1,
        dp[i - 1][j - 1] + custo
      );
    }
  }

  return dp[a.length][b.length] <= 1;
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

  // ✅ INICIA O TEMPORIZADOR AO COMEÇAR A FALAR
  recognition.onstart = () => {
    tempoInicio = performance.now();
    document.getElementById("resultado").innerHTML = "🎙️ Fale agora...";
  };

  // ✅ TERMINA O TEMPORIZADOR QUANDO FINALIZA O ÁUDIO
  recognition.onresult = (event) => {
    tempoFim = performance.now();
    const segundos = ((tempoFim - tempoInicio) / 1000).toFixed(2);

    const textoLido = event.results[0][0].transcript;
    document.getElementById("textoLido").value = textoLido;
    compararTextos(segundos);
  };

  recognition.onerror = (event) => {
    alert("Erro no reconhecimento: " + event.error);
  };
}

function compararTextos(tempo) {
  const original = normalizarTexto(document.getElementById("texto").value);
  const lido = normalizarTexto(document.getElementById("textoLido").value);

  const palavrasOriginais = original.split(/\s+/);
  const palavrasLidas = lido.split(/\s+/);

  let acertos = 0;
  let resultadoVisual = "";

  palavrasOriginais.forEach((palavraOriginal, index) => {
    const palavraFalada = palavrasLidas[index] || "";

    if (similaridade(palavraOriginal, palavraFalada)) {
      acertos++;
      resultadoVisual += `<span style="color:#00ff00; font-weight:bold;">${palavraOriginal}</span> `;
    } else {
      resultadoVisual += `<span style="color:#ff4747; font-weight:bold; text-decoration: underline;">${palavraOriginal}</span> `;
    }
  });

  const erros = palavrasOriginais.length - acertos;
  const nota = Math.max(0, 10 - erros);

  document.getElementById("resultado").innerHTML = `
    🕒 Tempo: <strong>${tempo} segundos</strong><br><br>
    ✅ Acertos: ${acertos}/${palavrasOriginais.length}<br>
    ❌ Erros: ${erros}<br>
    🏆 Nota: <strong>${nota}/10</strong>
    <hr>
    <div style="font-size: 18px;">${resultadoVisual}</div>
  `;
}
</script>
  <script src="static/PaginaAcessibilidade/PaginaAcessibilidade.js"></script>
</body>
</html>
