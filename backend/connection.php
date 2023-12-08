<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'xxy');
define('MYSQL_DB_NAME', 'agencia');

try {
    $pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
} catch(PDOException $error) {
    echo $error->getMessage();
}
