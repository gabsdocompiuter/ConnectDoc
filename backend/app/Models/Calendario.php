<?php namespace App\Models;
use App\DB;
include_once BASE_PATH . "/config.php";

class Calendario {
    public static function listarDias($mes){
        $dias = array(1,  2,  3,  4,  5,  6, 7,
                      8,  9, 10, 11, 12, 13, 14,
                     15, 16, 17, 18, 19, 20, 21,
                     22, 23, 24, 25, 26, 27, 28);

        switch(strtolower($mes)){
            case 'fev':
                $ano = date("Y");

                if (($ano % 4 == 0 && $ano % 100 != 0) || $ano % 400 == 0){
                    array_push($dias, 29);
                }

                return json_encode($dias);

            case 'abr':
            case 'jun':
            case 'set':
            case 'nov':
                array_push($dias, 29, 30);
                return json_encode($dias);

            case 'jan':
            case 'mar':
            case 'mai':
            case 'jul':
            case 'ago':
            case 'out':
            case 'dez':
                array_push($dias, 29, 30, 31);
                return json_encode($dias);            
        }

        return getJsonResponse(false, 'Houve um erro');;
    }
}