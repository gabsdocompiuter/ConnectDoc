<?php

function paginaValida($page){
    return file_exists("includes/$page.php");
}

function getIncludesDir($dir){
    return "/" . BASE_DIR . "/$dir";
}