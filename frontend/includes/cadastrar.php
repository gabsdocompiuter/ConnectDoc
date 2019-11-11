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
                  <h1 class="titulo">Cadastrar</h1>
            </div>
            <div class="horizontalSeparatorCadastrar"></div>
     
               
            
    
                <div class="formulario mt-4">
                <form  id="cadastrarArea">

                    <label class="label" for="tipo">Tipo de Usuário</label>
                    <br>
                    <select  onchange="mostrar('ocultaCampos')" class="btn btn-primary dropdown-toggle" id="tipo" name="tipo" >
                    <option value="medico">Médico</option>
                    <option value="secretaria">Secretária</option>
                    </select>
                    <br>
                    <label class="label" for="nome">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome">
                
                    <label class="label" for="usuario">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Seu Usuário">
                    
                    <label class="label" for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu email">

                    <div id="ocultaCampos">
                    <label class="label" for="tipo" >CRM</label>
                    <input type="text" class="form-control" id="crm" name="crm" placeholder="CRM">
                
                    <label class="label" for="tipo">Categoria</label>
                    <br>
                    <select class="btn btn-primary dropdown-toggle" id="categoria" >
                    <option value="1">Pediatra</option>
                    </select>
                    <br>
                    </div>


                    <label class="label" for="telefone">Telefone</label>
                    <input type="number" class="form-control" id="telefone" name="telefone" placeholder="Telefone">

                    <label class="label" for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                    
                    <button type="submit" class="btn btn-white mt-4">Enviar</button>
                    </form>
                </div>


            
                
                
                
                
            </div>
            <script src="../js/cadastrar.js"></script>
    </body>
</html>












