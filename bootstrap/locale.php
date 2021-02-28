<?php
$autorized_languages = ['fr', 'en'];
if (!empty($_GET['lang']) && in_array($_GET['lang'], $autorized_languages)) {
    $_SESSION['locale'] = $_GET['lang'];
} else {
    if (empty($_SESSION['locale'])) {
        $_SESSION['locale'] = $autorized_languages[0];
    }
}

$locales_files=glob("locales/*");
foreach($locales_files as $file){
    require_once("$file");
}