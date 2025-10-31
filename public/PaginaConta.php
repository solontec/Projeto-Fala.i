<?php
session_start();
require_once "../config/config.php"; // conexão com o banco

$conn = getConnection();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: PaginaLogin.php");
    exit;
}

$id = $_SESSION["usuario_id"];

// Buscar informações do usuário
$stmt = $conn->prepare("SELECT nome, rm, email, imagem_usuario FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script>
    (function () {
      const savedTheme = localStorage.getItem('theme');
      const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
      const theme = savedTheme || systemTheme;
      document.documentElement.setAttribute('data-theme', theme);
    })();
  </script>
  <title>Minha Conta</title>
  <link href="https://fonts.googleapis.com/css2?family=Young+Serif&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://kit.fontawesome.com/345c519b8f.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="static/PaginaConta/PaginaConta.css">
  <script src="static/PaginaConta/PaginaConta.js" defer></script>

  <style>
    /* ====== ESTILOS DO MODAL ====== */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .modal {
      background: var(--bg-color, #fff);
      color: var(--text-color, #333);
      padding: 25px;
      border-radius: 10px;
      text-align: center;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      animation: fadeIn 0.2s ease;
    }

    .modal h3 {
      margin-bottom: 15px;
      font-size: 20px;
    }

    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .btn-cancelar {
      background: #ccc;
      color: #222;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-confirmar {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-confirmar:hover { background: #c0392b; }
    .btn-cancelar:hover { background: #b0b0b0; }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>

<body>
  <div class="menu-lateral">
    <div class="item-lista">
      <ul>
        <li id="principal">Minha Conta</li>
        <li><a href="PaginaSuporte.php">Ajuda/Suporte</a></li>
        <li><a href="/termos_config">Termos de Uso</a></li>
        <li>Acessibilidade</li>
        <li>Feedback</li>
        <li>Logout</li>
      </ul>
    </div>

    <div class="icon-lista">
      <!-- ícones omitidos para brevidade -->
    </div>
  </div>

  <nav>
    <div class="nav-left">
      <a href="PaginaInicial.php">
        <img src="assets/img/logo.png" alt="Logo do Chatbot" id="logo" class="logo" width="60px">
      </a>
    </div>
    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
    <ul class="nav-menu" id="nav-menu">
      <li><a href="PaginaInicial.php">Início</a></li>
      <li><a href="PaginaAgenda.php">Agenda</a></li>
      <li><a href="PaginaAquecimento.php">Aquecimento</a></li>
      <li><a href="PaginaRanking.php">Ranking</a></li>
    </ul>
    <div class="nav-right">
      <button id="toggle-dark-mode" class="toggle-mode" title="Alternar modo escuro">
        <i class="fas fa-moon" id="theme-icon"></i>
      </button>
    </div>
  </nav>

  <div class="tudo">
    <div class="perfil-container">
      <div class="perfil-lateral">
        <div class="foto">
          <?php if (!empty($usuario["imagem_usuario"])): ?>
            <img src="../<?= htmlspecialchars($usuario["imagem_usuario"]) ?>" alt="Foto do usuário" class="foto-perfil">
          <?php else: ?>
            <img src="../assets/user-placeholder.png" alt="Sem foto" class="foto-perfil">
          <?php endif; ?>
        </div>

        <form action="../Controller/ImagemUsuarioController.php" method="POST" enctype="multipart/form-data" class="form-foto">
          <input type="file" name="adicionarFoto" accept="image/*">
          <button type="submit">Salvar Foto</button>
        </form>

        <h2 class="nome-usuario"><?= htmlspecialchars($usuario["nome"]) ?></h2>
        <button class="editar-btn">Editar Perfil</button>
      </div>

      <div class="perfil-conteudo">
        <h3>Informações da Conta</h3>

        <div class="info-card">
          <label>Email:</label>
          <p><?= htmlspecialchars($usuario["email"]) ?></p>
        </div>

        <div class="info-card">
          <label>RM:</label>
          <p id="rm"><?= htmlspecialchars($usuario["rm"]) ?></p>
          <button>Alterar RM</button>
        </div>

        <div class="info-card">
          <label>Alterar Senha:</label>
          <button>Alterar senha</button>
        </div>

        <div class="info-card danger-zone">
          <label>Sair da conta:</label>
          <button type="button" class="logout-btn" id="abrirModalLogout">Logout</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== MODAL DE CONFIRMAÇÃO DE LOGOUT ===== -->
  <div class="modal-overlay" id="modalLogout">
    <div class="modal">
      <h3>Tem certeza que deseja sair da conta?</h3>
      <div class="modal-buttons">
        <button class="btn-cancelar" id="cancelarLogout">Cancelar</button>
        <form action="../Controller/LogoutController.php" method="POST" style="display:inline;">
          <button type="submit" class="btn-confirmar">Sim, sair</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Script para abrir e fechar o modal
    const modal = document.getElementById('modalLogout');
    const btnAbrir = document.getElementById('abrirModalLogout');
    const btnCancelar = document.getElementById('cancelarLogout');

    btnAbrir.addEventListener('click', () => {
      modal.style.display = 'flex';
    });

    btnCancelar.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    // Fechar o modal ao clicar fora dele
    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>

</body>
</html>
