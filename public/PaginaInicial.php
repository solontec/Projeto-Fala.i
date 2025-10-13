<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: PaginaLogin.php");
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
    <link rel="shortcut icon" href="{{ url_for('static', filename='img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ url_for('static', filename='PaginaInicial/PaginaInicial.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/345c519b8f.js" crossorigin="anonymous"></script>
    <title>Página Inicial</title>
</head>

<body>
    <nav>
        <div class="nav-left">
            <img src="{{ url_for('static', filename='img/logo.png') }}" alt="Logo do Chatbot" id="logo" class="logo"
                width="60px">
        </div>
        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
        <ul class="nav-menu" id="nav-menu">
            <li><a href="/inicio">Serviços</a></li>
            <li><a href="PaginaCadastro.html">Quem somos</a></li>
            <li><a href="{{ url_for('auth.logout') }}">Logout</a></li>
            <li><a href="PaginaInicial.html">Contato</a></li>
        </ul>
        <div class="nav-right">
            <!-- Botão de Toggle do Modo Escuro -->
            <button id="toggle-dark-mode" class="toggle-mode" title="Alternar modo escuro">
                <i class="fas fa-moon" id="theme-icon"></i>
            </button>
            <!-- Botão Minha Conta -->
            <form action="/minha_conta">
                <button class="account-btn" type="submit">
                    <i class="fas fa-user"></i>
                    <span>Minha conta</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="geral">
        <div class="left">
            <header class="titulo fade-in">
                <h1>FALA.I</h1>
            </header>
            <section class="comecando fade-in fade-delay-1">
                <form action="/resposta">
                    <div class="botao-comecar">
                        <button id="botao-comecar">COMECE JÁ</button>
                    </div>
                </form>
                <p id="textinho">
                    Comece agora a treinar sua oratória e arrasar nas suas próximas apresentações!
                </p>
            </section>
        </div>
        <div class="right">
            <div class="espaco fade-in fade-delay-2">
                <div class="logo-container">
                    <img src="{{ url_for('static', filename='img/logo.png') }}" alt="Logo do Chatbot"
                        id="logo-container" class="logo-container" width="150px">
                </div>
                <div class="balao-fala">
                    Olá, eu sou o Fala.i, seu assistente virtual para ajudar você a descobrir os segredos de como ter
                    uma ótima oratória. Clique no botão "Comece já", converse comigo e destrave as nuances da oratória!
                </div>
            </div>
        </div>
    </div>

    <section class="cards-container fade-in">
        <div class="card fade-delay-1">
            <div class="card-agenda">
                <img src="{{ url_for('static', filename='img/calendario.png') }}" width="250px" alt="Ícone de Agenda">
            </div>
            <form action="/agenda">
                <button class="botao">
                    <a>AGENDA</a>
                </button>
            </form>
        </div>
        <div class="card fade-delay-2">
            <div class="card-microfone">
                <img src="{{ url_for('static', filename='img/microfone.png') }}" width="260px" alt="Ícone de Microfone">
            </div>
            <button class="botao">
                <a href="">MICROFONE</a>
            </button>
        </div>
        <div class="card fade-delay-3">
            <div class="card-ranking">
                <img src="{{ url_for('static', filename='img/ranking.png') }}" width="250px" alt="Ícone de Ranking">
            </div>
            <form action="/ranking">
                <button class="botao">
                    <a href="">RANKING</a>
                </button>
            </form>

        </div>
    </section>

    <section class="sessao-onda">
        <div class="onda" id="onda1"></div>
        <div class="onda" id="onda2"></div>
        <div class="onda" id="onda3"></div>
        <div class="onda" id="onda4"></div>
    </section>

    <section class="proposta">
        <div class="conteudo">
            <div class="sobre">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam exercitationem fugiat ab quia sit voluptatem inventore, possimus excepturi, labore explicabo architecto sed laboriosam similique. Dolorem exercitationem cum mollitia doloremque. Quidem? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque vero voluptates omnis assumenda amet debitis eum eveniet perferendis maxime nemo. Quod sapiente maxime labore dolor quis nemo dolorem enim sunt.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam dolorum, perferendis quidem nihil a ducimus sequi natus repellat adipisci perspiciatis, provident eveniet? Beatae, qui nobis. Fugit maiores ut doloremque quos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo excepturi cupiditate est esse sint officiis alias dolores labore hic nihil, ea velit atque laboriosam dolore voluptatum quae beatae. Magni, corporis.</p>
            </div>

            <div class="quem-somos">
                <h3 id="quem-somos">Quem somos?</h3>
                <img src="{{ url_for('static', filename='img/duvida.png') }}" width="280px" alt="Pessoa com dúvida">
            </div>
        </div>
    </section>

    <section class="sessao-onda2">
        <div class="onda2" id="onda5"></div>
        <div class="onda2" id="onda6"></div>
        <div class="onda2" id="onda7"></div>
        <div class="onda2" id="onda8"></div>
    </section>

    <!-- Seção Oratória - Layout Horizontal como na imagem -->
    <section class="oratoria-sessao fade-in">
        <div class="oratoria">
            <div class="img-oratoria">
                <img src="{{ url_for('static', filename='img/oratoria.jpg') }}" id="oratoria-img"
                    alt="Imagem de oratória">
            </div>
            <div class="texto-oratoria">
                <h3>O que é Oratória?</h3>
                <p id="texto-oratoria">A <b>oratória</b> é a arte de falar em público de forma clara, envolvente e
                    persuasiva. É a habilidade de usar a fala para expressar opiniões, defender ideias e se comunicar
                    com eficácia, compartilhando mensagens de um modo que chame a atenção e conquiste a confiança das
                    pessoas. Uma boa oratória envolve a expressão verbal, a postura, a organização das mensagens e a
                    capacidade de se aproximar do público, compartilhando conteúdos de forma envolvente, natural e
                    confiante. Além de ser importante na vida profissional, como em reuniões, apresentações e
                    negociações, também é útil na vida pessoal, pra expor opiniões, fazer pedidos, dar sugestões ou
                    simplesmente se relacionar melhor com as pessoas ao nosso redor. A oratória ainda fortalece a
                    autoestima, desenvolve o raciocínio e torna o orador mais seguro, claro e objetivo na hora de se
                    expressar.</p>
            </div>
        </div>
    </section>

    <!-- Seção Dicas - Cards com Flip como no original -->
    <section class="sessao-dicas" id="sessao-dicas">
        <h3 id="dicas" class="fade-in">Dicas para Oratória</h3>
        <div class="dicas-principal">
            <div class="container-dicas">
                <div class="dica fade-in fade-delay-1">
                    <div class="dica-inner">
                        <div class="dica-front">
                            <div class="dica-interior">Expressão corporal</div>
                            <div><img src="{{ url_for('static', filename='img/expressao-corporal.png') }}" alt="imagem de expressão corporal" width="200px">
                            </div>
                        </div>
                        <div class="dica-back">
                            <div class="dica-exterior">
                                <audio controls>
                                    <source src="{{ url_for('static', filename='audios/audio1.mp3') }}"
                                        type="audio/mpeg">
                                </audio>
                                Expressão corporal reforça a mensagem, torna a apresentação envolvente e transmite
                                confiança. Combine gestos com entonação, marcando momentos para a atenção do ouvinte.
                                Sinais corporais e verbais devem transmitir a mesma mensagem.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dica fade-in fade-delay-2">
                    <div class="dica-inner">
                        <div class="dica-front">
                            <div class="dica-interior">Utilização de uma frase de impacto</div>
                            <div><img src="{{ url_for('static', filename='img/frase-impacto.png') }}" alt="imagem de frase de impacto" width="200px">
                            </div>
                        </div>
                        <div class="dica-back">
                            <div class="dica-exterior">
                                <audio controls>
                                    <source src="{{ url_for('static', filename='audios/audio4.mp3') }}"
                                        type="audio/mpeg">
                                </audio>
                                Lembra dos exemplos citados? Outra característica comum são frases marcantes, que
                                resumem ou representam bem o discurso. Iniciar ou verbalizar uma mensagem forte gera
                                maior conexão com o público e ajuda a memorizar o que foi dito.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-dicas">
                <div class="dica fade-in fade-delay-3">
                    <div class="dica-inner">
                        <div class="dica-front">
                            <div class="dica-interior">Estudo e preparação</div>
                            <div><img src="{{ url_for('static', filename='img/livro.png') }}" alt="imagem de livro" width="200px"></div>
                        </div>
                        <div class="dica-back">
                            <div class="dica-exterior">
                                <audio controls>
                                    <source src="{{ url_for('static', filename='audios/audio2.mp3') }}"
                                        type="audio/mpeg">
                                </audio>
                                Para melhorar sua oratória, pesquise bem o tema e organize a fala em tópicos conectados.
                                Isso facilita o entendimento, aumenta sua segurança ao falar e mostra ao público que
                                você domina o assunto, reforçando sua credibilidade e tornando a apresentação mais
                                envolvente.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dica fade-in fade-delay-4">
                    <div class="dica-inner">
                        <div class="dica-front">
                            <div class="dica-interior">Gerenciamento de tempo</div>
                            <div><img src="{{ url_for('static', filename='img/gerenciar-tempo.png') }}" alt="imagem de gerenciameno de tempo" width="200px">
                            </div>
                        </div>
                        <div class="dica-back">
                            <div class="dica-exterior">
                                <audio controls>
                                    <source src="{{ url_for('static', filename='audios/audio5.mp3') }}"
                                        type="audio/mpeg">
                                </audio>
                                Discursos muito longos ou repetitivos podem prejudicar a absorção do que você está
                                transmitindo, ou incomodar quem está ouvindo. <br>
                                Por isso, o ideal é sempre se atentar ao tempo e objetivo da sua fala, prendendo a
                                atenção de quem está ouvindo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-dicas">
                <div class="dica fade-in fade-delay-5">
                    <div class="dica-inner">
                        <div class="dica-front">
                            <div class="dica-interior">Uso de exemplos visuais</div>
                            <div><img src="{{ url_for('static', filename='img/exemplo-visual.png') }}" alt="imagem de exemplo visual" width="200px">
                            </div>
                        </div>
                        <div class="dica-back">
                            <div class="dica-exterior">
                                <audio controls>
                                    <source src="{{ url_for('static', filename='audios/audio3.mp3') }}"
                                        type="audio/mpeg">
                                </audio>
                                Segundo Brain Rules, as pessoas lembram 65% das informações quando apresentadas com
                                recursos visuais, mas apenas 10% do que ouvem verbalmente. Por isso, use recursos
                                visuais eficazes, sempre destacando o que é mais importante na mensagem.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dica fade-in fade-delay-6">
                    <div class="dica-inner">
                        <div class="dica-front">
                            <div class="dica-interior">Encerramento marcante</div>
                            <div><img src="{{ url_for('static', filename='img/encerramento-marcante.png') }}" alt="imagem de encerramento-marcante" width="200px">
                            </div>
                        </div>
                        <div class="dica-back">
                            <div class="dica-exterior">
                                <audio controls>
                                    <source src="{{ url_for('static', filename='audios/audio6.mp3') }}"
                                        type="audio/mpeg">
                                </audio>
                                Um bom encerramento reforça a importância do que foi dito e deixa uma impressão
                                duradoura. Finalize de forma objetiva, resuma os pontos principais e conclua com uma
                                mensagem marcante. Agora, é essencial saber como manter essas práticas no dia a dia,
                                certo?
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sessao-videochamada fade-in" id="sessao-videochamada">
        <div class="videochamada chamada">
            <h3 id="chamada">Vídeo-chamada (Via Google Meet)</h3>
            <p style="text-indent: 1em;">No Fala.i, você pode entrar em uma videochamada com um amigo para treinar
                juntos a oratória e se preparar
                melhor para apresentações de trabalhos. É uma forma prática e divertida de melhorar a forma como você
                fala em público, ganhar mais confiança e ainda ajudar o outro com dicas e sugestões. Assim, fica muito
                mais fácil mandar bem na hora de apresentar na sala de aula.</p>

            <p style="text-indent: 1em;">Siga os passos descritos ao lado para uma melhor experiência e eficácia da
                plataforma.</p>

            <a href="https://meet.google.com/landing?pli=1" class="google-meet">
                <img src="{{ url_for('static', filename='img/google-meet.png') }}" alt="" width="30px">
                Google Meet
            </a>

            <p>Crie ou entre em uma reunião!</p>
        </div>

        <div class="fluxograma chamada">
            <div class="passos-meet meet1">
                <p>Para criar reunião clique em:</p>
                <button id="criar">
                    <span class="icone">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 0 24 24" width="18" fill="white">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M13 11h8v2h-8v8h-2v-8H3v-2h8V3h2v8z" />
                        </svg>
                    </span>
                    Nova reunião
                </button>
            </div>

            <div class="passos-meet meet2">
                <div class="input-codigo">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20"
                            fill="#5f6368">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M20 5H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zM4 17V7h16v10H4zm2-8h2v2H6V9zm3 0h2v2H9V9zm3 0h2v2h-2V9zm3 0h2v2h-2V9zM6 12h2v2H6v-2zm3 0h8v2H9v-2z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Digite um código ou link" />
                </div>
                <p>Para entrar na reunião coloque o código neste campo.</p>
            </div>

            <div class="passos-meet meet3">
                <p>Após digitar o código clique em:</p>
                <button id="criar">
                    Participar agora
                </button>
            </div>

            <p id="pequeno-texto">Use os passos acima caso queira usar o Google Meet, clicando no botão ao lado.</p>
        </div>
    </section>

    <section class="sessao-videos fade-in" id="sessao-videos">
        <h3 id="dicas">Vídeos - Dicas para Oratória!</h3>
        <div class="videos-dicas fade-in">
            <div class="video fade-in">
                <iframe src="https://www.youtube.com/embed/wLZyCpz3M7k?si=swvm31YXaHf96pW2" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <h4 class="titulo-video">Técnicas para melhorar a oratória</h4>
            </div>
            <div class="video fade-in">
                <iframe src="https://www.youtube.com/embed/cTQHrNOlAUo?si=9pDrZuGvxFb_LLr2" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <h4 class="titulo-video">Curso de Oratória completo, Comunicação de Alta Performance #01</h4>
            </div>
            <div class="video fade-in">
                <iframe src="https://www.youtube.com/embed/-w9tPITrRvM?si=zhw5TBz9w3rKzBOo" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <h4 class="titulo-video">5 exercícios para treinar oratória em casa (apenas 5min POR DIA)</h4>
            </div>
            <div class="video fade-in">
                <iframe src="https://www.youtube.com/embed/JkhA2cxeOaA?si=kLqMDa1vzaEmNN-X" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <h4 class="titulo-video">Curso COMPLETO de oratória para INICIANTES</h4>
            </div>
            <div class="video fade-in">
                <iframe src="https://www.youtube.com/embed/6aLHhfMYkA8?si=kbZXzZJuyVWKZINf" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <h4 class="titulo-video">Não é só voz! Conheça os 3 pilares da oratória</h4>
            </div>
            <div class="video fade-in">
                <iframe src="https://www.youtube.com/embed/fdnPSBLHjvo?si=W0a0c0y77VLcOMQN" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <h4 class="titulo-video">Erros mortais da oratória</h4>
            </div>
        </div>
    </section>

    <footer class="footer-inicio fade-in">
        <div class="footer-inicio">
            <div class="logo-footer">
                <img src="{{ url_for('static', filename='img/logo.png') }}" alt="" id="logo-footer">
                <p>FALA.I</p>
            </div>
            <hr>
            <div class="informacoes-footer">
                <p>Endereço de e-mail: fala.i.contact@gmail.com</p><br>
                <p>Telefone: +55 (11) 98369-9658</p>
            </div>
            <div class="icons-footer">
                <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#626262" viewBox="0 0 24 24">
                        <path
                            d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-3a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </a>
                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#626262" viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 5 3.657 9.128 8.438 9.879v-6.988H7.898v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.261c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33V21.88C18.344 21.128 22 17 22 12z" />
                    </svg>
                </a>
                <a href="https://github.com" target="_blank" aria-label="GitHub">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#626262" viewBox="0 0 24 24">
                        <path
                            d="M12 0C5.371 0 0 5.373 0 12c0 5.303 3.438 9.8 8.207 11.387.6.111.793-.26.793-.577 0-.285-.01-1.04-.016-2.04-3.338.726-4.042-1.612-4.042-1.612-.546-1.387-1.333-1.756-1.333-1.756-1.09-.744.083-.729.083-.729 1.205.086 1.838 1.236 1.838 1.236 1.07 1.834 2.809 1.304 3.495.997.108-.775.419-1.305.762-1.604-2.665-.303-5.466-1.335-5.466-5.932 0-1.31.469-2.381 1.236-3.221-.124-.303-.536-1.524.117-3.176 0 0 1.008-.322 3.3 1.23a11.53 11.53 0 013.006-.404c1.02.005 2.045.138 3.006.404 2.29-1.553 3.297-1.23 3.297-1.23.655 1.653.243 2.874.119 3.176.77.84 1.235 1.911 1.235 3.221 0 4.61-2.804 5.625-5.475 5.921.43.372.823 1.102.823 2.222 0 1.604-.014 2.896-.014 3.293 0 .319.192.694.801.576C20.565 21.796 24 17.299 24 12c0-6.627-5.373-12-12-12z" />
                    </svg>
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
    <script src="{{ url_for('static', filename='PaginaInicial/PaginaInicial.js') }}"></script>

    <style>
        :root {
  /* Modo Claro */
  --fundo-branco: #ffffff;
  --cor-principal: #686bff;
  --hover: #585bfc;
  --cor-terciaria: #7779fd;
  --roxo-claro: #b2b3ff54;
  --cinza-medio: #cfd4d8;
  --roxo: #491f7a;
  --roxo2: #686bff;
  --fundo-cinza: #efefef;
  --roxo-medio: #423291;
  --texto-primario: #686bff;
  --texto-secundario: #7779fd;
  --texto-terciario: #1d1d1d;
  --fundo-container: #b2b3ff54;
  --border-color: none;
  --shadow: rgba(0, 0, 0, 0.1);
  --onda: #5c5ee2;
  --onda2: #4f3cad;
  --onda3: #423291;
  --texto: #ffffff;
  --texto2: #585bfc;
  --border-color2: #e5e7eb;
  --passos: #dedede2f;
  --borda-input: #828282;
  --fundo-input: #ffffff;
  --cor-input: #333;
}

