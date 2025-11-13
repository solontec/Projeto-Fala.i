// ===============================
// CLASSE DE ACESSIBILIDADE
// ===============================
class Acessibilidade {
  constructor() {
    this.estado = {
      espacamento: 0,
    };
    this.carregarPreferencias();
  }

  salvarPreferencias() {
    localStorage.setItem("preferenciasAcessibilidade", JSON.stringify(this.estado));
  }

  carregarPreferencias() {
    const salvo = localStorage.getItem("preferenciasAcessibilidade");
    if (salvo) {
      this.estado = JSON.parse(salvo);
    }
    this.aplicarPreferencias();
  }

  aplicarPreferencias() {
    document.documentElement.style.letterSpacing = `${this.estado.espacamento}px`;
  }

  alterarEspacamento(acao) {
    if (acao === "aumentar" && this.estado.espacamento < 5) this.estado.espacamento += 0.5;
    if (acao === "diminuir" && this.estado.espacamento > 0) this.estado.espacamento -= 0.5;
    this.aplicarPreferencias();
    this.salvarPreferencias();
  }

  resetar() {
    this.estado = { espacamento: 0 };
    this.aplicarPreferencias();
    this.salvarPreferencias();
  }
}

// ===============================
// GESTOR DE TEMA (corrigido e funcional)
// ===============================
class ThemeManager {
  constructor() {
    this.init();
  }

  init() {
    const savedTheme = localStorage.getItem("theme");
    const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
    const theme = savedTheme || systemTheme;

    document.documentElement.setAttribute("data-theme", theme);
    this.updateIcons(theme);

    const toggleButtons = document.querySelectorAll(
      "#toggle-dark-mode, #toggle-dark-mode-card, .toggle-theme, [data-toggle-theme]"
    );

    toggleButtons.forEach((button) => {
      button.addEventListener("click", () => this.toggleTheme());
    });
  }

  toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";
    document.documentElement.setAttribute("data-theme", newTheme);
    localStorage.setItem("theme", newTheme);
    this.updateIcons(newTheme);
  }

  updateIcons(theme) {
    const icons = document.querySelectorAll("#theme-icon, #theme-icon-card, .toggle-theme i");
    icons.forEach((icon) => {
      if (theme === "dark") {
        icon.classList.remove("fa-moon");
        icon.classList.add("fa-sun");
      } else {
        icon.classList.remove("fa-sun");
        icon.classList.add("fa-moon");
      }
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new ThemeManager();
});



// ===============================
// EXECUÇÃO
// ===============================
document.addEventListener("DOMContentLoaded", () => {
  // Inicia acessibilidade e tema só após o DOM carregar
  window.acessibilidade = new Acessibilidade();

  const themeManager = new ThemeManager();
  themeManager.init();

  // Garante que o tema seja aplicado corretamente ao abrir a página
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme) {
    document.documentElement.setAttribute("data-theme", savedTheme);
  }
});
