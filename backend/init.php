<?php namespace init;
// diretório base da aplicação
define('BASE_PATH', dirname(__FILE__));
 
// credenciais de acesso ao MySQL
// define('MYSQL_HOST', 'mysql.monteiro.dev');
// define('MYSQL_USER', 'monteiro23');
// define('MYSQL_PASS', 'ulbra2019');
// define('MYSQL_DBNAME', 'monteiro23');

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'imed');
define('MYSQL_PASS', 'imed10741961');
define('MYSQL_DBNAME', 'connectdoc');
 
// configurações do PHP
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