/* Modo Escuro */
[data-theme="dark"] {
  --fundo-branco: #1a1a1a;
  --cor-principal: #8b8dff;
  --hover: #7779ff;
  --cor-terciaria: #9b9dff;
  --roxo-claro: #2a2a3a;
  --cinza-medio: #404040;
  --roxo: #e0d2f1;
  --roxo2: #e0d2f1;
  --fundo-cinza: #2d2d2d;
  --roxo-medio: #5a4291;
  --texto-primario: #e0d2f1;
  --texto-secundario: #9b9dff;
  --fundo-container: #2825307e;
  --border-color: #404040;
  --shadow: rgba(0, 0, 0, 0.3);
  --texto: #e8d6ff;
  --texto-terciario: #e0d2f1;
  --texto2: #c8ade9;
  --border-color2: #404040;
  --passos: #212127;
  --borda-input: #2d2d2d;
  --fundo-input: #b4b4b4;
  --cor-input: #222222;
}

/* FADE IN ANIMATION */
.fade-in {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.fade-in.fade-animate {
  opacity: 1;
  transform: translateY(0);
}

/* Delays para efeito staggered */
.fade-delay-1 {
  transition-delay: 0.1s;
}

.fade-delay-2 {
  transition-delay: 0.2s;
}

.fade-delay-3 {
  transition-delay: 0.3s;
}

.fade-delay-4 {
  transition-delay: 0.4s;
}

.fade-delay-5 {
  transition-delay: 0.5s;
}

.fade-delay-6 {
  transition-delay: 0.6s;
}

/* Reset de estilo */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  transition: all 0.4s ease;
}

