<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Script para aplicar tema INSTANTANEAMENTE -->
    <script>
        (function () {
            // Aplica o tema ANTES da página renderizar
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;

            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Young+Serif&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&family=Young+Serif&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="Images/Captura_de_tela_2025-03-14_174727-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ url_for('static', filename='img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url_for('static', filename='PaginaLogin/PaginaLogin.css') }}">

    <title>Pagina Login Fala.i</title>
    <script src="https://kit.fontawesome.com/345c519b8f.js" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <div class="wave">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Botão de Toggle do Modo Escuro -->
        <button id="toggle-dark-mode" class="toggle-mode" title="Alternar modo escuro">
            <i class="fas fa-moon" id="theme-icon"></i>
        </button>

        <div class="controls">
            <button id="increase-font">A+</button>
            <button id="decrease-font">A-</button>
        </div>

        <div class="tudo">
            <div class="esquerda">
                <div class="titulo-logo">
                    <div class="container-bem-vindo">
                        <div class="titulo-bem-vindo">
                            <h1>Bem Vindo ao FALA.I</h1>
                        </div>
                        <div class="texto-apresentacao-bem-vindo">
                            <p id="texto-apresentacao-bem-vindo"></p>
                        </div>
                        <div class="logo-bem-vindo">
                            <img src="{{ url_for('static', filename='img/logo.png') }}" alt="Logo do Chatbot" id="logo"
                                class="logo">
                        </div>
                    </div>
                </div>
            </div>

            <div class="direita">
                <div class="container-login" id="container-login">
                    <div class="login">
                        <h3>Login</h3>
                        <form method="POST" action="../Controller/LoginController.php" id="form-login"> 
                            <p>E-mail</p>
                            <input type="email" placeholder="Digite seu email" id="email" name="email" required>
                            <div class="linha-rm-senha">
                                <div>
                                    <p>Rm</p>
                                    <input type="text" placeholder="Digite seu Rm" id="rm" required name="rm"
                                        maxlength="5">
                                </div>
                                <div>
                                    <p>Senha</p>
                                    <input type="password" placeholder="Digite sua senha" id="senha" name="senha"
                                        required>
                                </div>
                            </div>
                            <div class="entrar-cadastro">
                                <div class="linha-botoes">
                                    <button type="submit" id="entrar">Entrar</button>
                                    <p id="ou">ou</p>
                                    <a href="/cadastro" id="cadastrar">Cadastrar</a>
                                </div>
                                <a id="esqueci-senha" href="/esqueci_senha">Esqueci minha senha</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>

        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>

        <footer>
            <a href="/termos" id="ver-termos">Ver termos e condições</a>
        </footer>
    </section>

    <script src="{{ url_for('static', filename='PaginaLogin/PaginaLogin.js') }}"></script>

   <style>
    :root {
  /* Modo Claro */
  --fundo-branco: #ffffff;
  --cor-principal: #686bff;
  --hover: #5557ff;
  --cor-terciaria: #7779fd;
  --roxo-claro: #b2b3ff54;
  --cinza-medio: #cfd4d8;
  --roxo: #491f7a;
  --fundo-cinza: #efefef;
  --texto-primario: #686bff;
  --texto-secundario: #c0c0ca;
  --fundo-container: #b2b3ff54;
  --wave-1: #9f90c3;
  --wave-2: #afb0e1;
  --wave-3: #ffffff;
  --wave-bg: #7274cd;
}

/* Modo Escuro */
[data-theme="dark"] {
  --fundo-branco: #1a1a1a;
  --cor-principal: #8b8dff;
  --hover: #7779ff;
  --cor-terciaria: #9b9dff;
  --roxo-claro: #2a2a3a;
  --cinza-medio: #404040;
  --roxo: #6b4f8a;
  --fundo-cinza: #2d2d2d;
  --texto-primario: #b8baff;
  --texto-secundario: #8a8a9a;
  --fundo-container: #2825307e;
  --wave-3: #1a1a1a;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  transition: all 0.4s ease;
}

html,
body {
  overflow-x: hidden;
}

body {
  background-color: var(--roxo-claro);
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

#logo {
  width: 200px;
  margin-top: 10%;
}

.logo {
  animation: pulo 2s infinite;
}

.titulo-bem-vindo {
  color: var(--texto-primario);
  font-family: "Titillium Web", serif;
  font-weight: 400;
  font-style: normal;
  font-size: 27px;
  margin-top: 0;
  cursor: default;
}

.texto-apresentacao-bem-vindo {
  color: var(--texto-primario);
  font-family: "Titillium Web", serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  max-width: 500px;
  cursor: default;
}

h3 {
  font-family: "Titillium Web", sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 40px;
  color: var(--texto-primario);
  margin-bottom: 15px;
  margin-top: -20px;
}

input {
  border-radius: 13px;
  width: 529px;
  height: 36px;
  border: solid 1px var(--cor-principal);
  background-color: var(--fundo-branco);
  color: var(--texto-primario);
  margin-top: 10px;
  margin-bottom: 10px;
  padding: 5px;
}

input::placeholder {
  color: var(--wave-1);
}

.tudo{
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  padding: 6%;
  gap: 50px;
}

.esquerda{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.direita {
  display: flex;
  justify-content: center;
  align-items: center;
}

.container-login {
  position: relative;
  background-color: var(--fundo-container);
  height: auto;
  padding: 40px;
  padding-bottom: 80px;
  width: 90%;
  align-items: center;
  justify-content: center;
  display: flex;
  border-radius: 10px;
  transition: transform 1s ease;
  backdrop-filter: blur(10px);
  border: none;
}

.login {
  padding: 10px 30px 20px 30px;
}

p {
  color: var(--texto-primario);
}

input:focus {
  outline: solid 2px var(--cor-principal);
}

#rm {
  width: 253px;
  height: 36px;
  border: solid 1px var(--cor-principal);
  color: var(--texto-primario);
  background-color: transparent;
}

#senha {
  width: 253px;
  height: 36px;
  border: solid 1px var(--cor-principal);
  background-color: transparent;
  color: var(--texto-primario);
  transition: transform 0.5s ease-in-out;
}

.linha-rm-senha {
  display: flex;
  gap: 20px;
}

#email {
  border: solid 1px var(--cor-principal);
  color: var(--texto-primario);
  background-color: transparent;
}

