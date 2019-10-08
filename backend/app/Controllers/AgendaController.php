<?php namespace App\Controllers;
 include BASE_PATH . "./config.php";
 
 class AgendaController { 

    
    public function agenda(){
        \App\View::make('\Agenda\agenda');
    }

    public function agendar(){

    }

    
 }