html{
  scroll-behavior: smooth;
}

body {
  background-color: var(--fundo-branco);
  color: var(--texto-primario);
  font-family: "Titillium Web", sans-serif;
  width: 100%;
  height: 100%;
  overflow-x: hidden;
}

/* NAVEGAÇÃO - LAYOUT ORIGINAL DESKTOP */
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 40px;
  background-color: var(--fundo-branco);
}

.nav-left {
  flex: 1;
  display: flex;
  align-items: center;
}

.nav-menu {
  display: flex;
  gap: 30px;
  list-style: none;
  justify-content: center;
  flex: 2;
  padding: 0;
  margin: 0;
}

.nav-menu li a {
  color: var(--texto-primario);
  text-decoration: none;
  font-family: "Titillium Web", sans-serif;
  font-style: normal;
  font-weight: 500;
  transition: 0.4s;
}

.nav-menu li a:hover {
  color: var(--hover);
}

.nav-right {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 15px;
}

li {
  transition: 0.2s;
  font-size: 18px;
}

li:hover {
  transform: scale(1.1);
}

.logo {
  margin-left: 10px;
  animation: pulo 2s infinite;
}

/* Botão Toggle Modo Escuro */
.toggle-mode {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background-color: var(--cor-principal);
  color: var(--fundo-branco);
  border: none;
  cursor: pointer;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.toggle-mode:hover {
  background-color: var(--hover);
  transform: scale(1.1);
}

.account-btn {
  background-color: var(--cor-principal);
  color: var(--fundo-branco);
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  border-radius: 8px;
  transition: 0.4s;
  width: 155px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.account-btn:hover {
  background-color: var(--hover);
  transform: scale(1.05);
}
/* Menu mobile - OCULTO NO DESKTOP */
.mobile-menu-toggle {
  display: none;
  background: none;
  border: none;
  font-size: 24px;
  color: var(--texto-primario);
  cursor: pointer;
}

/* SEÇÃO PRINCIPAL - LAYOUT ORIGINAL DESKTOP */
.geral {
  display: flex;
}

.titulo {
  color: var(--texto-primario);
  font-size: 60px;
  font-family: "Righteous";
  text-align: left;
  width: 30px;
  padding-top: 40px;
  padding-left: 40px;
  margin-left: 80px;
  margin-top: 50px;
  transition: 0.4s;
  cursor: default;
  scale: 93%;
}

h1 {
  cursor: default;
}

header {
  cursor: default;
}

.titulo:hover {
  color: var(--hover);
  transform: scale(1.06);
}

.comecando {
  width: 620px;
  height: 150px;
  border-radius: 30px;
  cursor: default;
  scale: 80%;
  transition: 0.4s;
  margin-left: 60px;
}

#textinho {
  color: var(--texto-secundario);
  font-size: 20px;
  margin-top: 20px;
}

.botao-comecar button {
  background-color: var(--cor-principal);
  border: none;
  width: 550px;
  height: 80px;
  border-radius: 13px;
  font-size: 37px;
  cursor: pointer;
  font-family: Titillium Web, sans-serif;
  text-align: center;
  margin-top: -200px;
  color: var(--fundo-branco);
  transition: 0.4s;
  box-shadow: 0 0 12px var(--hover);
}

.botao-comecar button:hover {
  background-color: var(--hover);
  font-family: Titillium Web, sans-serif;
  transform: scale(1.015);
}

.espaco {
  border-radius: 15px;
  padding: 15px;
  background-color: var(--fundo-container);
  width: 670px;
  margin-top: 120px;
  margin-left: 100px;
  height: 230px;
  max-width: 670px;
  overflow-wrap: break-word;
  word-break: break-word;
  white-space: normal;
  display: flex;
  gap: 60px;
  justify-content: center;
  transition: all 0.4s;
  box-shadow: 0 0 10px var(--border-color);
}

.balao-fala {
  position: relative;
  background-color: var(--fundo-branco);
  padding: 20px;
  border-radius: 30px;
  width: 100%;
  max-width: 350px;
  color: var(--roxo2);
  text-wrap: wrap;
  text-align: justify;
  display: flex;
  align-items: center;
}

#logo-container {
  animation: pulo 2s infinite;
  margin-top: 30px;
}

