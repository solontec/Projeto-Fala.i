// Array para armazenar as tarefas
let tarefas = [];

// Gerenciamento do Modo Escuro (igual ao da tela de login)
class ThemeManager {
  constructor() {
    this.init();
  }

  init() {
    // O tema já foi aplicado pelo script inline no head
    // Aqui apenas configuramos o botão e atualizamos o ícone
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
    if (icon) {
      if (theme === "dark") {
        icon.className = "fas fa-sun";
      } else {
        icon.className = "fas fa-moon";
      }
    }
  }

  toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";
    this.setTheme(newTheme);
  }

  setupToggleButton() {
    const toggleButton = document.getElementById("toggle-dark-mode");
    if (toggleButton) {
      toggleButton.addEventListener("click", () => {
        this.toggleTheme();
      });
    }
  }
}

// Função para abrir o modal
function abrirModal() {
  const modal = document.getElementById("modal-overlay");
  modal.classList.add("show");
  document.body.style.overflow = "hidden"; // Impede scroll da página
}

// Função para fechar o modal
function fecharModal() {
  const modal = document.getElementById("modal-overlay");
  modal.classList.remove("show");
  document.body.style.overflow = "auto"; // Restaura scroll da página

  // Limpar formulário
  document.getElementById("form-tarefa").reset();
}

// Função para fechar modal clicando fora dele
document
  .getElementById("modal-overlay")
  .addEventListener("click", function (e) {
    if (e.target === this) {
      fecharModal();
    }
  });


// Função para formatar data (sem erro para data inválida)
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
    return dataString; // Retorna a data original se não conseguir formatar
  }
}

// Animação de fade-in
function observeElements() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-animate");
        }
      });
    },
    {
      threshold: 0.1,
    }
  );
  const fadeElements = document.querySelectorAll(".fade-in");
  fadeElements.forEach((element) => {
    observer.observe(element);
  });
}