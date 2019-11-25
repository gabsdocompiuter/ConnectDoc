<?php namespace App\Controllers;
use \App\Models\Calendario; 
include_once BASE_PATH . "/config.php";
 
class CalendarioController {
    public function listarDias($mes){
        echo Calendario::listarDias($mes);
    }
}