#textos {
  max-width: 580px;
  cursor: pointer;
  color: var(--cor-principal);
}

/* CARDS PRINCIPAIS - LAYOUT ORIGINAL DESKTOP */
.cards-container {
  display: flex;
  justify-content: center;
  gap: 100px;
  margin-top: 10px;
  scale: 80%;
  padding-top: 60px;
}

.card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  cursor: pointer;
}

.card img {
  width: clamp(150px, 25vw, 260px);
  height: auto;
  max-width: 100%;
}

.card-agenda,
.card-microfone,
.card-ranking {
  background-color: var(--fundo-container);
  box-shadow: 0 0 10px var(--border-color);
  width: 500px;
  height: 380px;
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: transform 0.3s ease;
  backdrop-filter: blur(10px);
}

.card-agenda:hover,
.card-microfone:hover,
.card-ranking:hover {
  transform: scale(1.07);
}

.botao {
  width: 500px;
  background-color: var(--cor-principal);
  color: var(--fundo-branco);
  font-size: 18px;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  border-radius: 13px;
  transition: 0.4s ease;
  text-align: center;
  font-family: Titillium Web, sans-serif;
}

.botao:hover {
  background-color: var(--hover);
  transform: scale(1.06);
  font-family: Titillium Web, sans-serif;
}

