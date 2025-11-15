const textarea = document.getElementById("pergunta");
const form = document.getElementById("form");

if (textarea) {
  textarea.addEventListener("keydown", (event) => {
    if (event.key === "Enter" && !event.shiftKey) {
      event.preventDefault();
      form.dispatchEvent(new Event("submit"));
    }
  });
}

function toggleMobileMenu() {
  const navMenu = document.getElementById("nav-menu");
  navMenu.classList.toggle("mobile-active");
}

class ThemeManager {
  constructor() {
    this.init();
  }
  init() {
    const currentTheme =
      document.documentElement.getAttribute("data-theme") || "light";
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
    const newTheme = currentTheme === "dark" ? "light" : "dark";
    this.setTheme(newTheme);
  }
  setupToggleButton() {
    const toggleButton = document.getElementById("toggle-dark-mode");
    if (toggleButton)
      toggleButton.addEventListener("click", () => this.toggleTheme());
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new ThemeManager();
  observeElements();
});

function observeElements() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) entry.target.classList.add("fade-animate");
      });
    },
    { threshold: 0.1 }
  );
  document.querySelectorAll(".fade-in").forEach((el) => observer.observe(el));
}

// ---------------- Voice recognition + Chat behavior (integrado e preservando seu código) ----------------
let recognition;
let isRecording = false;

if ("webkitSpeechRecognition" in window || "SpeechRecognition" in window) {
  const SpeechRecognition =
    window.SpeechRecognition || window.webkitSpeechRecognition;
  recognition = new SpeechRecognition();
  recognition.lang = "pt-BR";
  recognition.interimResults = false;
  recognition.continuous = false;

  recognition.onresult = async function (event) {
    const transcript = event.results[0][0].transcript;
    stopRecording();

    // MOSTRA "Áudio" NA TELA
    mostrarMensagemUsuario("🎤 Áudio");

    // MAS ENVIA A TRANSCRIÇÃO REAL PARA A IA
    await enviarMensagemGemini(transcript);
  };

  recognition.onerror = function (event) {
    console.error("Erro no reconhecimento:", event.error);
    stopRecording();
  };
}

const btnFalar = document.getElementById("btn-falar");
const btnParar = document.getElementById("btn-parar");

if (btnFalar) {
  btnFalar.addEventListener("click", () => {
    if (!recognition)
      return alert("Seu navegador não suporta reconhecimento de voz ");
    recognition.start();
    isRecording = true;
    btnFalar.disabled = true;
    btnParar.disabled = false;
  });
}

if (btnParar) {
  btnParar.addEventListener("click", () => stopRecording());
}

function stopRecording() {
  if (recognition && isRecording) {
    recognition.stop();
    isRecording = false;
    if (btnFalar) btnFalar.disabled = false;
    if (btnParar) btnParar.disabled = true;
  }
}

// Função para mostrar mensagem do usuário no chat (reaproveitável)
function mostrarMensagemUsuario(texto) {
  const mainContainer =
    document.getElementById("chat-container") ||
    document.querySelector(".main-container");
  const divUser = document.createElement("div");
  divUser.className = "user-message";
  // usa textContent por segurança (escape automático)
  divUser.textContent = texto;
  mainContainer.appendChild(divUser);
  mainContainer.scrollTop = mainContainer.scrollHeight;
}

// Listener do form (envio por texto) - previne reload e usa envio AJAX local
const formChat = document.getElementById("form");
formChat.addEventListener("submit", async function (e) {
  e.preventDefault();
  const input = document.getElementById("pergunta");
  const texto = input.value.trim();
  if (!texto) return;

  mostrarMensagemUsuario(texto);
  input.value = "";

  // envia para Gemini (via sua API local / flask)
  await enviarMensagemGemini(texto);
});

// Envia para a rota local do Gemini (mesma lógica que você já tinha)
async function enviarMensagemGemini(texto) {
  try {
    const response = await fetch("http://localhost:5000/mensagem", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ mensagem: texto }),
    });

    const data = await response.json();
    const resposta = data.resposta || "Erro na resposta do servidor.";

    const mainContainer =
      document.getElementById("chat-container") ||
      document.querySelector(".main-container");
    const divResposta = document.createElement("div");
    divResposta.className = "resposta-animada";
    // usa innerText/creation segura: cria elementos para evitar XSS se quiser trocar depois
    // >>> ALTERAÇÃO: usar marked + DOMPurify para formatar e sanitizar
    const htmlFromMd = marked.parse(resposta);
    const safeHtml = DOMPurify.sanitize(htmlFromMd);
    divResposta.innerHTML = `<strong>Fala.i:</strong><div class="fala-formatada">${safeHtml}</div>`;
    mainContainer.appendChild(divResposta);

    mainContainer.scrollTop = mainContainer.scrollHeight;
  } catch (err) {
    console.error("Erro ao enviar para Gemini:", err);
    // opcional: mostrar mensagem de erro ao usuário
    const mainContainer =
      document.getElementById("chat-container") ||
      document.querySelector(".main-container");
    const divResposta = document.createElement("div");
    divResposta.className = "resposta-animada";
    divResposta.innerHTML = `<strong>Fala.i:</strong><p>Erro ao comunicar com o servidor.</p>`;
    mainContainer.appendChild(divResposta);
    mainContainer.scrollTop = mainContainer.scrollHeight;
  }
}
