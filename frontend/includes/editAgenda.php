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
                <h1 style="margin-right:500px"> Editar Agenda</h1>
            </div>
        </div>
        <div class="horizontalSeparatorCadastrar"></div>
    </div>
           
     
            
           

    <div class="containerDiv">
    
    <div class="formulario mt-4">
                <form  action="http://localhost/ConnectDoc/backend/agenda/edit" method="post"  id="editAgendaArea">
                    <?php 
                    $json_file = json_decode(file_get_contents(
                        "http://localhost/ConnectDoc/backend/agenda/edit/22"));
                       /* $data = $json_file->{'horario'};
                         $dataFormatada = date("d-m-Y H:i:s",strtotime($data));
                         $json_file->{'horario'} = $dataFormatada;
                        */
                       
                    ?>

                    <label class="label" for="tipo">Médico</label>
                    <br>
                    <select class="btn btn-primary dropdown-toggle" id="id_medico" name="id_medico" >
                    <?php 
                    $medicos = json_decode(file_get_contents(
                        "http://localhost/ConnectDoc/backend/users/medicos"));

                        for($i = 0; $i < count($medicos); $i++) {
                            echo "<option value='".$medicos[$i]->{'id'}."' >".$medicos[$i]->{'nome'}."</option>";
                            
                        }
                    ?>
                    </select>
                    <br>
                    <br>
                    <label class="label" for="nome">Paciente</label>
                    <br>
                    <select class="btn btn-primary dropdown-toggle" id="id_paciente" name="id_paciente" >
                    <?php 
                    $pacientes = json_decode(file_get_contents(
                        "http://localhost/ConnectDoc/backend/users/pacientes"));

                        for($i = 0; $i < count($pacientes); $i++) {
                            echo "<option value='".$pacientes[$i]->{'id'}."'>".$pacientes[$i]->{'nome'}."</option>";
                            
                        }
                    ?>
                    </select>
                    <br>
                    <br>
                    <label class="label" for="horario">Horário</label>
                    
                    
                    <input size="16" type="text" class="form-control" id="horario" name="horario" value="<?php echo $json_file->{'horario'}?>" >
 
                    <script type="text/javascript">
                    $("#horario").datetimepicker({
                        format: 'yyyy-mm-dd hh:ii:ss',
                        autoclose: true
                    });
                    </script>

                    <input type="hidden" id="id" name="id" value="<?php echo $json_file->{'id'}?>">
                    <br>
                    
                    <button type="submit" class="btn btn-white mt-4">Enviar</button>
                    </form>
                </div>


            
                
                
                
                
            </div>

     </div>   
    </body>
</html>












