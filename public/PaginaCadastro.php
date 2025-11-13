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

    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="static/PaginaCadastro/PaginaCadastro.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title>Pagina Cadastro Fala.i</title>
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
                <div class="container-cadastro" id="container-cadastro">
                    <div class="cadastro">
                        <h3>Faça seu Cadastro</h3>
                        <form method="POST" action="../Controller/CadastroController.php" id="form-cadastro">
                            <p id="label">Nome completo</p>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" maxlength="80" required>
                            <p id="label">E-mail</p>
                            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                            <div class="linha-rm-senha">
                                <div>
                                    <p id="label">Rm</p>
                                    <input type="text" id="rm" name="rm" placeholder="Digite seu Rm" maxlength="5"
                                        required>
                                </div>
                                <div>
                                    <p id="label">Senha</p>
                                    <input type="text" id="senha" name="senha" placeholder="Crie uma senha" required>
                                </div>
                            </div>
                            <p id="label">Confirme a senha</p>
                            <input type="text" id="confirmarSenha" name="confirmarSenha"
                                placeholder="Digite a mesma senha do campo anterior" required>
                            <div class="cadastro-entrar">
                                <div class="botoes-linha">
                                    <button type="submit" id="cadastrar2">Cadastrar</button>
                                    <p id="ou">ou</p>
                                    <a type="button" id="entrar2" href="PaginaLogin.php">Entrar</a>
                                </div>
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

    <script src="static/PaginaCadastro/PaginaCadastro.js"></script>
  <script src="static/PaginaAcessibilidade/PaginaAcessibilidade.js"></script>
</body>

</html>