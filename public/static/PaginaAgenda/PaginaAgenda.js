// ===============================
// 📦 GESTÃO DE MODAL
// ===============================
window.abrirModal = function () {
  const modal = document.getElementById("modal-overlay");
  modal.classList.add("show");
  document.body.style.overflow = "hidden";

  // Define modo "criar"
  document.getElementById("form-acao").value = "criar";
  document.getElementById("form-tarefa-id").value = "";
  document.querySelector(".modal-content h2").innerText = "Adicionar Nova Tarefa";
  document.querySelector(".submit-btn").innerText = "Adicionar Tarefa";
};

window.fecharModal = function () {
  const modal = document.getElementById("modal-overlay");
  modal.classList.remove("show");
  document.body.style.overflow = "auto";
  document.getElementById("form-tarefa").reset();

  // Restaura modo "criar"
  document.getElementById("form-acao").value = "criar";
  document.getElementById("form-tarefa-id").value = "";
  document.querySelector(".modal-content h2").innerText = "Adicionar Nova Tarefa";
  document.querySelector(".submit-btn").innerText = "Adicionar Tarefa";
};

// Fecha modal clicando fora
document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("modal-overlay");
  if (overlay) {
    overlay.addEventListener("click", (e) => {
      if (e.target === overlay) fecharModal();
    });
  }
});

// Fecha com tecla ESC
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") fecharModal();
});

// ===============================
// ✏️ ABRIR MODAL DE EDIÇÃO
// ===============================
window.abrirModalEditar = function (id, titulo, descricao, dataHora) {
  const modal = document.getElementById("modal-overlay");
  modal.classList.add("show");
  document.body.style.overflow = "hidden";

  // Preenche o formulário
  document.getElementById("form-acao").value = "editar";
  document.getElementById("form-tarefa-id").value = id;
  document.getElementById("nome-tarefa").value = titulo;
  document.getElementById("descricao-tarefa").value = descricao;
  document.getElementById("data-tarefa").value = dataHora;

  // Atualiza título e botão
  document.querySelector(".modal-content h2").innerText = "Editar Tarefa";
  document.querySelector(".submit-btn").innerText = "Salvar Alterações";
};

// ===============================
// 🌙 GERENCIAMENTO DE TEMA (DARK/LIGHT)
// ===============================
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

// ===============================
// 🎞️ ANIMAÇÃO FADE-IN
// ===============================
function observeElements() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-animate");
        }
      });
    },
    { threshold: 0.1 }
  );

  document.querySelectorAll(".fade-in").forEach((el) => observer.observe(el));
}

// ===============================
// 🗓️ FORMATAR DATA
// ===============================
function formatarData(dataString) {
  if (!dataString) return "Data não informada";
  try {
    const data = new Date(dataString);
    const opcoes = {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    };
    return data.toLocaleDateString("pt-BR", opcoes);
  } catch (error) {
    return dataString;
  }
}

// ===============================
// 🚀 INICIALIZAÇÃO
// ===============================
document.addEventListener("DOMContentLoaded", () => {
  new ThemeManager();
  observeElements();
});
