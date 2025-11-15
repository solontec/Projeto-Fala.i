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

class ThemeManager {
  constructor() {
    this.init();
  }

  init() {
    const currentTheme =
      localStorage.getItem("theme") ||
      document.documentElement.getAttribute("data-theme") ||
      "light";

    document.documentElement.setAttribute("data-theme", currentTheme);
    this.updateToggleIcon(currentTheme);
    this.setupToggleButton();
  }

  setTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
    this.updateToggleIcon(theme);
  }

  updateToggleIcon(theme) {
    const icon = document.getElementById("theme-icon");
    if (icon) icon.className = theme === "dark" ? "fas fa-sun" : "fas fa-moon";
  }

  toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-theme");
    this.setTheme(currentTheme === "dark" ? "light" : "dark");
  }

  setupToggleButton() {
    const toggleButton = document.getElementById("toggle-dark-mode");
    if (toggleButton) {
      toggleButton.addEventListener("click", () => this.toggleTheme());
    }
  }
}


// Intersection Observer para fade in
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-animate")
        }
      })
    },
    {
      threshold: 0.1,
      rootMargin: "-50px",
    },
  )
  // Observar todos os elementos com classe fade-in
  const fadeElements = document.querySelectorAll(".fade-in")
  fadeElements.forEach((el) => observer.observe(el))
})

// Animação de fade-in
function observeElements() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-animate")
        }
      })
    },
    {
      threshold: 0.1,
    },
  )
  const fadeElements = document.querySelectorAll(".fade-in")
  fadeElements.forEach((element) => {
    observer.observe(element)
  })
}


document.addEventListener("DOMContentLoaded", () => {
  new ThemeManager();
  observeElements();
});