.botao a {
  text-decoration: none;
  color: var(--fundo-branco);
}

/* SEÇÃO DE CONTEÚDO - LAYOUT ORIGINAL */
.conteudo {
  background: linear-gradient(to bottom, var(--onda), var(--onda), var(--onda3));
  padding: 60px 90px;
  text-align: justify;
  color: white;
  position: relative;
  margin: 0;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  gap: 30px;
}

/* SEÇÃO ORATÓRIA - LAYOUT ORIGINAL DESKTOP */
.oratoria-sessao {
  padding: 90px;
  padding-top: 54px;
  margin: 0;
  background-color: var(--fundo-branco);
}

#oratoria-img {
  width: 625px;
  height: 430px;
  max-width: 625px;
  max-height: 430px;
  object-fit: cover;
  border-radius: 15px;
  box-shadow: 0 0 10px var(--border-color);
}

.texto-oratoria {
  width: 625px;
  height: 430px;
  max-width: 625px;
  max-height: 430px;
}

.oratoria {
  display: flex;
  gap: 150px;
  justify-content: center;
}

h3 {
  color: var(--roxo);
  margin-top: 10px;
  margin-bottom: 10px;
  font-size: 30px;
  font-family: "Titillium Web";
}

#dicas {
  margin-top: 0;
  color: var(--roxo);
  font-size: 30px;
  font-family: "Titillium Web";
  margin-bottom: 30px;
  margin-left: 10px;
}

#texto-oratoria {
  font-family: "Titillium Web";
  color: var(--roxo);
  font-size: 18px;
  text-indent: 1em;
  text-align: justify;
}

/* SEÇÃO DICAS - LAYOUT ORIGINAL DESKTOP */
.sessao-dicas {
  padding: 90px;
  padding-top: 10px;
  margin: 0;
  background-color: var(--fundo-branco);
}

.container-dicas {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 40px;
}

.dicas-principal {
  display: flex;
  gap: 40px;
  justify-content: center;
}

.dica {
  height: 400px;
  width: 425px;
  max-width: 500px;
  display: flex;
  flex-direction: column;
  padding: 40px;
  background-color: #4c0a9f;
  border-radius: 22px;
  text-align: justify;
  justify-content: center;
  perspective: 1500px;
}

.dica-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: justify;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.dica:hover .dica-inner {
  transform: rotateY(180deg);
}

.dica-front,
.dica-back {
  padding: 10px;
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  border-radius: 10px;
}

.dica-back {
  transform: rotateY(180deg);
}

.dica-interior {
  background-color: #4c0a9f;
  height: 60px;
  border-radius: 5px;
  text-align: center;
  justify-content: center;
  display: flex;
  align-items: center;
  color: var(--texto);
  font-family: "Unbounded";
  font-size: 19px;
  width: 350px;
}

.dica-exterior {
  padding: 15px;
  height: 450px;
  width: 350px;
  word-wrap: break-word;
  border-radius: 20px;
  font-family: "Titillium Web";
  color: var(--roxo);
  font-size: 18px;
  text-indent: 1em;
  background-color: var(--fundo-branco);
  box-shadow: 0 0 10px var(--border-color);
  align-items: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

audio {
  margin-bottom: 10px;
  border-radius: 10px;
}

/* ONDAS - LAYOUT ORIGINAL */
section.sessao-onda {
  position: relative;
  width: 100%;
  height: 150px;
  margin: 0;
  padding: 0;
}

section.sessao-onda2 {
  position: relative;
  width: 100%;
  height: 150px;
  transform: rotate(180deg);
  margin: 0;
  padding: 0;
}

@keyframes ondaAnimada {
  0% {
    transform: translateY(0px);
  }
  100% {
    transform: translateY(10px);
  }
}

.onda {
  width: 100%;
  height: 95px;
  position: absolute;
  bottom: 0;
  background-image: url(/static/img/onda.png);
  background-size: 1000px 100px;
  animation: ondaAnimada 1.5s ease-in-out infinite alternate;
}

.onda2 {
  width: 100%;
  height: 100px;
  position: absolute;
  bottom: 0;
  background-image: url(/static/img/onda2.png);
  background-size: 1000px 100px;
  animation: ondaAnimada 1.5s ease-in-out infinite alternate;
  transform: rotate(180deg);
}

#onda1,
#onda5 {
  z-index: 1000;
  opacity: 1;
  background-position-x: 600px;
}

