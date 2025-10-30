<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/PaginaLogin/PaginaLogin.css">
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

    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
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
                            <img src="assets/img/logo.png" alt="Logo do Chatbot" id="logo"
                                class="logo">
                        </div>
                    </div>
                </div>
            </div>

            <div class="direita">
                <div class="container-login" id="container-login">
                    <div class="login">
                        <h3>Faça seu Login</h3>
                        <form method="POST" action="../Controller/LoginController.php" id="form-login"> 
                            <p id="label">E-mail</p>
                            <input type="email" placeholder="Digite seu email" id="email" name="email" required>
                            <div class="linha-rm-senha">
                                <div>
                                    <p id="label">Rm</p>
                                    <input type="text" placeholder="Digite seu Rm" id="rm" required name="rm"
                                        maxlength="5">
                                </div>
                                <div>
                                    <p id="label">Senha</p>
                                    <input type="password" placeholder="Digite sua senha" id="senha" name="senha"
                                        required>
                                </div>
                            </div>
                            <div class="entrar-cadastro">
                                <div class="linha-botoes">
                                    <button type="submit" id="entrar">Entrar</button>
                                    <p id="ou">ou</p>
                                    <a href="PaginaCadastro.php" id="cadastrar">Cadastrar</a>
                                </div>
                                <a id="esqueci-senha" href="PaginaEsqueciSenha.php">Esqueci minha senha</a>
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
            <a href="PaginaTermos.php" id="ver-termos">Ver termos e condições</a>
        </footer>
    </section>

    
<script src="static/PaginaLogin/PaginaLogin.js"></script>
</body>
</html>