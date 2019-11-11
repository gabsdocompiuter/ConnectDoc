<?php namespace App\Models;
use App\DB; 
include_once BASE_PATH . "/config.php";

    class Agenda {

        public static function save(
            $id_medico,
            $id_paciente,
            $horario,
            $agendador
            ){
            
             // validação (bem simples, só pra evitar dados vazios)
            if (empty($id_medico)
            ||  empty($id_paciente)
            ||  empty($horario)
            ||  empty($agendador)){
            
                return getJsonResponse(false, 'Campos nao informados');
            }

       
                
            
              
            // insere no banco
            $DB = new DB;
            //insere na tabela usuario    
            $sql = "INSERT INTO agenda(id_medico, id_paciente, horario, agendador) VALUES(:id_medico, :id_paciente, :horario, :agendador)";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id_medico', $id_medico);
            $stmt->bindParam(':id_paciente', $id_paciente);
            $stmt->bindParam(':horario', $horario);
            $stmt->bindParam(':agendador', $agendador);
            
            if ($stmt->execute())
            {
                return getJsonResponse(true, 'Agendado com sucesso');
            }
            else return getJsonResponse(false, 'Erro ao agendar - ' . $stmt->errorInfo());
        }

        public static function selectEdit($id){
            

                $sql = "SELECT * FROM agenda where id = :id"; 
                $DB = new DB; 
                $stmt = $DB->prepare($sql);
                $stmt->bindParam(':id', $id);
        
                if ($stmt->execute())
                {
                    $agendas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    if(count($agendas) <= 0){
                        return getJsonResponse(false, $msgErro);
                    }
                    else{
                    $agenda = $agendas[0];
                 
                        $editAgenda = array(
                            'id_medico' => $agenda['id_medico'],
                            'id_paciente'=> $agenda['id_paciente'],
                            'horario' => $agenda['horario'],
                            'agendador' => $agenda['agendador'],
            
                        );
                 
            
                    return json_encode($editAgenda);   
                   }
                }
                else
                {
                   return getJsonResponse(false, 'Erro ao editar Agenda- ' . $stmt->errorInfo());
                }
            
        }

        public static function update($id, $id_medico, $id_paciente, $horario, $agendador)
        {
            // validação (bem simples, só pra evitar dados vazios)
            if (empty($id_medico)
            ||  empty($id_paciente)
            ||  empty($horario)
            ||  empty($agendador)
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
                $agendador = $agendadores[$i];
                $arrayAgenda[$i] = array(
                    'id' => $agenda['id'],
                    'medico' => $medico['nome'],
                    'paciente'=> $paciente['nome'],
                    'horario' => $agenda['horario'],
                    'agendador' => $agendador['nome'],
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