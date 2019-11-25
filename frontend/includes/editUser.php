<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/cadastrar.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        
        <title></title>
       
        <script>
        function mostrar(elemento){
            var display = document.getElementById(elemento).style.display;
                if(display == "none"){
                    
                    document.getElementById(elemento).style.display = 'block';
                }else{
                    document.getElementById(elemento).style.display = 'none';
                }    
            }
        </script>

    </head>
 
    <body>
        <div class="backGround">
             <div class="navbar">
                  <h1 class="titulo">Editar Cadastro</h1>
            </div>
            <div class="horizontalSeparatorCadastrar"></div>
     
               
            
    
                <div class="formulario mt-4">
                <form  action="http://localhost/ConnectDoc/backend/edit" method="post" id="editCadastrarArea">
                    <?php 
                    $json_file = json_decode(file_get_contents(
                        "http://localhost/ConnectDoc/backend/edit/46"));

                       
                    ?>
                    
                    <br>
                    <label class="label" for="nome">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $json_file->{'nome'}?>">
                    <br>
                    <label class="label" for="usuario">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $json_file->{'usuario'}?>">
                    <br>
                    <label class="label" for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $json_file->{'email'}?>">
                    <br>
                    <?php if ($json_file->{'tipo'} == 1) { ?>
                    <div id="ocultaCampos">
                    <br>
                    <label class="label" for="crm" >CRM</label>
                    <input type="text" class="form-control" id="crm" name="crm" value="<?php echo $json_file->{'crm'}?>">
                    <br>
                    <label class="label" for="categoria">Categoria</label>
                    <br>
                    <select class="btn btn-primary dropdown-toggle" id="categoria" name="categoria">
                    
                    <option value="<?php echo $json_file->{'categoria'}?>"><?php echo $json_file->{'descricao'}?></option>
                    </select>
                    <?php } ?>
                    
                    </div>

                    <label class="label" for="telefone">Telefone</label>
                    <input type="number" class="form-control" id="telefone" name="telefone" value="<?php echo $json_file->{'telefone'}?>">
                    <br>
                    <label class="label" for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                    <br>
                    <input type="hidden" id="tipo" name="tipo" value="<?php echo $json_file->{'tipo'}?>">
                    <input type="hidden" id="id" name="id" value="<?php echo $json_file->{'id'}?>">
                    <br>
                    <button type="submit" class="btn btn-white mt-4">Enviar</button>
                    </form>
                </div>


            
                
                
                
                
            </div>
            <script src="../js/cadastrar.js"></script>
    </body>
</html>












