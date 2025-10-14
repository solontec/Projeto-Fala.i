<?php

require_once "../config/config.php";
require_once "../src/Model/AgendaModel.php";



if($_SERVER["REQUEST_METHOD"] === "POST"){
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $data_tarefa = $_POST["data_tarefa"];
        
        

        if(AgendaModel::criarTarefa($titulo, $descricao, $data_tarefa)){
            echo "tarefa cadastrada";
            exit;
        } else{
            echo "erro";
        }
        
        
        
        
}