#texto-apresentacao-bem-vindo {
  color: var(--texto-primario);
  max-width: 500px;
}

.controls {
  position: fixed;
  top: 20px;
  left: 130px;
  z-index: 9999;
  display: flex;
  gap: 4px;
}

.controls button {
  background: none;
  border: none;
  font-size: 15px;
  cursor: pointer;
  color: var(--cor-principal);
  margin: 0;
  display: inline-block;
  max-width: 50px;
}

.controls button:hover {
  text-decoration: underline;
}

/* Botão Toggle Modo Escuro */
.toggle-mode {
  position: fixed;
  top: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: var(--cor-principal);
  color: var(--fundo-branco);
  border: none;
  cursor: pointer;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10000;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.toggle-mode:hover {
  background-color: var(--hover);
  transform: scale(1.1);
}

button{
  background-color: var(--cor-principal);
  border-radius: 10px;
  width: 360px;
  height: 39px;
  border: none;
  font-family: Arial, Helvetica, sans-serif;
  font-weight: 500;
  cursor: pointer;
  color: white;
}

#entrar:hover {
  background-color: var(--hover);
}

#cadastrar {
  width: 130px;
  background-color: #0099ff;
  border: none;
  color: white;
  height: 39px;
  font-family: Arial, Helvetica, sans-serif;
  font-weight: 500;
  cursor: pointer;
  border-radius: 10px;
  justify-content: center;
  display: flex;
  align-items: center;
  text-decoration: none;
  font-size: 13px;
}

#cadastrar:hover {
  background-color: #0088ee;
}

.entrar-cadastro {
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 30px;
}

.linha-botoes {
  display: flex;
  gap: 8px;
  margin-top: 20px;
}

#esqueci-senha {
  margin-top: 10px;
  font-family: Arial, Helvetica, sans-serif;
  color: #0062cb;
  cursor: pointer;
  text-decoration: underline;
  width: 30%;
}