#onda2,
#onda6 {
  z-index: 999;
  opacity: 0.5;
  background-position-x: 400px;
}

#onda3,
#onda7 {
  z-index: 998;
  opacity: 0.2;
  background-position-x: 200px;
}

#onda4,
#onda8 {
  z-index: 997;
  opacity: 0.8;
  background-position-x: 100px;
}

/* ANIMAÇÕES ORIGINAIS */
@keyframes blink {
  50% {
    opacity: 0;
  }
}

@keyframes pulo {
  0%,
  100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

.sessao-videochamada{
  padding: 90px;
  padding-top: 40px;
  margin: 0;
  background-color: var(--fundo-branco);
  display: flex;
  gap: 150px;
  justify-content: center;
}

.chamada{
  width: 100%;
  max-width: 630px;
  height: auto;
  text-align: justify;
}

#chamada{
  margin-left: 10px;
}

.videochamada{
  font-family: "Titillium Web";
  color: var(--roxo);
  font-size: 18px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.google-meet {
  background-color: var(--fundo-branco);
  color: var(--preto);
  border: 2px solid var(--border-color2);
  padding: 15px 20px;
  font-weight: bold;
  font-family: "Georgia", serif;
  font-size: 18px;
  border-radius: 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  width: 100%;
  max-width: 300px;
  height: 60px;
  transition: 0.4s;
  margin: 0;
  justify-content: center;
  gap: 15px;
  box-shadow: 0 0 10px var(--shadow);
}

.google-meet:hover {
  transform: scale(1.03);
  border-color: var(--cor-principal);
}

a{
  text-decoration: none;
}

.fluxograma{
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.passos-meet{
  width: 100%;
  height: 110px;
  background-color: var(--passos);
  color: var(--roxo);
  border: 2px solid var(--border-color2);
  padding: 15px 20px;
  border-radius: 12px;
  transition: 0.4s;
  margin: 0;
  box-shadow: 0 0 10px var(--shadow);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 30px;
  font-family: 'Titillium Web';
  font-size: 18px;
}

.meet1:hover{
  transform: translateY(-5px) scale(1.01);
  box-shadow: 0 4px 8px var(--shadow);
}

.meet2:hover{
  transform: translateY(0) scale(1.01);
  box-shadow: 0 4px 8px var(--shadow);
}

.meet3:hover{
  transform: translateY(5px) scale(1.01);
  box-shadow: 0 4px 8px var(--shadow);
}

#criar{
  display: inline-flex;
  align-items: center;
  gap: 8px; /* Espaço entre ícone e texto */
  padding: 10px 20px;
  background-color: #1a73e8; /* Azul Google */
  color: white;
  text-decoration: none;
  font-weight: 500;
  border-radius: 999px; /* Totalmente arredondado */
  font-family: Arial, sans-serif;
  font-size: 14px;
  font-weight: 500;
  transition: background-color 0.3s ease;
  border: none;
  height: 45px;
  pointer-events: none;
}

.icone {
  font-size: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.input-codigo {
  display: flex;
  align-items: center;
  border: 1px solid var(--borda-input);
  border-radius: 10px;
  padding: 8px 12px;
  width: fit-content;
  background-color: var(--fundo-input);
  transition: border-color 0.3s;
}

.input-codigo input {
  border: none;
  outline: none;
  font-size: 16px;
  color: var(--cor-input);
  padding-left: 8px;
  font-family: Arial, sans-serif;
  border: none;
  pointer-events: none;
  background-color: var(--fundo-input);
}

.input-icon {
  display: flex;
  align-items: center;
  justify-content: center;
}

#pequeno-texto{
  font-family: 'Titillium Web';
  color: var(--roxo);
  font-size: 18px;
}

/* SEÇÃO VÍDEOS */
.sessao-videos {
  padding: 90px;
  padding-top: 0;
  width: 100%;
  background-color: var(--fundo-branco);
}

.videos-dicas {
  gap: 30px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

iframe {
  border-radius: 10px;
  width: 420px;
  height: 238px;
  box-shadow: 0 0 10px var(--border-color);
}

.video {
  display: flex;
  flex-direction: column;
  text-wrap: wrap;
  width: 420px;
}

.titulo-video {
  font-family: Arial, Helvetica, sans-serif;
  margin-top: 10px;
  font-weight: 400;
  color: var(--texto-terciario);
}

/* FOOTER */
footer {
  padding: 90px;
  padding-bottom: 30px;
  padding-top: 45px;
  background-color: var(--fundo-container);
  box-shadow: 0 0 10px var(--border-color);
  margin-bottom: 0;
}

#logo-footer {
  width: 80px;
}

.logo-footer {
  display: flex;
  align-items: center;
  padding-bottom: 10px;
  gap: 30px;
  font-family: "Righteous";
  font-size: 40px;
  color: var(--cor-principal);
}

.footer-inicio {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
}

hr {
  width: 300%;
  color: var(--cinza-medio);
  border-color: var(--border-color);
}

.informacoes-footer {
  text-align: center;
  font-family: "Titillium Web";
  color: #626262;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.icons-footer {
  text-decoration: none;
  gap: 15px;
  display: flex;
}

.caminhos-footer, .copright {
  display: flex;
  color: #626262;
  gap: 10px;
  font-family: "Titillium Web";
}

.caminhos-footer a {
  text-decoration: none;
  color: #626262;
  font-family: "Titillium Web";
}

.caminhos-footer a:hover {
  text-decoration: underline;
}

.quem-somos{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 50%;
}

.quem-somos #quem-somos{
  color: white;
}

.sobre{
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  width: 100%;
  gap: 15px;
  font-family: 'Titillium Web';
  font-size: 18px;
}

/* ========================================= */
/* RESPONSIVIDADE - SÓ PARA TELAS MENORES */
/* ========================================= */

