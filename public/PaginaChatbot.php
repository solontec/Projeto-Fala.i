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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--footer)" viewBox="0 0 24 24">
                        <path
                            d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-3a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </a>
                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--footer)" viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 5 3.657 9.128 8.438 9.879v-6.988H7.898v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.261c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33V21.88C18.344 21.128 22 17 22 12z" />
                    </svg>
                </a>
                <a href="https://github.com/solontec/Projeto-Fala.i" target="_blank" aria-label="GitHub">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--footer)" viewBox="0 0 24 24">
                        <path
                            d="M12 0C5.371 0 0 5.373 0 12c0 5.303 3.438 9.8 8.207 11.387.6.111.793-.26.793-.577 0-.285-.01-1.04-.016-2.04-3.338.726-4.042-1.612-4.042-1.612-.546-1.387-1.333-1.756-1.333-1.756-1.09-.744.083-.729.083-.729 1.205.086 1.838 1.236 1.838 1.236 1.07 1.834 2.809 1.304 3.495.997.108-.775.419-1.305.762-1.604-2.665-.303-5.466-1.335-5.466-5.932 0-1.31.469-2.381 1.236-3.221-.124-.303-.536-1.524.117-3.176 0 0 1.008-.322 3.3 1.23a11.53 11.53 0 013.006-.404c1.02.005 2.045.138 3.006.404 2.29-1.553 3.297-1.23 3.297-1.23.655 1.653.243 2.874.119 3.176.77.84 1.235 1.911 1.235 3.221 0 4.61-2.804 5.625-5.475 5.921.43.372.823 1.102.823 2.222 0 1.604-.014 2.896-.014 3.293 0 .319.192.694.801.576C20.565 21.796 24 17.299 24 12c0-6.627-5.373-12-12-12z" />
                    </svg>
                </a>
            </div>
            <div class="caminhos-footer">
                <a href="PaginaTermos.php">Ver Termos</a>
                <p>|</p>
                <a href="PaginaConta.php">Minha Conta</a>
                <p>|</p>
                <a href="PaginaAgenda.php">Agenda</a>
                <p>|</p>
                <a href="PaginaInicial.php">Dicas</a>
                <p>|</p>
                <a href="PaginaInicial.php">Vídeos</a>
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