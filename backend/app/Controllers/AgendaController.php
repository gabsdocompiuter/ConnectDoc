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

    public function consultas($id, $dia, $mes)
    {
        switch(strtolower($mes)){
           case 'jan':
                $mes = 1;
            break;
            case 'fev':
                $mes = 2;
            break;
            case 'mar':
                $mes = 3;
            break;
            case 'abr':
                $mes = 4;
            break;
            case 'mai':
                $mes = 5;
            break;
            case 'jun':
                $mes = 6;
            break;
            case 'jul':
                $mes = 7;
            break;
            case 'ago':
                $mes = 8;
            break;
            case 'set':
                $mes = 9;
            break;
            case 'out':
                $mes = 10;
            break;
            case 'nov':
                $mes = 11;
            break;
            case 'dez':
                $mes = 12;
            break;
        }
        $ano = date('Y');
    
          echo Agenda::selectConsultas($id, $dia, $mes, $ano);
          
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