/* Tablets grandes (1024px - 1200px) */
@media (max-width: 1200px) {
  .cards-container {
    gap: 60px;
    scale: 75%;
  }

  .oratoria {
    gap: 100px;
  }

  .sessao-dicas {
    padding: 60px;
  }
}

/* Tablets (768px - 1024px) */
@media (max-width: 1024px) {
  nav {
    padding: 15px 20px;
  }

  .geral {
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 20px;
  }

  .titulo {
    font-size: 50px;
    margin: 20px auto;
    padding: 0;
    width: auto;
    text-align: center;
  }

  .comecando {
    width: 100%;
    max-width: 500px;
    margin: 20px auto;
    scale: 100%;
  }

  .botao-comecar button {
    width: 100%;
    max-width: 400px;
    margin-top: 0;
    height: 60px;
    font-size: 24px;
  }

  .espaco {
    width: 100%;
    min-width: 500px;
    margin: 20px auto;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    height: 100%;
  }

  .balao-fala::after {
    left: 50%;
    bottom: -15px;
    top: auto;
    transform: translateX(-50%);
    border-color: var(--fundo-branco) transparent transparent transparent;
  }

  .cards-container {
    flex-direction: column;
    align-items: center;
    gap: 40px;
    scale: 100%;
  }

  .card-agenda,
  .card-microfone,
  .card-ranking {
    width: 100%;
    min-width: 500px;
    height: 300px;
  }

  .botao {
    width: 100%;
    min-width: 500px;
  }

  .oratoria {
    flex-direction: column;
    gap: 40px;
    text-align: center;
  }

  #oratoria-img {
    width: 100%;
    max-width: 500px;
    height: 300px;
  }

  .texto-oratoria {
    width: 100%;
    max-width: 500px;
    height: auto;
  }

  .texto-oratoria h3 {
    text-align: center;
  }

  .oratoria-sessao {
    padding: 60px 40px;
    display: flex;
    justify-content: center;
  }

  .sessao-dicas {
    padding: 60px 40px;
  }

  #dicas {
    text-align: center;
    margin-left: 0;
  }

  .dicas-principal {
    flex-direction: column;
    align-items: center;
  }

  .container-dicas {
    flex-direction: row;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
  }

  .dica {
    width: 100%;
    min-width: 500px;
    height: 350px;
    padding: 25px;
  }

  .dica-interior {
    width: 100%;
    min-width: 300px;
    font-size: 16px;
    height: 50px;
    padding: 10px;
    line-height: 1.2;
  }

  .dica-exterior {
    width: 100%;
    min-width: 430px;
    height: 100%;
    font-size: 15px;
    padding: 12px;
    overflow-y: auto;
  }

  .card img {
    width: clamp(120px, 20vw, 200px);
  }
}

/* Mobile (480px - 768px) */
@media (max-width: 768px) {
  .nav-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--fundo-branco);
    box-shadow: 0 0 10px var(--border-color);
    flex-direction: column;
    padding: 20px;
    box-shadow: 0 4px 6px var(--shadow);
    gap: 15px;
    z-index: 1000;
  }

  .sessao-dicas {
    margin-top: 120px;
  }

  .espaco {
    width: 100%;
    min-width: 400px;
    height: 100%;
  }

  .nav-menu.active {
    display: flex;
  }

  .mobile-menu-toggle {
    display: block;
    position: absolute;
    right: 180px;
    top: 25px;
  }

  .nav-right {
    flex-direction: row;
    gap: 10px;
  }

  .account-btn {
    font-size: 12px;
    padding: 8px 12px;
    width: auto;
    min-width: 100px;
  }

  .account-btn span {
    display: none;
  }

  .toggle-mode {
    width: 40px;
    height: 40px;
    font-size: 16px;
  }

  .titulo {
    font-size: 40px;
  }

  .botao-comecar button {
    font-size: 20px;
    height: 50px;
  }

  .cards-container {
    padding: 40px 20px;
  }

  /* CARDS PRINCIPAIS MAIORES PARA MOBILE */
  .card-agenda,
  .card-microfone,
  .card-ranking {
    width: 100%;
    min-width: 400px;
    height: 320px;
    margin: 0 auto;
  }

  .botao {
    width: 100%;
    max-width: 450px;
    font-size: 20px;
    padding: 15px 20px;
  }

  .card img {
    width: clamp(180px, 25vw, 220px);
  }

  .conteudo {
    padding: 40px 20px;
  }

  .oratoria-sessao {
    padding: 40px 20px;
  }

  .sessao-dicas {
    padding: 40px 20px;
  }

  .container-dicas {
    flex-direction: column;
    align-items: center;
    gap: 25px;
  }

  .dica {
    width: 100%;
    min-width: 400px;
    height: 300px;
    padding: 20px;
  }

  .dica-interior {
    width: 100%;
    min-width: 360px;
    font-size: 15px;
    height: 50px;
    padding: 8px;
    line-height: 1.1;
  }

  .dica-exterior {
    width: 100%;
    min-width: 360px;
    height: 100%;
    font-size: 14px;
    padding: 10px;
    text-indent: 0.5em;
  }

  audio {
    width: 100%;
    max-width: 250px;
    height: 30px;
  }
}

