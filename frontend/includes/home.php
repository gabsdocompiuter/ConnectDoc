<!DOCTYPE html>
<html lang="en">
<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
        
       
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
       
        
        
        <link rel="stylesheet" href="css/home.css">
        <title></title>
      
    </head>
    
    
    <body >
    
    

   
    <?php require_once "dash.php"; ?> 
    
        <div class="containerOne">
            <div class="container">
            <div class="horizontalSeparator" ></div>
            <?php
                $json_file = json_decode(file_get_contents(
                    "http://localhost/ConnectDoc/backend/users/medicos"));

                    for($i = 0; $i < count($json_file); $i++) {
                        
                    
                ?>
                    <div class="abaMedico">  
                        

                             <h2 id="nomeMedico" ><?php echo $json_file[$i]->{'nome'}?></h2>
           
                             <div class="barraDivisoria">  </div>

                             <p id="nomeCategoria"><?php echo $json_file[$i]->{'descricao'}?></p>
                    </div>
                    <div class="abaAgenda">
                        <table id="tabela">
                        <thead>
                        <tr>
                            <th>Data</th>
                           
                            <th>Horário</th>
                    
                            <th>Paciente</th>
                      
                            
                        </tr>
                        
                        </thead>
                        <tbody>
                        <?php
                                $agenda = json_decode(file_get_contents(
                                    "http://localhost/ConnectDoc/backend/agenda/consultas/".$json_file[$i]->{'id'}));

                                    if($agenda > 0){
                                    for($x = 0; $x < count($agenda); $x++) {
                                        $data = $agenda[$x]->{'horario'};
                                        $horario = date("H:i",strtotime($data));
                                        $data = date("d-m-Y",strtotime($data));
                                        $agenda[$x]->{'horario'} = $horario;
                                        ?>
                                            <tr>
                                                <td><?php echo $data; ?></td>
                                                
                                                <td><?php echo $agenda[$x]->{'horario'}; ?></td>
                             
                                                <td><?php echo $agenda[$x]->{'nomePaciente'}; ?></td>
                                            </tr>
                                     
                                <?php } } ?>
                        </tbody>
                     </table>
                    </div>
                    
            <?php } ?>
            </div>
        <div> 
    </body>
    
</html>