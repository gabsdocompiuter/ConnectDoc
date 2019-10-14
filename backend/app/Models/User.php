<?php namespace App\Models;

use App\DB; 
include BASE_PATH . "/config.php";
class User {

    //salva no BD o cadastro
    public static function save(
        $nome,
        $usuario,
        $email,
        $tipo,
        $telefone,
        $crm,
        $categoria,
        $senha){
        
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome)
        ||  empty($usuario)
        ||  empty($email)
        ||  empty($tipo)
        ||  empty($telefone)
        ||  empty($senha)){
            echo "Volte e preencha todos os campos";
            return false;
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
            $idUser = $DB->lastInsertId();
            $DB = new DB;
            $sql = "INSERT INTO medicos(id_usuario, categoria, crm) VALUES(:id_usuario,:categoria, :crm)";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUser);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':crm', $crm);
            $stmt->execute();
            $sim = true;
            } 
             //verifica se é do tipo secretaria, caso seja, insere os dados
            else{ 
            $idUser = $DB->lastInsertId();
            $DB = new DB;
            $sql = "INSERT INTO secretaria(id_usuario) VALUES(:id_usuario)";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUser);
            $stmt->execute();
            $controlador = true;
            }
 
        if ($controlador)
        {
            return true;
        }
        else
        {
            echo "Erro ao cadastrar";
            print_r($stmt->errorInfo());
            return false;
        }
    }

    public static function logar($usuario,$senha){
        if (empty($usuario) ||  empty($senha))
        {
            return getJsonResponse(false, 'Campos não informados');
        }

        $DB = new DB;
        $sql = "SELECT id, usuario, senha FROM usuario WHERE usuario=:usuario";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);

        
        if ($stmt->execute())
        {
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            

                foreach ($users as $user){
                    if($user['usuario'] == null){
                        $_SESSION['logado'] = false;
                    }else if(password_verify($senha, $user['senha'])){
                        $_SESSION['usuario'] = $user['usuario'];
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['logado'] = true;
                    }
                    
                }
            
                return $users;
            
            
        }
        else
        {
            echo "Erro ao Logar";
            print_r($stmt->errorInfo());
            return false;
        }

    }

    public static function sair(){
        session_destroy();

        return true;
    }

    public static function selectAll($id) { 

            $sql = "SELECT id, nome, usuario, email, tipo, telefone, senha FROM usuario where id = :id"; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id', $id);
 
            if ($stmt->execute())
            {
                $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
                    foreach ($users as $user){
                        $_SESSION['nome'] = $user['nome'];
                        $_SESSION['usuario'] = $user['usuario'];
                        $_SESSION['email'] = $user['email'];
                        if($user['tipo'] == 1){
                            $_SESSION['tipo'] = 'medico';
                        }else{
                            $_SESSION['tipo'] = 'secretaria';
                        }
               
                        $_SESSION['telefone'] = $user['telefone'];
                        $_SESSION['senha'] = $user['senha'];
                    }
                
                    return $users;
                
                
            }
            else
            {
                echo "Erro ao Editar";
                print_r($stmt->errorInfo());
                return false;
            }
    }


        /**
     * Altera no banco de dados um usuário
     */
    public static function update($id, $nome, $email, $usuario, $tipo, $telefone, $senha)
    {
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome) || empty($usuario) ||  empty($email) || empty($tipo) || empty($telefone) ||  empty($senha))
        {
            echo "Volte e preencha todos os campos";
            return false;
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
 
        if ($stmt->execute())
        {
            $_SESSION['usuario'] = $usuario;
            return true;
        }
        else
        {
            echo "Erro ao cadastrar";
            print_r($stmt->errorInfo());
            return false;
        }
    }
 
}