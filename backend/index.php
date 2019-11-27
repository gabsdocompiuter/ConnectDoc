<?php // inclui o autoloader do Composer 
require 'vendor/autoload.php'; 
// inclui o arquivo de inicialização 
require 'init.php'; 
// instancia o Slim, habilitando os erros (útil para debug, em desenvolvimento) 
$app = new \Slim\App([ 'settings' => [
        'displayErrorDetails' => true
    ]
]);
  
// página inicial
// listagem de usuários
$app->get('/', function ()
{
    
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->index();
    
});

$app->get('/cadastrar', function ()
{
    
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->cadastrar();
    
});

$app->post('/cadastrar', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->store();
});



$app->get('/login', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->loginHome();
    
});

$app->post('/login', function ()
{
    
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->logar();
    
});

$app->get('/sair', function (){
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->sair();
});

 
// edição de usuário
// exibe o formulário de edição
$app->get('/edit/{id}', function ($request)
{
    // pega o ID da URL
    $id = $request->getAttribute('id');
 
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->edit($id);
});
 
// processa o formulário de edição
$app->post('/edit', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->update();
});
 
// remove um usuário
$app->get('/remove/{id}', function ($request)
{
    // pega o ID da URL
    $id = $request->getAttribute('id');
 
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->remove($id);
});
//exibe todas agendas para a secretaria
$app->get('/agenda', function ()
{
    
    $AgendaController = new \App\Controllers\AgendaController;
    $AgendaController->agenda();
    
});
//cadastrar uma nova agenda
$app->post('/agenda/cadastrar', function ()
{
    
    $AgendaController = new \App\Controllers\AgendaController;
    $AgendaController->store();
    
});

// edição de usuário
// exibe o formulário de edição de agenda
$app->get('/agenda/edit/{id}', function ($request)
{
    // pega o ID da URL
    $id = $request->getAttribute('id');
 
    $AgendaController = new \App\Controllers\AgendaController;
    $AgendaController->edit($id);
});
 
// processa o formulário de edição de agenda
$app->post('/agenda/edit', function ()
{
    $AgendaController = new \App\Controllers\AgendaController;
    $AgendaController->update();
});

//tras as consultas agendadas de cada medico
$app->get('/agenda/consultas/{id}', function ($request){
    // pega o ID da URL
    $id = $request->getAttribute('id');
    
    $AgendaController = new \App\Controllers\AgendaController;
    $dia= null;
    $mes=null;
    $AgendaController->consultas($id, $dia, $mes);
});

$app->get('/agenda/consultas/{data}/{medico}', function ($request){
    // pega o ID da URL
    $medico = $request->getAttribute('medico');
    $data =  $request->getAttribute('data');
    $AgendaController = new \App\Controllers\AgendaController;
    $AgendaController->consultas($data, $medico);
});


$app->get('/users/medicos', function ($request)
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->listarMedicos();
});

$app->get('/users/pacientes', function ($request)
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->listarPacientes();
});

$app->get('/dias/{mes}', function ($request)
{
    $mes = $request->getAttribute('mes');

    $CalendarioController = new \App\Controllers\CalendarioController;
    $CalendarioController->listarDias($mes);
});
 
$app->run();