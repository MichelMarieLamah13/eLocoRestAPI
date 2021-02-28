<?php
if (!isset($_SESSION['user_id']) || !isset($_SESSION['pseudo'])) {
    $_SESSION['forwading_url']=$_SERVER['REQUEST_URI'];
    set_flash("Vous devez être connecté pour accéder à cette page","danger");
    redirect('login.php');
}