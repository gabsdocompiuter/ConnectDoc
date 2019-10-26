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
            

            $sql = "SELECT * FROM agenda"; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
        
    
            if ($stmt->execute())
            {
                $agendas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if(count($agendas) <= 0){
                    return getJsonResponse(false, $msgErro);
                }
                else{
                return json_encode($agendas);   
               }
            }
            else
            {
               return getJsonResponse(false, 'Erro ao consultar Agenda- ' . $stmt->errorInfo());
            }
        
    }
    
    }
    

?>