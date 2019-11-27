<!DOCTYPE html>
<html lang="en">
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
        <!-- <link rel="stylesheet" type="text/css" href="frontend/css/modal.css"> -->
        <link rel="stylesheet" type="text/css" href="frontend/css/cadastrar.css">

        <title>ConnectDoc</title>
    </head>

    <body>
        <?php include 'menu.php' ?>
        
        <div class="container" id="container">
            <div class="titulo">
                <h1>Cadastro</h1>
            </div>

            <div class='content'>
                <!-- <div>
                    <label>Tipo de Cadastro</label>
                    <div class="tipoCadastro">
                        <input type="radio" name="tipoCadastro" value="1" id='cadastroUser' checked>
                        <label for='cadastroUser'>Usuário</label>

                        <input type="radio" name="tipoCadastro" value="2" id='cadastroMedico'>
                        <label for='cadastroMedico'>Médico</label>
                    </div>
                </div> -->

                <div class='form'>
                    <div class='userInfo'>
                        <h2>Dados Usuário</h2>

                        <div class='info'>
                            <div class='label'>Nome</div>
                            <input placeholder='Informe o nome' name='nome'>
                        </div>

                        <div class='info'>
                            <div class='label'>Telefone</div>
                            <input placeholder='Informe o telefone' name='telefone'>
                        </div>

                        <div class='info'>
                            <div class='label'>Email</div>
                            <input placeholder='Informe o email' name='email'>
                        </div>

                        <div class='info'>
                            <div class='label'>Usuário</div>
                            <input placeholder='Informe um usuário' name='usuario'>
                        </div>

                        <div class='info'>
                            <div class='label'>Senha</div>
                            <input placeholder='Informe uma senha' name='senha' type="password">
                        </div>
                    </div>

                    <div class='medInfo'>
                        <h2>Dados Médico</h2>

                        <div class='info'>
                            <div class='label'>Nome</div>
                            <input placeholder='Informe o nome' name='nome'>
                        </div>

                        <div class='info'>
                            <div class='label'>CRM</div>
                            <input placeholder='Informe o CRM' name='crm'>
                        </div>
                    </div>
                </div>

                <div class='buttons'>
                    <p id='mensagem'></p>
                    <button id='cadastrarButton' class='button secondary'>Cadatrar</button>
                </div>
            </div>
            
        </div>
        
        <script src="frontend/js/padrao.js"></script>
        
        <script src="frontend/js/core/axios.min.js"></script>
        <script src="frontend/js/formAjax.js"></script>

        <script src="frontend/js/cadastrar.js"></script>

        <script>
            ajustaMenu('cadastrar');
        </script>
    </body>
</html>