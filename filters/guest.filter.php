<?php
if (isset($_SESSION['user_id']) && isset($_SESSION['pseudo'])) {
    set_flash("Vous ne pouvez pas accéder à cette page","danger");
    redirect('index.php');
}
