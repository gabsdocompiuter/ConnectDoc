<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        
      
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="css/agendaNovo.css" />
      
       

          <!-- Minified Bootstrap CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <!-- Minified JS library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- Minified Bootstrap JS -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <link href="css/data/bootstrap-datetimepicker.min.css" rel="stylesheet">
            <script src="js/data/bootstrap-datetimepicker.min.js"></script>
    
        <title></title>
    

    </head>
 
    <body>
    <div class="backGround">
        <div class="header">
        <div class='menuLine'>
            <div class="menuLogo">
                <img src="assets/logo_white.png" alt="Logo ConnectDoc"/>
            </div>
            <div class="menuBottons">
                <h1> Agenda</h1>
            </div>
        </div>
        <div class="horizontalSeparatorCadastrar"></div>
    </div>
           
     
            
           

    <div class="containerDiv">
    
                <div class="formulario" >
                <form  action="http://localhost/ConnectDoc/backend/agenda/cadastrar" method="post"  id="agendaArea">

                    <label class="label" for="tipo">Médico</label>
                    <br>
                    <select class="btn btn-primary dropdown-toggle" id="id_medico" name="id_medico" >
                    <?php 
                    $json_file = json_decode(file_get_contents(
                        "http://localhost/ConnectDoc/backend/users/medicos"));

                        for($i = 0; $i < count($json_file); $i++) {
                            echo "<option value='".$json_file[$i]->{'id'}."' >".$json_file[$i]->{'nome'}."</option>";
                            
                        }
                    ?>
                    </select>
                    <br>
                    <br>
                    <label class="label mt-4" for="nome">Paciente</label>
                    <br>
                    <select class="btn btn-primary dropdown-toggle" id="id_paciente" name="id_paciente" >
                    <?php 
                    $json_file = json_decode(file_get_contents(
                        "http://localhost/ConnectDoc/backend/users/pacientes"));

                        for($i = 0; $i < count($json_file); $i++) {
                            echo "<option value='".$json_file[$i]->{'id'}."'>".$json_file[$i]->{'nome'}."</option>";
                            
                        }
                    ?>
                    </select>
                    <br>
                    <br>
                    
                    <label class="label" for="usuario">Horário</label>
                    <input size="16"  class="form-control" id="horario" name="horario" >
 
                    <script type="text/javascript">
                    $("#horario").datetimepicker({
                        format: 'yyyy-mm-dd hh:ii:ss',
                        autoclose: true
                    });
                    </script>
                    
                    
                    <button type="submit" class="btn btn-white">Enviar</button>
                    </form>
                </div>


            
                
                
                
                
            </div>

     </div>   
    </body>
</html>












