<!DOCTYPE html>
<html lang="en">
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
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

            <div id="medicos"></div>
            
        </div>
        <script src="frontend/js/calendario.js"></script>
    </body>
</html>