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
            <!-- <div class="calendario">
                <ul class="meses">
                    <li><a href="#">Jan</a></li>
                    <li><a href="#">Fev</a></li>
                    <li><a href="#">Mar</a></li>
                    <li><a href="#">Abr</a></li>
                    <li><a href="#">Mai</a></li>
                    <li><a href="#">Jun</a></li>
                    <li><a href="#">Jul</a></li>
                    <li><a href="#">Ago</a></li>
                    <li><a href="#">Set</a></li>
                    <li><a href="#">Out</a></li>
                    <li><a href="#">Nov</a></li>
                    <li><a href="#">Dez</a></li>
                </ul>
                <ul>
                    <?php
                    // $json_file = json_decode(file_get_contents("http://localhost/backend/users/medicos"));
                    ?>
                <li><a href="#"><?= date("F") ?></a></li>
                <li><a href="#">Jul</a></li>
                <li><a href="#">Ago</a></li>
                <li><a href="#">Set</a></li>
                </ul>
            </div> -->

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
                                $agenda = json_decode(file_get_contents("http://localhost/backend/agenda/consultas/$medId"));

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
    </body>
</html>