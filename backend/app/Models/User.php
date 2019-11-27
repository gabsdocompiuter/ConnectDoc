<?php namespace App\Models;

use App\DB; 
include_once BASE_PATH . "/config.php";
class User {

    //salva no BD o cadastro
    public static function save(
        $nome,
        $usuario,
        $email,
        $tipo,
        $telefone,
        $crm,
        $cpf,
        $categoria,
        $senha){
        
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome)
        ||  empty($usuario)
        ||  empty($email)
        ||  empty($tipo)
        ||  empty($telefone)
        ||  empty($senha)){
            return getJsonResponse(false, 'Campos nao informados');
        }
        
          
        // insere no banco
        $DB = new DB;
        //insere na tabela usuario    
        $sql = "INSERT INTO usuario(nome, usuario, email, tipo, telefone, senha) VALUES(:nome, :usuario, :email, :tipo, :telefone, :senha)";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        //verifica se é do tipo médico, caso seja, insere os dados
        if($tipo == 1){
            if(empty($crm) ||  empty($categoria)){
                return getJsonResponse(false, 'Campos nao informados');
            }
            $idUser = $DB->lastInsertId();
            $DB = new DB;
            $sql = "INSERT INTO medicos(id_usuario, categoria, crm) VALUES(:id_usuario,:categoria, :crm)";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUser);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':crm', $crm);
            $stmt->execute();
            $controlador = true;
            } 
             //verifica se é do tipo secretaria, caso seja, insere os dados
            else if($tipo == 2){ 
            $idUser = $DB->lastInsertId();
            $DB = new DB;
            $sql = "INSERT INTO secretaria(id_usuario) VALUES(:id_usuario)";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUser);
            $stmt->execute();
            $controlador = true;
            }
            //verifica se é do tipo paciente, caso seja, insere os dados
            else if($tipo == 3){ 
                
                if(empty($cpf)){
                    return getJsonResponse(false, 'Campos nao informados');
                }
                $idUser = $DB->lastInsertId();
                $DB = new DB;
                $sql = "INSERT INTO paciente(id_usuario, cpf) VALUES(:id_usuario, :cpf)";
                $stmt = $DB->prepare($sql);
                $stmt->bindParam(':id_usuario', $idUser);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->execute();
                $controlador = true;
                }

       
        if ($controlador)
        {
            return getJsonResponse(true, 'Cadastrado com sucesso');
        }
        else return getJsonResponse(false, 'Erro ao cadastrar - ' . $stmt->errorInfo());
    }

    public static function logar($usuario, $senha){
        $msgErro = 'Usuario ou senha invalidos';

        if (empty($usuario) || empty($senha))
        {   
            return getJsonResponse(false, 'Campos nao informados');
        }

        $DB = new DB;
        $sql = "SELECT id, usuario, senha FROM usuario WHERE usuario=:usuario";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        
        if ($stmt->execute())
        {
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($users) <= 0){
                return getJsonResponse(false, $msgErro);
            }
            else{
                $user = $users[0];

                if($user['usuario'] == null)
                    return getJsonResponse(false, $msgErro);
                else if(crypt($senha, $user['senha'])==$user['senha']){
                    $responseUser = array(
                        'success' => true,
                        'usuario' => $user['usuario'],
                        'id' => $user['id']
                    );

                    session_abort();
                    session_start();
                    $_SESSION['user'] = $user['id'];
                    
                    return json_encode($responseUser);
                }
                else return getJsonResponse(false, $msgErro);
            }
        }
        else return getJsonResponse(false, 'Erro ao logar - ' . $stmt->errorInfo());

    }

    public static function sair(){
        session_destroy();

        return true;
    }

    public static function remove($id){
        $sql = "DELETE FROM usuario where id = :id"; 
        $DB = new DB; 
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute())
        {
    
            return json_encode("ok");
            
            
        }
        else
        {
           return getJsonResponse(false, 'Erro ao deletar usuário - ' . $stmt->errorInfo());
        }
        
    }
    //consulta para editar registro
    public static function selectEdit($id) { 

        $sql = "SELECT id, nome, usuario, email, tipo, telefone, senha FROM usuario where id = :id"; 
        $DB = new DB; 
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute())
        {
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($users) <= 0){
                return getJsonResponse(false, $msgErro);
            }
            else{
            $user = $users[0];
           if($user['tipo'] == 1){
                $sql = "SELECT med.id, med.id_usuario, med.categoria, cat.descricao, med.crm FROM medicos med 
                join categoria cat where id_usuario = :id AND med.categoria = cat.id"; 
                $DB = new DB; 
                $stmt = $DB->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $medicos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $medico = $medicos[0];
                $categoria = $medico['categoria'];
                $descricao = $medico['descricao'];
                $crm = $medico['crm'];
                $editUser = array(
                    'id' => $user['id'],
                    'tipo' => $user['tipo'],
                    'tipoNome' => 'Médico',
                    'nome' => $user['nome'],
                    'usuario'=> $user['usuario'],
                    'email' => $user['email'],
                    'telefone' => $user['telefone'],
                    'crm' => $crm,
                    'descricao' => $descricao,
                    'categoria' => $categoria,
                    'senha' => $user['senha']
    
                );
            }else if($user['tipo'] == 2){
                $editUser = array(
                    'id' => $user['id'],
                    'tipo' => $user['tipo'],
                    'tipoNome' => 'Secretária',
                    'nome' => $user['nome'],
                    'usuario'=> $user['usuario'],
                    'email' => $user['email'],
                    'telefone' => $user['telefone'],
                    'senha' => $user['senha']
    
                );
                
            }else if($user['tipo'] == 3){
                $sql = "SELECT id, id_usuario, cpf FROM paciente where id_usuario = :id"; 
                $DB = new DB; 
                $stmt = $DB->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $pacientes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $paciente = $pacientes[0];
                $cpf = $paciente['cpf'];
                $editUser = array(
                    'id' => $user['id'],
                    'tipo' => $user['tipo'],
                    'tipoNome' => 'Paciente',
                    'nome' => $user['nome'],
                    'usuario'=> $user['usuario'],
                    'email' => $user['email'],
                    'telefone' => $user['telefone'],
                    'cpf' => $cpf,
                    'senha' => $user['senha']
    
                );
                
            }
    
            return json_encode($editUser);
            
            }
        }
        else
        {
           return getJsonResponse(false, 'Erro ao editar - ' . $stmt->errorInfo());
        }
    }


        /**
     * Altera no banco de dados um usuário
     */
    public static function update($id, $nome, $email, $usuario, $tipo, $telefone, $crm, $cpf, $categoria, $senha)
    {
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome)
        ||  empty($usuario)
        ||  empty($email)
        ||  empty($tipo)
        ||  empty($telefone)
        ||  empty($senha)){
            return getJsonResponse(false, 'Campos nao informados');
        }
       
          
        // insere no banco
        $DB = new DB;
        $sql = "UPDATE usuario SET nome = :nome, usuario = :usuario,  email = :email, tipo = :tipo, telefone = :telefone, senha = :senha WHERE id = :id";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();


        //verifica se é do tipo médico, caso seja, insere os dados
        if($tipo == 1){
            if(empty($crm) ||  empty($categoria)){
                return getJsonResponse(false, 'Campos nao informados');
            }
           
            $DB = new DB;
            $sql = "UPDATE medicos SET categoria = :categoria, crm = :crm  WHERE id_usuario = :id";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':crm', $crm);
            $stmt->execute();
            $controlador = true;
            } 
            
             else if($tipo == 2){ 
                $controlador = true;
                }
            //verifica se é do tipo paciente, caso seja, insere os dados
            else if($tipo == 3){ 
                
                if(empty($cpf)){
                    return getJsonResponse(false, 'Campos nao informados');
                }
             
                $DB = new DB;
                $sql = "UPDATE paciente SET cpf = :cpf WHERE id_usuario = :id";
                $stmt = $DB->prepare($sql);
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->execute();
                $controlador = true;
                }
 
        if ($controlador)
        {
            return $usuario;
        }
        else
        {
           return getJsonResponse(false, 'Erro ao editar - ' . $stmt->errorInfo());
        }
    }

    public static function getUserByName($user){
        $sql = "SELECT U.usuario AS usuario
                     , U.nome    AS nome
                     , U.email   AS email

                   FROM usuario AS U
                   WHERE U.usuario = :user";

        $DB = new DB;
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':user', $user);

        if ($stmt->execute()){
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($row) > 0){
                $row = $row[0];
                
                $array = array(
                    'usuario' => $row['usuario'],
                    'nome' => $row['nome'],
                    'email' => $row['email']
                );
                return json_encode($array);
            }
            else return getJsonResponse(false, 'Usuário não encontrado');
        }
    }

    public static function listarMedicos(){
        $sql = "SELECT med.id AS medId
                     , us.nome AS nome
                     , cat.descricao AS descricao

                   FROM medicos AS med

                   INNER JOIN categoria AS cat
                      ON med.categoria = cat.id

                   INNER JOIN usuario us
                      ON us.id = med.id_usuario";

            $DB = new DB; 
            $stmt = $DB->prepare($sql);

            if ($stmt->execute())
            {
                $medicos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if(count($medicos) <= 0){
                    return getJsonResponse(false, 'Houve um erro');
                }
            else{
                for ($i = 0; $i < count($medicos); $i++) {
                    $medico = $medicos[$i];
                    $arrayAgenda[$i] = array(
                        'id' => $medico['medId'],
                        'nome' => $medico['nome'],
                        'descricao' => $medico['descricao'],
                    );
                }
                return json_encode($arrayAgenda);   
            }
        }
        else return getJsonResponse(false, 'Erro ao listar médicos');
            
    }

    public static function listarPacientes(){
        $sql = "SELECT distinct pac.id, us.nome FROM paciente pac JOIN usuario us WHERE us.id = pac.id_usuario"; 
       $DB = new DB; 
       $stmt = $DB->prepare($sql);

       if ($stmt->execute())
       {
       $pacientes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

       if(count($pacientes) <= 0){
           return getJsonResponse(false, $msgErro);
       }

       else{
       for ($i = 0; $i < count($pacientes); $i++) {
           $paciente = $pacientes[$i];
           $arrayAgenda[$i] = array(
               'id' => $paciente['id'],
               'nome' => $paciente['nome'],
           );
       }     
           return json_encode($arrayAgenda);   
          }
       }
       else
       {
          return getJsonResponse(false, 'Erro ao Listar os Pacientes- ' . $stmt->errorInfo());
       }
}
 
}