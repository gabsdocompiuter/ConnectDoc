<?php namespace App\Models; 
use App\DB; 
include BASE_PATH . "./config.php";
class User { 

    //salva no BD o cadastro
    public static function save($nome, $cpf, $usuario, $email, $categoria, $senha)
    {
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome) || empty($cpf) || empty($usuario) ||  empty($email) ||  empty($categoria) || empty($senha))
        {
            echo "Volte e preencha todos os campos";
            echo $nome;
            return false;
        }
        
          
        // insere no banco
        $DB = new DB;
        $sql = "INSERT INTO users(nome, cpf, usuario, email, senha) VALUES(:nome, :cpf, :usuario, :email, :senha)";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':email', $categoria);
        $stmt->bindParam(':senha', $senha);
 
        if ($stmt->execute())
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
            echo "Volte e preencha todos os campos";
            return false;
        }

        $DB = new DB;
        $sql = "SELECT id, usuario, senha FROM users WHERE usuario=:usuario and senha=:senha";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        
        if ($stmt->execute())
        {
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $_SESSION['logado'] = true;

                foreach ($users as $user){
                    $_SESSION['usuario'] = $user['usuario'];
                    $_SESSION['id'] = $user['id'];
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

            $sql = "SELECT id, nome, cpf, usuario, email, categoria, senha FROM users where id = :id"; 
            $DB = new DB; 
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':id', $id);
 
            if ($stmt->execute())
            {
                $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
                    foreach ($users as $user){
                        $_SESSION['nome'] = $user['nome'];
                        $_SESSION['usuario'] = $user['usuario'];
                        $_SESSION['cpf'] = $user['cpf'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['categoria'] = $user['categoria'];
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
    public static function update($id, $nome, $cpf, $email, $usuario, $categoria, $senha)
    {
        // validação (bem simples, só pra evitar dados vazios)
        if (empty($nome) || empty($cpf) || empty($usuario) ||  empty($email) || empty($categoria) ||  empty($senha))
        {
            echo "Volte e preencha todos os campos";
            return false;
        }
       
          
        // insere no banco
        $DB = new DB;
        $sql = "UPDATE users SET nome = :nome, cpf = :cpf, usuario = :usuario,  email = :email, categoria = :categoria, senha = :senha WHERE id = :id";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':categoria', $categoria);
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