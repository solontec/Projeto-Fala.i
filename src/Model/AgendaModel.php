<?php
require_once "../config/config.php";

class AgendaModel {
    public static function criarTarefa($usuario_id, $titulo, $descricao, $dataHora) {
        $connect = getConnection();

        $data = date('Y-m-d', strtotime($dataHora));
        $hora = date('H:i:s', strtotime($dataHora));

        $sql = "INSERT INTO tb_tarefas (usuario_id, titulo, descricao, data_tarefa, horario_tarefa)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("issss", $usuario_id, $titulo, $descricao, $data, $hora);

        $resultado = $stmt->execute();

        $stmt->close();
        $connect->close();

        return $resultado;
    }

    public static function listarTarefas($usuario_id) {
        $connect = getConnection();

        $sql = "SELECT id, titulo, descricao, data_tarefa, horario_tarefa, status 
                FROM tb_tarefas 
                WHERE usuario_id = ? 
                ORDER BY data_tarefa ASC, horario_tarefa ASC";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $tarefas = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $connect->close();

        return $tarefas;
    }

}
