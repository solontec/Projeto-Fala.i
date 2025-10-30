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
<html lang="pt-br" >

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
  <link rel="shortcut icon" href="{{ url_for('static', filename='img/logo.png') }}" type="image/x-icon">
  <script src="static/PaginaConta/PaginaConta.js"></script>
</head>

<body>
  <div class="menu-lateral">
    <div class="item-lista">
    <ul>
      <li id="principal">Minha Conta</li>
      <li><a href="/suporte">Ajuda/Suporte</a></li>
      <li><a href="/termos_config">Termos de Uso</a></li>
      <li>Acessibilidade</li>
      <li>Feedback</li>
      <li>Logout</li>
    </ul>
    </div>

    <div class="icon-lista">
    <a href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCJlKnNzzslPCvBlmcdPlXcrjSnrVjhMLZMrWRJCgkFRdNlpTgcnsTFLPSKbWMZCpsTcjKfL"
      target="_blank" rel="noopener noreferrer">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#888" viewBox="0 0 24 24">
        <path
          d="M2 4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4zm2 0v.01L12 13l8-8.99V4H4zm0 2.828V20h16V6.828l-8 8-8-8z" />
      </svg>
    </a>

    <a href="https://instagram.com" target="_blank" aria-label="Instagram">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#626262" viewBox="0 0 24 24">
        <path
          d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-3a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
      </svg>
    </a>

    <a href="https://github.com" target="_blank" aria-label="GitHub">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#626262" viewBox="0 0 24 24">
        <path
          d="M12 0C5.371 0 0 5.373 0 12c0 5.303 3.438 9.8 8.207 11.387.6.111.793-.26.793-.577 0-.285-.01-1.04-.016-2.04-3.338.726-4.042-1.612-4.042-1.612-.546-1.387-1.333-1.756-1.333-1.756-1.09-.744.083-.729.083-.729 1.205.086 1.838 1.236 1.838 1.236 1.07 1.834 2.809 1.304 3.495.997.108-.775.419-1.305.762-1.604-2.665-.303-5.466-1.335-5.466-5.932 0-1.31.469-2.381 1.236-3.221-.124-.303-.536-1.524.117-3.176 0 0 1.008-.322 3.3 1.23a11.53 11.53 0 013.006-.404c1.02.005 2.045.138 3.006.404 2.29-1.553 3.297-1.23 3.297-1.23.655 1.653.243 2.874.119 3.176.77.84 1.235 1.911 1.235 3.221 0 4.61-2.804 5.625-5.475 5.921.43.372.823 1.102.823 2.222 0 1.604-.014 2.896-.014 3.293 0 .319.192.694.801.576C20.565 21.796 24 17.299 24 12c0-6.627-5.373-12-12-12z" />
      </svg>
    </a>
  </div>
  </div>

  <nav>
    <div class="nav-left">
      <a href="PaginaInicial.php">
        <img  src="assets/img/logo.png " alt="Logo do Chatbot" id="logo" class="logo"
        width="60px">
      </a>
    </div>
    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
    <ul class="nav-menu" id="nav-menu">
      <li><a href="PaginaInicial.php">Serviços</a></li>
      <li><a href="PaginaCadastro.html">Quem somos</a></li>
      <li><a href="{{ url_for('auth.logout') }}">Logout</a></li>
      <li><a href="PaginaInicial.html">Contato</a></li>
    </ul>
    <div class="nav-right">
      <!-- Botão de Toggle do Modo Escuro -->
      <button id="toggle-dark-mode" class="toggle-mode" title="Alternar modo escuro">
        <i class="fas fa-moon" id="theme-icon"></i>
      </button>
    </div>
  </nav>

  <div class="tudo">
    <div class="conteudo">
      
      <div class="nomePrincipal">
        <p><?= htmlspecialchars($usuario["nome"]) ?></p>
      </div>

      <div class="foto">
  <?php if (!empty($usuario["imagem_usuario"])): ?>
    <img src="../<?= htmlspecialchars($usuario["imagem_usuario"]) ?>" 
         alt="Foto do usuário" 
         width="200" height="200" 
         style="border-radius: 50%; object-fit: cover;">
  <?php else: ?>
    <p>Nenhuma foto enviada.</p>
  <?php endif; ?>
</div>


      <form action="../Controller/ImagemUsuarioController.php" method="POST" enctype="multipart/form-data">
  <div class="foto">
      <input type="file" name="adicionarFoto" accept="image/*">
    </div> 
        <button type="submit">Salvar Foto</button>
    </form>


      <div class="informacoes">
        <div class="conjunto">
          <label>Email: </label>
          <p><?= htmlspecialchars($usuario["email"]) ?></p>
        </div>

        <div class="conjunto">
          <label>RM:</label>
          <p><?= htmlspecialchars($usuario["rm"]) ?></p>
          <button>Alterar nome</button>
        </div>

        <div class="conjunto">
          <label>Sair da conta: </label>
          <form action="../Controller/LogoutController.php" method="POST">
            <button type="submit">Logout</button>
          </form>
        </div>

        <div class="conjunto">
          <label>Alterar Senha: </label>
          <button>Alterar senha</button>
        </div>
      </div>

    </div>
  </div>

  <script src="{{ url_for('static', filename='PaginaConta/PaginaConta.js') }}"></script>
</body>

</html>