[data-theme="dark"] #esqueci-senha {
  color: #4a9eff;
}

#ou {
  margin-top: 10px;
  color: var(--texto-primario);
}

.container-bem-vindo {
  position: relative;
}

footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 10px;
}

#ver-termos {
  text-decoration: underline;
  color: var(--texto-secundario);
  cursor: pointer;
  padding-left: 140px;
}

@keyframes pulo {
  0%,
  100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-20px);
  }
}

@import url("https://fonts.googleapis.com/css?family=Titillium Web:200,300,400,500,600,700,800,900&display=swap");

section {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

section .wave {
  position: absolute;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--wave-bg);
  box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.5);
  transition: 0.5s;
}

section .wave span {
  content: "";
  position: absolute;
  width: 325vh;
  height: 325vh;
  top: 0;
  left: 50%;
  transform: translate(-50%, -75%);
}

section .wave span:nth-child(1) {
  border-radius: 45%;
  background: var(--wave-1);
  animation: animate 5s linear infinite;
}

section .wave span:nth-child(2) {
  border-radius: 40%;
  background: var(--wave-2);
  animation: animate 10s linear infinite;
}

section .wave span:nth-child(3) {
  border-radius: 42.5%;
  background: var(--wave-3);
  animation: animate 15s linear infinite;
}

@keyframes animate {
  0% {
    transform: translate(-50%, -75%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -75%) rotate(360deg);
  }
}
   </style>

   <script>
    // Gerenciamento do Modo Escuro
class ThemeManager {
  constructor() {
    this.init()
  }

  init() {
    // O tema já foi aplicado pelo script inline no head
    // Aqui apenas configuramos o botão e atualizamos o ícone
    const currentTheme = document.documentElement.getAttribute("data-theme") || "light"
    this.updateToggleIcon(currentTheme)
    this.setupToggleButton()
  }

  setTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme)
    localStorage.setItem("theme", theme)
    this.updateToggleIcon(theme)
  }

  updateToggleIcon(theme) {
    const icon = document.getElementById("theme-icon")
    if (icon) {
      if (theme === "dark") {
        icon.className = "fas fa-sun"
      } else {
        icon.className = "fas fa-moon"
      }
    }
  }

  toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-theme")
    const newTheme = currentTheme === "dark" ? "light" : "dark"
    this.setTheme(newTheme)
  }

  setupToggleButton() {
    const toggleButton = document.getElementById("toggle-dark-mode")
    if (toggleButton) {
      toggleButton.addEventListener("click", () => {
        this.toggleTheme()
      })
    }
  }
}

// Funcionalidades existentes
const texto = document.getElementById("texto-apresentacao-bem-vindo")
const tamanhoBase = Number.parseFloat(window.getComputedStyle(texto).fontSize)

document.getElementById("increase-font").addEventListener("click", () => {
  const tamanhoAtual = Number.parseFloat(window.getComputedStyle(texto).fontSize)
  let novoTamanho = tamanhoAtual * 1.1
  if (novoTamanho > 30) {
    novoTamanho = 30
  }
  texto.style.fontSize = novoTamanho + "px"
})

document.getElementById("decrease-font").addEventListener("click", () => {
  const tamanhoAtual = Number.parseFloat(window.getComputedStyle(texto).fontSize)
  if (tamanhoAtual > tamanhoBase * 1) {
    texto.style.fontSize = tamanhoAtual * 0.9 + "px"
  }
})

document.addEventListener("DOMContentLoaded", () => {
  // Inicializa o gerenciador de tema
  new ThemeManager()

  // Animação de digitação
  const textoDigitadoElement = document.getElementById("texto-apresentacao-bem-vindo")
  const textoCompleto =
    "Conheça a nova plataforma que vai alavancar sua oratória com a nova inteligência artificial Fala.i"
  let i = 0

  function digitar() {
    if (i < textoCompleto.length) {
      textoDigitadoElement.textContent += textoCompleto.charAt(i)
      i++
      setTimeout(digitar, 30)
    } else {
      textoDigitadoElement.style.borderRight = "none"
    }
  }

  digitar()
})
   </script>

</body>

</html>