<!DOCTYPE html>
<html lang="en">
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    
        <!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"  id="bootstrap-css"> -->
        <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="frontend/css/style.css">
        <link rel="stylesheet" type="text/css" href="frontend/css/consultas.css" />
        <title>ConnectDoc</title>
    </head>

    <body>
        <?php include 'menu.php' ?>
        
        <div class="container">
            <div class="calendario">
                <ul id="meses_lista" class="meses"></ul>

                <ul id="dias_lista" class="dias"></ul>
            </div>

            <?php
                $json_file = json_decode(file_get_contents("http://localhost/backend/users/medicos"));
                for($i = 0; $i < count($json_file); $i++) {
            ?>
                    <div class="medico">
                        <div class="medico info">
                            <h1><?= $json_file[$i]->{'nome'}?></h1>
                            <h3><?= $json_file[$i]->{'descricao'}?></h3>
                        </div>
                        <div class="medico agenda">
                            <div class="linha">
                                <div class="horario titulo">Horário</div>
                                <div class="paciente titulo">Paciente</div>
                            </div>

                            <?php
                                $medId = $json_file[$i]->{'id'};
                                if(isset($_GET['dia'])){
                                $dia = $_GET['dia'];
                                $mes = $_GET['mes'];
                                $agenda = json_decode(file_get_contents("http://localhost/backend/agenda/consultas/$medId/dia/$dia/mes/$mes"));
                                }else{
                                    $agenda = json_decode(file_get_contents("http://localhost/backend/agenda/consultas/$medId"));
                                }
                                for($x = 0; $x < count($agenda); $x++) {
                                    $horario = $agenda[$x]->{'horario'};
                                    $horario = date("H:i",strtotime($horario));

                                    $paciente = $agenda[$x]->{'nomePaciente'};
                                    
                                    if(!ISSET($agenda[$x]->{'nomePaciente'})){
                                        $horario = "<a href='#'>" . $horario . "</a>";
                                        $paciente = "<a href='#'> — </a>";
                                    }
                            ?>
                                    <div class="linha">
                                        <div class="horario"><?= $horario ?></div>
                                        <div class="paciente"><?= $paciente ?></div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
        <script src="frontend/js/calendario.js"></script>
    </body>
</html>