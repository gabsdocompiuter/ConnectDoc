<?php namespace init;
// diretório base da aplicação
define('BASE_PATH', dirname(__FILE__));
 
// credenciais de acesso ao MySQL
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'connectdoc');
define('MYSQL_PASS', '7%H4ibRD0B@h');
define('MYSQL_DBNAME', 'connectdoc');
 
// configurações do PHP
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
