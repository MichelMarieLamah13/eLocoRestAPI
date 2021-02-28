<?php session_start(); ?>
<?php require_once('includes/init.php.'); ?>
<?php require_once('filters/guest.filter.php'); ?>
<?php
if (isset($_POST['login'])) {

    //--Si tous les champs ne sont pas vides
    if (not_empty(['identifiant', 'password'])) {

        $errors = [];
        extract($_POST);
        //---Requete pour selectionner les users
        //--Ayant l'email ou le pseudo
        $q = $db->prepare("SELECT * FROM users
                         WHERE  (pseudo=:identifiant OR email=:identifiant)
                         AND active='1'");
        $q->execute([
            'identifiant' => $identifiant
        ]);
        //--Pouvoir recupérer les données sous forme d'objet
        $user = $q->fetch(PDO::FETCH_OBJ);
        //--Si un user trouvé
        if ($user && bcrypt_verify_password($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['email'] = $user->email;
            $_SESSION['avatar'] = $user->avatar;
            $_SESSION['link'] = $user->link;
            $_SESSION['cs'] = $user->cs;
            $_SESSION['ck'] = $user->ck;

            //Si l'utilisateur veut garder sa session active
            if(isset($_POST['remember_me'])&&$_POST['remember_me']=='on'){
                    // setcookie('pseudo',$user->pseudo,time()+365*24*60*60,null,null,false,true);
                    // setcookie('user_id',$user->id,time()+365*24*60*60,null,null,false,true);
                    // setcookie('avatar',$user->avatar,time()+365*24*60*60,null,null,false,true);
                remember_me($user->id);
            }

            //--redirection avec l'id pour nous permettre
            //--de pouvoir recupérer les données de celui
            //--qui est connecté
            redirect_intent_or('profile.php?id=' . get_session('user_id'));

        } else {
            save_input_data();
            $errors[] = "Mot de Pass incorrect";
            if (!is_already_in_use('pseudo', $identifiant, 'users') &&
                !is_already_in_use('email', $identifiant, 'users')
            ) {
                $errors[] = "Identifiant inexistant";
            }
        }
    } else {
        $errors[] = "Veuillez, remplir tous les champs";
        //--On sauvegarde les valeurs en session
        save_input_data();
    }
} else {
    clear_input_data();
}

require_once("views/login.view.php");