/* Mobile pequeno (até 480px) */
@media (max-width: 480px) {
  nav {
    padding: 10px 15px;
  }

  .mobile-menu-toggle {
    right: 120px;
  }

  .espaco {
    width: 100%;
    height: 100%;
    min-width: 320px;
  }

  .account-btn {
    font-size: 11px;
    padding: 6px 10px;
    min-width: 80px;
  }

  .toggle-mode {
    width: 35px;
    height: 35px;
    font-size: 14px;
  }

  .geral {
    padding: 15px;
  }

  .titulo {
    font-size: 35px;
  }

  .botao-comecar button {
    font-size: 18px;
    height: 45px;
  }

  .cards-container {
    padding: 30px 15px;
  }

  /* CARDS PRINCIPAIS AINDA MAIORES PARA MOBILE PEQUENO */
  .card-agenda,
  .card-microfone,
  .card-ranking {
    width: 100%;
    min-width: 320px;
    height: 280px;
    margin: 0 auto;
  }

  .botao {
    width: 100%;
    min-width: 320px;
    font-size: 18px;
    padding: 12px 20px;
  }

  .card img {
    width: clamp(150px, 22vw, 180px);
  }

  .conteudo {
    padding: 30px 15px;
  }

  .oratoria-sessao,
  .sessao-dicas {
    padding: 30px 15px;
  }

  .sessao-dicas {
    margin-top: 160px;
  }

  .dica {
    width: 100%;
    min-width: 320px;
    height: 280px;
    padding: 15px;
  }

  .dica-interior {
    font-size: 13px;
    width: 100%;
    min-width: 280px;
    height: 45px;
    padding: 6px;
    line-height: 1.1;
  }

  .dica-exterior {
    font-size: 13px;
    width: 100%;
    min-width: 280px;
    height: 100%;
    padding: 8px;
    text-indent: 0.5em;
  }

  audio {
    width: 100%;
    max-width: 200px;
    height: 28px;
  }
}

/* Mobile muito pequeno (até 360px) */
@media (max-width: 360px) {
  /* CARDS PRINCIPAIS OTIMIZADOS PARA TELAS MUITO PEQUENAS */
  .card-agenda,
  .card-microfone,
  .card-ranking {
    width: 100%;
    max-width: 320px;
    height: 240px;
    margin: 0 auto;
  }

  .botao {
    width: 100%;
    max-width: 320px;
    font-size: 16px;
    padding: 10px 15px;
  }

  .card img {
    width: clamp(120px, 20vw, 150px);
  }

  .dica {
    width: 100%;
    max-width: 250px;
    height: 260px;
    padding: 12px;
  }

  .dica-interior {
    font-size: 12px;
    height: 40px;
    padding: 5px;
    line-height: 1;
  }

  .dica-exterior {
    font-size: 12px;
    padding: 6px;
    text-indent: 0.3em;
  }

  audio {
    width: 100%;
    max-width: 180px;
    height: 25px;
  }
}

/* Acessibilidade */
@media (prefers-reduced-motion: reduce) {
  .fade-in,
  .logo,
  #logo-container,
  .onda,
  .onda2 {
    animation: none;
    transition: none;
  }

  .dica-inner {
    transition: none;
  }

  .dica:hover .dica-inner {
    transform: none;
  }
}

body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(3px);
  background-color: rgba(52, 52, 52, 0.1);
  z-index: 9999;
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
}

/* Quando ativado */
body.blur-ativa::before {
  opacity: 1;
}
    </style>

    <script>
        const dicas = document.querySelectorAll(".dica")
dicas.forEach((dica) => {
  dica.addEventListener("mouseenter", () => {
    document.body.classList.add("blur-ativa")
    dica.style.zIndex = "9999" // traz a dica para frente
  })
  dica.addEventListener("mouseleave", () => {
    document.body.classList.remove("blur-ativa")
    dica.style.zIndex = "" // reseta o z-index
  })
})

var onda1 = document.getElementById("onda1")
var onda2 = document.getElementById("onda2")
var onda3 = document.getElementById("onda3")
var onda4 = document.getElementById("onda4")
var onda5 = document.getElementById("onda5")
var onda6 = document.getElementById("onda6")
var onda7 = document.getElementById("onda7")
var onda8 = document.getElementById("onda8")

window.addEventListener("scroll", function () {
  var rolagemPos = this.window.scrollY
  onda1.style.backgroundPositionX = 600 + rolagemPos * 1.5 + "px"
  onda2.style.backgroundPositionX = 400 + rolagemPos * -1.5 + "px"
  onda3.style.backgroundPositionX = 200 + rolagemPos * 0.5 + "px"
  onda4.style.backgroundPositionX = 100 + rolagemPos * -0.5 + "px"
  onda5.style.backgroundPositionX = 100 + rolagemPos * 1.5 + "px"
  onda6.style.backgroundPositionX = 100 + rolagemPos * -1.5 + "px"
  onda7.style.backgroundPositionX = 100 + rolagemPos * 0.5 + "px"
  onda8.style.backgroundPositionX = 100 + rolagemPos * -0.5 + "px"
})

// Intersection Observer para fade in
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-animate")
        }
      })
    },
    {
      threshold: 0.1,
      rootMargin: "-50px",
    },
  )
  // Observar todos os elementos com classe fade-in
  const fadeElements = document.querySelectorAll(".fade-in")
  fadeElements.forEach((el) => observer.observe(el))
})

// Função para toggle do menu mobile
function toggleMobileMenu() {
  const menu = document.getElementById("nav-menu")
  menu.classList.toggle("active")
}

// Fechar menu mobile ao clicar em um link
document.addEventListener("DOMContentLoaded", () => {
  const menuLinks = document.querySelectorAll(".nav-menu a")
  const menu = document.getElementById("nav-menu")
  menuLinks.forEach((link) => {
    link.addEventListener("click", () => {
      menu.classList.remove("active")
    })
  })
})

// Fechar menu mobile ao clicar fora dele
document.addEventListener("click", (event) => {
  const menu = document.getElementById("nav-menu")
  const toggle = document.querySelector(".mobile-menu-toggle")
  if (!menu.contains(event.target) && !toggle.contains(event.target)) {
    menu.classList.remove("active")
  }
})

// Gerenciamento do Modo Escuro - SISTEMA UNIFICADO
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

// Animação de fade-in
function observeElements() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-animate")
        }
      })
    },
    {
      threshold: 0.1,
    },
  )
  const fadeElements = document.querySelectorAll(".fade-in")
  fadeElements.forEach((element) => {
    observer.observe(element)
  })
}

// Inicialização quando a página carregar
document.addEventListener("DOMContentLoaded", () => {
  // Inicializa o gerenciador de tema
  new ThemeManager()
  // Inicializa animações de fade-in
  observeElements()
})
    </script>
</body>

</html>