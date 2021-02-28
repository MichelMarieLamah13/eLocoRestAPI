<?php
session_start();
/**
 * Created by PhpStorm.
 * User: lamah
 * Date: 5/5/2019
 * Time: 1:24 PM
 */
?>
<?php
require_once('includes/init.php.');
require_once('filters/guest.filter.php');
if (!empty($_GET['p']) && is_already_in_use('pseudo', $_GET['p'], 'users')
    && !empty($_GET['token'])
) {
    $pseudo = $_GET['p'];
    $token = $_GET['token'];

    $q = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
    $q->execute([$pseudo]);

    $data = $q->fetch(PDO::FETCH_OBJ);

    if ($data->active !== '1') {
        $token_verif = sha1($pseudo . $data->email . $data->password);
        if ($token == $token_verif) {
            $q = $db->prepare('UPDATE users SET active= ? WHERE pseudo=?');
            $q->execute(['1', $pseudo]);

            set_flash('Votre compte a été bel et bien activé!', 'success');
            redirect('login.php');
        } else {
            set_flash('Jeton de sécurité invalide', 'danger');
            redirect('index.php');
        }
    } else {
        set_flash('Votre compte a déjà été activé!', 'danger');
        redirect('index.php');
    }
} else {
    set_flash('Vous ne pouvez pas acceder à cette page', 'danger');
    redirect('index.php');
}