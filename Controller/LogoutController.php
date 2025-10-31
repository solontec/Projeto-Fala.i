<?php
// Arquivo: LogoutController.php

session_start();

// Remove todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: ../public/PaginaLogin.php");
exit;
