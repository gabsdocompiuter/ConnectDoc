<?php namespace App\Controllers;
 use \App\Models\User; 
 include BASE_PATH . "./config.php";
 
 class UsersController { 
    /** * Listagem de usuários */ 

    public function index() { 
        \App\View::make('users.index');
        
    }

    public function cadastrar() { 
        \App\View::make('users.cadastro');
        
    }

    //processa o cadastro e insere no BD
    public function store()
    {
        // pega os dados do formuário
        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $email = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

 
        if (User::save($nome, $cpf, $usuario, $email, $categoria, $senha))
        {
            header('Location: /BkconnectDoctor/');
            exit;
        }
    }
 

    public function loginHome() { 
        \App\View::make('users.login');
        
    }

    public function logar() { 
        // pega os dados do formuário
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

        $users = User::logar($usuario, $senha);
        

       if (!empty($users))
        {
            header('Location: /BkconnectDoctor/');
            exit;
        }
        
        
    }

    public function sair() { 
        
        if(User::sair()){
            header('Location: /BkconnectDoctor/');
            exit;
        }
    }

    public function edit($id)
    {
        $user = User::selectAll($id);
 
        \App\View::make('users.edit');
    }

        /**
     * Processa o formulário de edição de usuário
     */
    public function update()
    {
        // pega os dados do formuário
        $id = $_SESSION['id'];
        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
 
        if (User::update($id, $nome, $cpf, $email, $usuario, $categoria, $senha))
        {
            header('Location: /BkconnectDoctor/');
            exit;
        }
    }




    

}