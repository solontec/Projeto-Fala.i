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
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
</head>
<body>
  <h2>Redefinir Senha</h2>
  <form method="POST">
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    <label>Nova Senha:</label>
    <input type="password" name="nova_senha" required minlength="6"><br><br>
    <button type="submit">Salvar Nova Senha</button>
  </form>
  <script src="static/PaginaAcessibilidade/PaginaAcessibilidade.js"></script>
</body>
</html>
