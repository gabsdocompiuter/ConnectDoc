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
        
        <div class="container" id="container">
            <div class="calendario">
                <ul id="meses_lista" class="meses"></ul>

                <ul id="dias_lista" class="dias"></ul>
            </div>

            
        </div>
        <script src="frontend/js/calendario.js"></script>
    </body>
</html>