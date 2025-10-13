    <?php

    require_once "../config/config.php";

    class UsuarioModel{

        public static function cadastrar($nome, $rm, $email, $senha){

                $connect = getConnection();
                $cadastrar = $connect->prepare("INSERT INTO usuarios (nome, rm, email, senha) VALUES (?,?,?,?)");
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $cadastrar->bind_param("ssss", $nome, $rm, $email, $senha_hash);

                $cadastrar->execute();

                $cadastrar->close();
                $connect->close();
            
            
        }
        
         public static function buscarUsuarioPorRmEEmail($rm, $email) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE rm = ? AND email = ?");
        $stmt->bind_param("ss", $rm, $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $usuario ?: null;
    }

    public static function logarUsuario($rm, $email, $senha) {
        $usuario = self::buscarUsuarioPorRmEEmail($rm, $email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario; 
        } else {
            return null; 
        }
    }

    public static function atualizarSenha($email, $novaSenha) {
        $conn = getConnection();
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $hash, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Senha atualizada com sucesso!";
        } else {
            echo " Nenhum usuário encontrado com esse e-mail.";
        }

        $stmt->close();
        $conn->close();
    }

    }