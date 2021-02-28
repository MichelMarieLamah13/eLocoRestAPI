<?php
session_start();
require_once('includes/init.php.');
require_once('filters/auth.filter.php');
?>
<?php
if (isset($_POST['change_password'])) {
    $errors = [];
//--Si tous les champs ne sont pas vides
    if (not_empty(['current_password', 'new_password', 'new_password_confirmation'])) {
        extract($_POST);
        if (mb_strlen($current_password) < 6) {
            $errors[] = "Nom trop court: (Minimum 3 caractères) ";
        }

        if (mb_strlen($new_password) < 6) {
            $errors[] = "Mot de pass trop court: (Minimum 6 caractères) ";
        } else {
            if ($new_password != $new_password_confirmation) {
                $errors[] = "Les deux mots de passe ne concordent pas";
            }
        }
        if (count($errors) == 0) {

            $q = $db->prepare("SELECT * FROM users
                         WHERE  (id=:id)
                         AND active='1'");
            $q->execute([
                'id' => get_session('user_id')
            ]);
            $user = $q->fetch(PDO::FETCH_OBJ);

            if ($user && bcrypt_verify_password($current_password, $user->password)) {
                $q = $db->prepare("UPDATE users
                                   SET password=:password
                                   WHERE id=:id");
                $q->execute([
                    'password' => bcrypt_hash_password($new_password),
                    'id' => get_session('user_id')
                ]);
                set_flash('Votre mot de pass a été mis à jour avec succes', 'info');
                redirect("profile.php?id=" . get_session("user_id"));
            }else{
                $errors[] = "Le mot de pass actuel indiqué est incorrect";
            }
        }
    } else {
        $errors[] = "Veuillez, remplir tous les champs";
    }
} else {
    clear_input_data();
}
require_once("views/change.password.view.php");

