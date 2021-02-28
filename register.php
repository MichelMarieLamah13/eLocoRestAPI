<?php session_start(); ?>
<?php require_once('includes/init.php.'); ?>
<?php require_once('filters/guest.filter.php'); ?>
    <!--Les inclusions nécessaires-->
<?php
//Si le formulaire a été soumis
if (isset($_POST['register'])) {
    //Si tous les champs ont été remplis
    if (not_empty(['name', 'pseudo', 'email', 'password', 'password_confirm','link','cs','ck'])) {
        $errors = []; //Tableau contenant l'ensemble des erreurs
        extract($_POST);
        if (mb_strlen($name) < 3) {
            $errors[] = "Nom trop court: (Minimum 3 caractères) ";
        }

        if (mb_strlen($pseudo) < 3) {
            $errors[] = "Pseudo trop court: (Minimum 3 caractères) ";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adresse email invalide";
        }

        if (mb_strlen($link) < 3) {
            $errors[] = "Url du site trop court: (Minimum 3 caractères) ";
        }
        if (mb_strlen($cs) < 3) {
            $errors[] = "Cs trop court: (Minimum 3 caractères) ";
        }
        if (mb_strlen($ck) < 3) {
            $errors[] = "Ck trop court: (Minimum 3 caractères) ";
        }
        if (mb_strlen($password) < 6) {
            $errors[] = "Mot de pass trop court: (Minimum 6 caractères) ";
        } else {
            if ($password != $password_confirm) {
                $errors[] = "Les deux mots de passe ne concordent pas";
            }
        }


        if (is_already_in_use('pseudo', $pseudo, 'users')) {
            $errors[] = "Pseudo déjà utilisé";
        }

        if (is_already_in_use('email', $email, 'users')) {
            $errors[] = "Adresse E-mail déjà utilisé";
        }

        if (count($errors) == 0) {
            //Envoi d'un mail d'activation
            $to = $email;
            $subject = WEBSITE_NAME . " - ACTIVATION DE COMPTE";
            $pass = $password;
            $password = bcrypt_hash_password($password);
            $token = sha1($pseudo . $email . $password);

            ob_start();
            require_once('templates/emails/activation.tmpl.php');
            $content = ob_get_clean();
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($to, $subject, $content, $headers);
            //Informer l'utilisateur pourqu'il verifie sa boite de reception
            set_flash("Mail d'activation envoyé!", 'success');
            $q = $db->prepare('INSERT INTO users(name, pseudo,email,password,link,cs,ck)
                            VALUES (:name, :pseudo, :email,:password,:link,:cs,:ck)');
            $q->execute([
                'name' => $name,
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => $password,
                'link' => $link,
                'cs' => $cs,
                'ck' => $ck
            ]);
            redirect('index.php');
        } else {
            save_input_data();
        }
    } else {
        $errors[] = "Veuillez SVP remplir tous les champs!";
        save_input_data();
    }
} else {
    clear_input_data();
}
?>
<?php
require_once("views/register.view.php");

