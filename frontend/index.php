<?php

    function paginaValida($page){
        return file_exists("includes/$page.php");
    }

    $p = array_key_exists('p', $_GET) ? $_GET['p'] : "home";

    include 'includes/login.php';