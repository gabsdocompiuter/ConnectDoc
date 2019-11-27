<?php namespace App\Controllers;
use \App\Models\Categoria; 
include_once BASE_PATH . "/config.php";
 
class CategoriaController {
    public function index(){
        echo Categoria::index();
    }
}
