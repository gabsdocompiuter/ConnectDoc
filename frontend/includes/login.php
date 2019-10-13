<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ConnectDoc login</title>

        <link rel="stylesheet" href="<?= getIncludesDir('css/style.css') ?>" >
        <link rel="stylesheet" href="<?= getIncludesDir('css/login.css') ?>" >
    </head>
    <body>
        <div class="container">
            <div id="logo">
                <img src="<?= getIncludesDir('assets/logo_white.png') ?>" alt="Logo ConnectDoc"/>
            </div>

            <div id="separator">
                <div id="separatorLine"></div>
            </div>

            <div id="loginArea" class="loginArea">
                <div id="loginButtons">
                    <button
                        class="button primary"
                        onclick="doLogin()"
                    >Entrar</button>
                </div>
            </div>
        </div>

        <script src="<?= getIncludesDir('js/login.js') ?>"></script>
    </body>
</html>