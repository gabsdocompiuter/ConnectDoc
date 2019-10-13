<?php

function paginaValida($page){
    return file_exists("includes/$page.php");
}

function getAssetsDir(){
    return '/frontend/assets';
}