<?php namespace App\Models;
use App\DB; 
include_once BASE_PATH . "/config.php";

class Categoria {
    public static function index(){
        $sql = "SELECT * FROM categoria";

        $DB = new DB;
        $stmt = $DB->prepare($sql);
        
        if ($stmt->execute()){
            $fetch = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($fetch); $i++) {
                $row = $fetch[$i];

                $array[$i] = array(
                    'id' => $row['id'],
                    'descricao' => $row['descricao']
                );
            }

            return json_encode($array);
        }
        else return getJsonResponse(false, 'Houve um erro ao consultar');
    }
}