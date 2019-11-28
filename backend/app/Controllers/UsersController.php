<?php namespace App\Controllers;
use \App\Models\User; 
include_once BASE_PATH . "/config.php";
 
/* Listagem de usuários */ 
class UsersController {
    public function index() { 
        \App\View::make('\Usuarios\users.index');
    }

    public function cadastrar() {
        \App\View::make('\Usuarios\users.cadastro');
    }

    //processa o cadastro e insere no BD
    public function store(){
        // pega os dados do formuário
        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;

        //recebe tipo de usuario e insere no BD 1 - Medico e 2- Secretaria
        if(isset($_POST['tipo'])){
            $tipo = $_POST['tipo'];
            if($tipo == 'medico'){
                $tipo = 1;
            }
            else if($tipo == 'secretaria'){
                $tipo = 2;
            }else if($tipo == 'paciente'){
                $tipo = 3;
            }
        }else{
            $tipo = null;
        }
        
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
        $crm = isset($_POST['crm']) ? $_POST['crm'] : null;
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        //$senha = password_hash(isset($_POST['senha']) ? $_POST['senha'] : null, PASSWORD_DEFAULT);
        $senha = crypt(isset($_POST['senha']) ? $_POST['senha'] : null, 12);
 
        echo User::save($nome, $usuario, $email, $tipo, $telefone, $crm, $cpf, $categoria, $senha);
    }
 

    public function loginHome() { 
        \App\View::make('\Usuarios\users.login');
    }

    public function logar() { 
        // pega os dados do formuário
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

        echo User::logar($usuario, $senha);
    }

    public function sair() { 
        if(User::sair()){
            header('Location: ./');
            exit;
        }
    }

    public function edit($id)
    {
       echo User::selectEdit($id);
 
        //\App\View::make('\Usuarios\users.edit');
    }

    public function remove($id)
    {
       echo User::remove($id);
 
        //\App\View::make('\Usuarios\users.edit');
    }

        /**
     * Processa o formulário de edição de usuário
     */
    public function update()
    {
        // pega os dados do formuário
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
        //recebe tipo de usuario e insere no BD 1 - Medico e 2- Secretaria
        /*if(isset($_POST['tipo'])){
            $tipo = $_POST['tipo'];
            if($tipo == 'medico'){
                $tipo = 1;
            }
            else if($tipo == 'secretaria'){
                $tipo = 2;
            }else if($tipo == 'paciente'){
                $tipo = 3;
            }
        }else{
            $tipo = null;
        }*/
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
        $crm = isset($_POST['crm']) ? $_POST['crm'] : null;
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        $senha = password_hash(isset($_POST['senha']) ? $_POST['senha'] : null, PASSWORD_DEFAULT);
        //$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
        echo User::update($id, $nome, $email, $usuario, $tipo, $telefone, $crm, $cpf, $categoria, $senha);
        
    }

    public function getUserByName($user){
        echo User::getUserByName($user);
    }

    public function listarMedicos(){
        echo User::listarMedicos();
    }

    public function listarPacientes(){
        echo User::listarPacientes();
    }
}
