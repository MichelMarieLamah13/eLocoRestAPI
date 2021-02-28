<!------DEFINITION DES CONSTANTE DE CONNEXION--------->
<?php
define('DB_HOST','localhost');
define('DB_NAME','eloco_rest_api');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
?>
<!---------CONNEXION A LA BASE DE DONNEE--------------->
<?php

try{
    $db=new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){

    die('Erreur: '.$e->getMessage());
}
