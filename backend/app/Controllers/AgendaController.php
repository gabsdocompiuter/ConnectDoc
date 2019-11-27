<?php namespace App\Controllers;
use \App\Models\Agenda; 
include_once BASE_PATH . "/config.php";
 
 class AgendaController { 

    //get
    public function agenda(){
        echo Agenda::selectAll();
    }

    //processa o cadastro e insere no BD
    public function store()
    {
        // pega os dados do formuário
        $id_medico = isset($_POST['id_medico']) ? $_POST['id_medico'] : null;
        $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;
        /*if(isset($_POST['horario'])){
            $data = isset($_POST['horario']) ? $_POST['horario'] : null;
                $dataFormatada = date("Y-m-d H:i:s",strtotime($data));
            $horario = $dataFormatada;
        }*/
        $horario = isset($_POST['horario']) ? $_POST['horario'] : null;
        $agendador = isset($_POST['agendador']) ? $_POST['agendador'] : null;
 
        echo Agenda::save($id_medico, $id_paciente, $horario, $agendador);
    }

    public function edit($id)
    {
           echo Agenda::selectEdit($id);
    }

    public function consultas($data, $medico)
    {
        echo Agenda::selectConsultas($data, $medico);  
    }

    public function update()
    {
        // pega os dados do formuário
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $id_medico = isset($_POST['id_medico']) ? $_POST['id_medico'] : null;
        $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;
        $horario = isset($_POST['horario']) ? $_POST['horario'] : null;
        $agendador = isset($_POST['agendador']) ? $_POST['agendador'] : null;
        echo Agenda::update($id, $id_medico, $id_paciente, $horario, $agendador);
        
    }

    
 }