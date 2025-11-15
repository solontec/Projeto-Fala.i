<?php

require_once "../Controller/GeminiController.php";
// Garante que variáveis existem
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pergunta = $_POST['pergunta'] ?? "";
    $respostaApi = enviarMensagemGemini($pergunta);
    $resposta = $respostaApi['resposta'] ?? "Erro ao obter resposta.";
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
        href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700;900&family=Young+Serif&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Usa o CSS que você forneceu -->
    <link rel="stylesheet" href="static/PaginaChatbot/PaginaChatbot.css">

    <!-- marked.js para transformar Markdown em HTML (usado no front-end) -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <!-- DOMPurify para sanitizar o HTML gerado (proteção XSS) -->
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2.4.0/dist/purify.min.js"></script>

    <title>Chat Fala.i</title>
</head>

<body>
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
            <form action="PaginaConta.php">
                <button class="account-btn" type="submit">
                    <i class="fas fa-user"></i>
                    <span>Minha conta</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="tudo">

        <div class="container">
            <div class="main-container" id="chat-container">
                <div class="chat-mensagens" id="chat-mensagens-list">
                    <?php if (!empty($resposta)): ?>
                        <div class="mensagem-bot"><strong>Fala.i:</strong>
                            <div class="fala-formatada"><?= nl2br(htmlspecialchars($resposta)) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="chat">
                <!-- mantém method POST caso queira fallback sem JS; o JS previne o comportamento padrão -->
                <form method="POST" id="form">
                    <textarea class="pergunta" name="pergunta" id="pergunta" placeholder="Fala aí!"></textarea>

                    <div class="botoes-lado-a-lado">
                        <!-- Botão Falar -->
                        <button type="button" id="btn-falar" class="falar">
                            <i class="fas fa-microphone"></i>
                        </button>

                        <!-- Botão Enviar -->
                        <button type="submit" class="enviar">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <footer class="footer-inicio fade-in">
        <div class="footer-inicio">
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
                <a href="/termos">Ver Termos</a>
                <p>|</p>
                <a href="/minha_conta">Minha Conta</a>
                <p>|</p>
                <a href="/agenda">Agenda</a>
                <p>|</p>
                <a href="#sessao-dicas">Dicas</a>
                <p>|</p>
                <a href="#sessao-videos">Vídeos</a>
            </div>

            <div class="copright">
                <p>©2025 Fala.i. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

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
    <script src="../public/js/pontuacao_tempo.js"></script>

    <!-- seu JS original (se houver) -->
    <script src="static/PaginaChatbot/PaginaChatbot.js"></script>
    <script src="static/PaginaAcessibilidade/PaginaAcessibilidade.js"></script>
</body>

</html>