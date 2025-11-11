<?php
session_start();
require_once "../src/Model/AgendaModel.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Aplica tema imediatamente -->
  <script>
    (function () {
      const savedTheme = localStorage.getItem('theme');
      const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
      const theme = savedTheme || systemTheme;
      document.documentElement.setAttribute('data-theme', theme);
    })();
  </script>

  <link rel="stylesheet" href="static/PaginaAgenda/PaginaAgenda.css">
  <script src="https://kit.fontawesome.com/345c519b8f.js" crossorigin="anonymous"></script>
  <title>Agenda</title>

  <style>
    /* Fade-in básico */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .fade-animate {
      opacity: 1;
      transform: translateY(0);
    }

    /* Modal visível */
    .modal-overlay.show {
      display: flex;
    }
  </style>
</head>

<body>
  <!-- NAV -->
  <nav>
    <div class="nav-left">
      <a href="PaginaInicial.php" class="logo">
        <img src="assets/img/logo.png" alt="Logo" width="60px">
      </a>
    </div>
    <ul class="nav-menu">
      <li><a href="PaginaInicial.php">Serviços</a></li>
      <li><a href="PaginaCadastro.html">Quem somos</a></li>
      <li><a href="PaginaInicial.html">Tutorial</a></li>
      <li><a href="PaginaInicial.html">Contato</a></li>
    </ul>
    <div class="nav-right">
      <button id="toggle-dark-mode" class="toggle-mode" title="Alternar modo escuro">
        <i class="fas fa-moon" id="theme-icon"></i>
      </button>
      <form action="PaginaConta.php">
        <button class="account-btn">
          <i class="fas fa-user"></i> Minha conta
        </button>
      </form>
    </div>
  </nav>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="main-content">
    <div class="left">
      <h1>Agende seus próximos trabalhos por aqui!</h1>
      <div class="btn-agenda">
        <button class="add-task-btn" onclick="abrirModal()">
          <p class="add">+</p> Adicionar uma tarefa
        </button>
        <p id="google-agenda">Integrado com Google Agenda*</p>
      </div>
      <p id="texto" class="textos">Para adicionar seus trabalhos e apresentações clique no botão acima.</p>
      <a href="https://calendar.google.com/calendar/u/0/r" class="google-agenda">
        <img src="assets/img/google-agenda.png" alt="" width="30px">
        Google Agenda
      </a>
      <p id="texto2" class="textos">Ao adicionar uma tarefa, ela poderá ser vista no campo ao lado, ou, se preferir,
        clique no botão acima para acessar Google Agenda e veja suas tarefas por lá.</p>
    </div>

    <div class="right">
      <div class="calendar-icon">
        <div class="agendados">
          <div class="calendario">
            <h3>Aqui aparecerão todos os seus trabalhos agendados</h3>
            <img src="assets/img/calendario.png" width="50px" alt="ícone de calendário">
          </div>
          <hr>
          <div id="lista-tarefas">
   <?php
$usuario_id = $_SESSION["usuario_id"] ?? 1;
$tarefas = AgendaModel::listarTarefas($usuario_id);

if ($tarefas && count($tarefas) > 0) {
    foreach ($tarefas as $tarefa) {
        $id = $tarefa['id'];
        $titulo = addslashes($tarefa['titulo']);
        $descricao = addslashes($tarefa['descricao']);
        $dataHora = htmlspecialchars($tarefa['data_tarefa'] . 'T' . $tarefa['horario_tarefa']);

        echo "<div class='tarefa' data-id='{$id}'>";
        echo "<h4>" . htmlspecialchars($tarefa['titulo']) . "</h4>";
        echo "<p>" . htmlspecialchars($tarefa['descricao']) . "</p>";
        echo "<small>" . htmlspecialchars($tarefa['data_tarefa']) . "</small>";

        echo "<div class='acoes-tarefa'>";

        
        echo "<button type='button' class='btn-editar' 
    onclick='abrirModalEditar(\"{$id}\", \"" . htmlspecialchars($tarefa['titulo']) . "\", \"" . htmlspecialchars($tarefa['descricao']) . "\", \"" . htmlspecialchars($tarefa['data_tarefa'] . "T" . $tarefa['horario_tarefa']) . "\")'>
    Editar
    </button>";

        // Botão Excluir
        echo "<form style='display:inline;' method='POST' action='../Controller/AgendaController.php' 
                onsubmit='return confirm(\"Tem certeza que deseja excluir esta tarefa?\");'>";
        echo "<input type='hidden' name='acao' value='excluir'>";
        echo "<input type='hidden' name='tarefa_id' value='{$id}'>";
        echo "<button type='submit' class='btn-excluir' 
                style='background-color:#e74c3c; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;'>
                Excluir
              </button>";
        echo "</form>";

        echo "</div>"; 
        echo "</div><hr>";
    }
} else {
    echo "<p>Nenhuma tarefa encontrada.</p>";
}
?>

