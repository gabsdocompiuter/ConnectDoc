<?php
    define("BASE_DIR", "frontend");

    require_once BASE_DIR . 'config.php';

    $p = array_key_exists('p', $_GET) ? $_GET['p'] : "home";

    //include 'includes/login.php';

    session_start();
    $usuarioLogado = ISSET($_COOKIE['user']) || ISSET($_SESSION['user']) ? true : false;

    if($usuarioLogado){
        //Se tentar logar, manda pra home
        if($p == "login"){
            header("Location: home");
        }

        //Se tentar abrir uma página não existente, vai pro 404
        if(paginaValida($p)) {
            include('dash.php');
            return;
        }
        else if($p == 'logout'){
            include('logout.php');
            return;
        }
        else{
            header("Location: 404");
        }
    }
    else if($p == "login"){
        include('includes/login.php');
        return;
    }
    else{
        header("Location: login");
    }