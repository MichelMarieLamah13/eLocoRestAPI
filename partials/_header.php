<?php require_once("includes/constants.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Réseau social pour les developpeurs">
    <meta name="author" content="LAMAH MICHEL MARIE">
    <!-- Favicon-------------------------------------------------------------------->
    <?php require_once('favicon.php')?>
    <!--End favicon------------------------------------------------------------------>
    <title>
        <?=
        isset($title) ? $title . ' - ' . WEBSITE_NAME : WEBSITE_NAME . ' Simple, Rapide, Efficace!';
        ?>
    </title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <!--Fontawesome-->
    <link rel="stylesheet" href="libraries/icon/fontawesome-pro/css/all.min.css">
    <!--Prettify-->
    <link rel="stylesheet" href="assets/js/google-code-prettify/prettify.css">
    <!--Flag icon-->
    <link rel="stylesheet" href="libraries/flag-icon/css/flag-icon.css">
    <!--Sweet Alert-->
    <link rel="stylesheet" href="libraries/sweetAlert/sweetalert.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php require_once("partials/_nav.php"); ?>
<?php require_once("partials/_flash.php"); ?>
