<?php

function paginaValida($page){
    return file_exists("includes/$page.php");
}