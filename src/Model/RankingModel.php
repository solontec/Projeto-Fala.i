<?php
require_once "../config/config.php";

class RankingModel {
    const PONTOS_LOGIN = 5;
    const PONTOS_CHATBOT = 10;
    const PONTOS_TEMPO = 3;

    public static function adicionarPontos($usuario_id, $tipo) {
        $pontos = match($tipo) {
            'login' => self::PONTOS_LOGIN,
            'chatbot' => self::PONTOS_CHATBOT,
            'tempo' => self::PONTOS_TEMPO,
            default => 0
        };

        if ($pontos <= 0) return;

        $pdo = getConnection(); 

        // ✅ Evita múltiplos pontos de login no mesmo dia
        if ($tipo === 'login') {
            $sqlCheck = "SELECT COUNT(*) FROM tb_pontuacao_detalhada
                         WHERE usuario_id = ? 
                         AND tipo_acao = 'login' 
                         AND DATE(data_registro) = CURDATE()";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->bind_param("i", $usuario_id);
            $stmtCheck->execute();
            $stmtCheck->bind_result($count);
            $stmtCheck->fetch();
            $stmtCheck->close();

            if ($count > 0) {
                return; // já ganhou pontos de login hoje
            }
        }

        // Atualiza tabela principal de ranking (total acumulado)
        $sql = "INSERT INTO tb_ranking (usuario_id, pontos)
                VALUES (?, ?)
                ON DUPLICATE KEY UPDATE pontos = pontos + VALUES(pontos)";
        $stmt = $pdo->prepare($sql);
        $stmt->bind_param("ii", $usuario_id, $pontos);
        $stmt->execute();

        // Grava histórico detalhado (tipo e data)
        $sqlDetalhe = "INSERT INTO tb_pontuacao_detalhada (usuario_id, tipo_acao, pontos)
                       VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sqlDetalhe);
        $stmt->bind_param("isi", $usuario_id, $tipo, $pontos);
        $stmt->execute();
    }

    public static function getRanking() {
        $pdo = getConnection(); // <-- alterado aqui
        $sql = "SELECT u.nome, r.pontos
                FROM tb_ranking r
                JOIN usuarios u ON u.id = r.usuario_id
                ORDER BY r.pontos DESC";

        $result = $pdo->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
