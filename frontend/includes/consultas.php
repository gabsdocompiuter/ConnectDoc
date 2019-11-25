<!DOCTYPE html>
<html lang="en">
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"  id="bootstrap-css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <link rel="stylesheet" type="text/css" href="frontend/css/consultas.css" />
        <title></title>
    </head>

    <body >
        <div class="container2">
            <div class="container">
                <?php
                    $json_file = json_decode(file_get_contents("http://localhost/backend/users/medicos"));

                    for($i = 0; $i < count($json_file); $i++) {
                ?>
                    <div class="row mt-5">
                        <div class="col-sm">
                            <div class="medicos">
                    
                            <h2><?php echo $json_file[$i]->{'nome'}?></h2>
                            <h4><?php echo $json_file[$i]->{'descricao'}?></h4>
                        </div>
                    </div>
                    <div class="col-sm ">
                        <div class="agenda">
                            <table style=" color: #636c72;">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>&nbsp;Paciente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $agenda = json_decode(file_get_contents("http://localhost/backend/agenda/consultas/".$json_file[$i]->{'id'}));
                                        
                                        if($agenda > 0){
                                            for($x = 0; $x < count($agenda); $x++) {
                                                $data = $agenda[$x]->{'horario'};
                                                $dataFormatada = date("H:i",strtotime($data));
                                                $agenda[$x]->{'horario'} = $dataFormatada;

                                                $echoLine = "<tr><td>" . $agenda[$x]->{'horario'} . " </td> <td>&nbsp;–&nbsp;". $agenda[$x]->{'nomePaciente'} . "</td></tr>";

                                                if(!ISSET($agenda[$x]->{'nomePaciente'})){
                                                    $echoLine = "<tr><td><a href='#'>" . $agenda[$x]->{'horario'} . "</a></td></tr>";
                                                }

                                                echo $echoLine;
                                    ?>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>