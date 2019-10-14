<?php namespace init;
// diretório base da aplicação
define('BASE_PATH', dirname(__FILE__));
 
// credenciais de acesso ao MySQL
define('MYSQL_HOST', 'mysql.monteiro.dev');
define('MYSQL_USER', 'monteiro23');
define('MYSQL_PASS', 'ulbra2019');
define('MYSQL_DBNAME', 'monteiro23');
 
// configurações do PHP
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
