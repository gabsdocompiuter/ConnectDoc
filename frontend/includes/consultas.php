<!DOCTYPE html>
<html lang="en">
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
        <link rel="stylesheet" type="text/css" href="css/agenda.css" />
        
        <link rel="stylesheet" type="text/css" href="css/consultas.css" />
        <title></title>
    

    </head>
    
    <body >
   
    <div class="container2">
        <div class="container">
        <?php
        $json_file = json_decode(file_get_contents(
            "http://localhost/ConnectDoc/backend/agenda"));

            for($i = 0; $i < count($json_file); $i++) {
                
            
         ?>
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="medicos">
                        
                       <h2><?php echo $json_file[$i]->{'medico'}?></h2>
                       <h4></h4>
                    </div>
                </div>
                <div class="col-sm ">
                    <div class="agenda">
                        <p></p>   
                    </div>
                </div>
            </div>
         <?php } ?>
            
        </div>
     </div>
  

    </body>
    
</html>