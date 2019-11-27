<?php namespace App\Models;
use App\DB; 
include_once BASE_PATH . "/config.php";

class Agenda {
    public static function save(
        $medico,
        $paciente,
        $horario
    ){

        // insere no banco
        $DB = new DB;
        //insere na tabela usuario    
        $sql = "INSERT INTO agenda
                   VALUES (DEFAULT
                         , :medico
                         , :horario
                         , :paciente
                         , NULL);";

        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':medico', $medico);
        $stmt->bindParam(':paciente', $paciente);
        $stmt->bindParam(':horario', $horario);
        
        if ($stmt->execute())
        {
            return getJsonResponse(true, 'Agendado com sucesso');
        }
        else return getJsonResponse(false, 'Houve um erro ao agendar');
    }

    public static function selectEdit($id){
        $sql = "SELECT * FROM agenda where id = :id";

        $DB = new DB; 
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()){
            $agendas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($agendas) <= 0){
                return getJsonResponse(false, 'Houve um erro');
            }
            else{
                $agenda = $agendas[0];
                $editAgenda = array(
                    'id'         => $agenda['id'],
                    'id_medico'  => $agenda['id_medico'],
                    'id_paciente'=> $agenda['id_paciente'],
                    'horario'    => $agenda['horario'],
                    'agendador'  => $agenda['agendador'],
                );

                return json_encode($editAgenda);   
            }
        }
        else return getJsonResponse(false, 'Erro ao editar');
    }

    public static function selectConsultas($data, $medico){
        $sql = "SELECT TIME_FORMAT(horario, '%H:%i') AS horario
                     , NULL AS nome

                   FROM agendaPadrao
                   WHERE TIME(horario) NOT IN (SELECT TIME(horario)
                                                  FROM agenda
                                                  WHERE id_medico = :medico
                                                   AND DATE(horario) = :data)

                UNION

                   SELECT TIME_FORMAT(A.horario, '%H:%i') AS horario
                        , A.paciente AS nome
                   FROM agenda AS A
                    
                   WHERE A.id_medico = :medico
                        AND DATE(horario) = :data
           
                   ORDER BY horario"; 

        $DB = new DB; 
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':medico',$medico);
    
        if ($stmt->execute()){
            $agendas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($agendas) <= 0){
                return getJsonResponse(false, 'Erro ao consultar');
            }
            else{
                for ($i = 0; $i < count($agendas); $i++) {
                    $agenda = $agendas[$i];
                    $arrayAgenda[$i] = array(
                        'nomePaciente'=> $agenda['nome'],
                        'horario' => $agenda['horario']
                    );
                }
         
                return json_encode($arrayAgenda);   
           }
        }
        else return getJsonResponse(false, 'Não há consultas ');
    }

        public static function update($id, $id_medico, $id_paciente, $horario, $agendador)
        {
            // validação (bem simples, só pra evitar dados vazios)
            if (empty($id_medico)
            ||  empty($id_paciente)
            ||  empty($horario)
           
            ){
                return getJsonResponse(false, 'Campos nao informados');
            }
        
            
            // insere no banco
            $DB = new DB;
            $sql = "UPDATE agenda SET id_medico = :id_medico, id_paciente = :id_paciente,  horario = :horario, agendador = :agendador WHERE id = :id";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id_medico', $id_medico);
            $stmt->bindParam(':id_paciente', $id_paciente);
            $stmt->bindParam(':horario', $horario);
            $stmt->bindParam(':agendador', $agendador);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
        }

        public static function selectAll(){
            //busca todos os registros da agenda
            $sql = "SELECT * from agenda "; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $agendas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            //busca o nome do medico 
            $sql = "SELECT distinct age.*, med.*, us.nome
            FROM agenda age
           INNER JOIN medicos med ON age.id_medico = med.id JOIN usuario us ON us.id = med.id_usuario "; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $medicos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            //busca nome do paciente
            $sql = "SELECT distinct age.*, pac.*, us.nome
            FROM agenda age
           INNER JOIN paciente pac ON age.id_paciente = pac.id JOIN usuario us ON us.id = pac.id_usuario  "; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $pacientes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            //busca nome do agendador(secretaria)
            $sql = "SELECT distinct age.*, sec.*, us.nome
            FROM agenda age
           INNER JOIN secretaria sec ON age.agendador = sec.id JOIN usuario us ON us.id = sec.id_usuario   "; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $agendadores = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            for ($i = 0; $i < count($agendas); $i++) {
                $agenda = $agendas[$i];
                $medico = $medicos[$i];
                $paciente = $pacientes[$i];
                //$agendador = $agendadores[$i];
                $arrayAgenda[$i] = array(
                    'id' => $agenda['id'],
                    'medico' => $medico['nome'],
                    'paciente'=> $paciente['nome'],
                    'horario' => $agenda['horario'],
                    
                );
            }
        
    
            if ($stmt->execute())
            {
                $agendas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if(count($agendas) <= 0){
                    return getJsonResponse(false, $msgErro);
                }
                else{
                  
                return json_encode($arrayAgenda);   
               }
            }
            else
            {
               return getJsonResponse(false, 'Erro ao consultar Agenda- ' . $stmt->errorInfo());
            }
        
    }
    
    }
    

?>