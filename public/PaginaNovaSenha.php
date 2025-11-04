<?php
require_once "../src/Model/UsuarioModel.php";
require_once "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    $conn = getConnection();
    $stmt = $conn->prepare("SELECT email, expira_em FROM redefinicoes_senha WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $registro = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if (!$registro || strtotime($registro['expira_em']) < time()) {
        die("<h3>❌ Link inválido ou expirado.</h3>");
    }

    $email = $registro['email'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $novaSenha = $_POST['nova_senha'];

    UsuarioModel::atualizarSenha($email, $novaSenha);

    echo "<script>alert('Senha redefinida com sucesso!'); window.location.href='PaginaLogin.php';</script>";
    exit;
}
?> 


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Script para aplicar tema INSTANTANEAMENTE -->
    <script>
        (function() {
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
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="Images/Captura_de_tela_2025-03-14_174727-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="static/PaginaNovaSenha/PaginaNovaSenha.css">
   
    <title>Redefinir Senha</title>
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
        <div class="container-nova-senha">
            <h3>Redefina sua senha</h3>
            <form method="POST">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <label>Nova Senha:</label>
                <input type="password" name="nova_senha" required minlength="6" placeholder="Insira sua nova senha"><br><br>
                <button type="submit">Salvar Nova Senha</button>
            </form>
            <div class="entrar-cadastro">
                <div class="caminhos">
                    <a id="login-caminho" href="PaginaLogin.php">Login</a>
                    <p id="ou">ou</p>
                    <a href="PaginaCadastro.php" id="login-caminho">Cadastro</a>
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
        <a href="PaginaTermos.php" id="ver-termos">Ver termos e condições</a>
    </footer>
</section>

<script src="static/PaginaNovaSenha/PaginaNovaSenha.js"></script>
</body>
</html>