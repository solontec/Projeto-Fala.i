<?php

require_once "../config/config.php";


class AgendaModel{
    public static function criarTarefa(){

        $connect = getConnection();
        $criar = $connect->prepare("INSERT INTO tb_tarefas(titulo, descricao, data_tarefa) VALUES (?,?,?) ");

        $criar->bind_param("sss", $titulo, $descricao, $data_tarefa);
        $criar->execute();

        $criar->close();
        $connect->close();

    }   
}