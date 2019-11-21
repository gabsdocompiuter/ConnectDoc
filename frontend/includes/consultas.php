<!DOCTYPE html>
<html lang="en">
<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
       
        
        <link rel="stylesheet" type="text/css" href="css/consultas.css" />
        <title></title>
      
    </head>
    
    
    <body >
   

    <div class="container2">
        <div class="container">
        <?php
        $json_file = json_decode(file_get_contents(
            "http://localhost/ConnectDoc/backend/users/medicos"));

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
                            <th >Paciente</th>
                        </tr>
                        
                        </thead>
                        <tbody>
                        <?php
                                $agenda = json_decode(file_get_contents(
                                    "http://localhost/ConnectDoc/backend/agenda/consultas/".$json_file[$i]->{'id'}));

                                    if($agenda > 0){
                                    for($x = 0; $x < count($agenda); $x++) {
                                        $data = $agenda[$x]->{'horario'};
                                        $dataFormatada = date("d-m-Y H:i:",strtotime($data));
                                        $agenda[$x]->{'horario'} = $dataFormatada;
                                        ?>
                                            <tr>
                                                <td><?php echo $agenda[$x]->{'horario'}; ?></td>
                                                <td><?php echo $agenda[$x]->{'nomePaciente'}; ?></td>
                                            </tr>
                                     
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