</div>
        </div>
      </div>
    </div>
  </div>

 
  <div id="modal-overlay" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Adicionar Nova Tarefa</h2>
        <button class="close-btn" onclick="fecharModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>

    <form action="../Controller/AgendaController.php" method="POST" id="form-tarefa" class="task-form">
  <input type="hidden" id="form-acao" name="acao" value="criar">
  <input type="hidden" id="form-tarefa-id" name="tarefa_id" value="">

  <div class="form-group">
    <label for="nome-tarefa">Nome da Tarefa:</label>
    <input type="text" id="nome-tarefa" name="titulo" placeholder="Digite o nome da tarefa" required>
  </div>

  <div class="form-group">
    <label for="descricao-tarefa">Descrição (opcional):</label>
    <textarea id="descricao-tarefa" name="descricao" placeholder="Adicione uma descrição" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="data-tarefa">Data e Hora:</label>
    <input type="datetime-local" id="data-tarefa" name="data_tarefa">
  </div>

  <div class="form-actions">
    <button type="button" class="cancel-btn" onclick="fecharModal()">Cancelar</button>
    <button type="submit" class="submit-btn">Adicionar Tarefa</button>
  </div>
</form>


    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer-inicio fade-in">
    <div class="logo-footer">
      <img src="assets/img/logo.png" alt="" id="logo-footer">
      <p>FALA.I</p>
    </div>
    <hr>
    <div class="informacoes-footer">
      <p>Endereço de e-mail: fala.i.contact@gmail.com</p><br>
      <p>Telefone: +55 (11) 98369-9658</p>
    </div>
    <div class="icons-footer">
      <a href="https://instagram.com" target="_blank" aria-label="Instagram">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://facebook.com" target="_blank" aria-label="Facebook">
        <i class="fab fa-facebook"></i>
      </a>
      <a href="https://github.com" target="_blank" aria-label="GitHub">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <div class="caminhos-footer">
      <a href="/termos">Ver Termos</a> | 
      <a href="/minha_conta">Minha Conta</a> | 
      <a href="/agenda">Agenda</a> | 
      <a href="#sessao-dicas">Dicas</a> | 
      <a href="#sessao-videos">Vídeos</a>
    </div>
    <div class="copright">
      <p>©2025 Fala.i. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- JS -->
  <script>
    // Funções modal
    function abrirModal() {
      document.getElementById("modal-overlay").classList.add("show");
      document.body.style.overflow = "hidden";
    }
    function fecharModal() {
      document.getElementById("modal-overlay").classList.remove("show");
      document.body.style.overflow = "auto";
      document.getElementById("form-tarefa").reset();
    }
    document.getElementById("modal-overlay").addEventListener("click", function (e) {
      if (e.target === this) fecharModal();
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") fecharModal();
    });

    // Tema escuro
    class ThemeManager {
      constructor() {
        this.init();
      }
      init() {
        const currentTheme = document.documentElement.getAttribute("data-theme") || "light";
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
        icon.className = theme === "dark" ? "fas fa-sun" : "fas fa-moon";
      }
      toggleTheme() {
        const currentTheme = document.documentElement.getAttribute("data-theme");
        this.setTheme(currentTheme === "dark" ? "light" : "dark");
      }
      setupToggleButton() {
        const toggleButton = document.getElementById("toggle-dark-mode");
        toggleButton.addEventListener("click", () => this.toggleTheme());
      }
    }

    // Fade-in footer e outros elementos
    function observeElements() {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("fade-animate");
            }
          });
        }, { threshold: 0.1 }
      );
      document.querySelectorAll(".fade-in").forEach(el => observer.observe(el));
    }

    document.addEventListener("DOMContentLoaded", () => {
      new ThemeManager();
      observeElements();
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

function abrirModalEditar(id, titulo, descricao, dataHora) {
  // Abre o modal
  const modal = document.getElementById("modal-overlay");
  modal.classList.add("show");
  document.body.style.overflow = "hidden";

  // Preenche os campos do formulário
  document.getElementById("form-acao").value = "editar";
  document.getElementById("form-tarefa-id").value = id;
  document.getElementById("nome-tarefa").value = titulo;
  document.getElementById("descricao-tarefa").value = descricao;
  document.getElementById("data-tarefa").value = dataHora;

  // Muda o título e o texto do botão
  document.querySelector(".modal-content h2").innerText = "Editar Tarefa";
  document.querySelector(".submit-btn").innerText = "Salvar Alterações";
}

function abrirModal() {
  const modal = document.getElementById("modal-overlay");
  modal.classList.add("show");
  document.body.style.overflow = "hidden";

  // Garante que é modo "criar"
  document.getElementById("form-acao").value = "criar";
  document.getElementById("form-tarefa-id").value = "";
  document.querySelector(".modal-content h2").innerText = "Adicionar Nova Tarefa";
  document.querySelector(".submit-btn").innerText = "Adicionar Tarefa";
}

function fecharModal() {
  const modal = document.getElementById("modal-overlay");
  modal.classList.remove("show");
  document.body.style.overflow = "auto";
  document.getElementById("form-tarefa").reset();

  // Volta pro modo "criar"
  document.getElementById("form-acao").value = "criar";
  document.getElementById("form-tarefa-id").value = "";
  document.querySelector(".modal-content h2").innerText = "Adicionar Nova Tarefa";
  document.querySelector(".submit-btn").innerText = "Adicionar Tarefa";
}
  </script>
</body>
</html>
