<!--
    Fonction permettant de verifier
    Si un champ n'est pas vide et gère aussi le cas des espaces
-->
<?php
if (!function_exists('not_empty')) {
    function not_empty($fields = [])
    {
        //--Si le tableau contient des elemnts
        if (count($fields) != 0) {
            //--Parcourt
            foreach ($fields as $field) {
                //--Est vide ou ne contient que des espaces
                if (empty($_POST[$field]) || trim($_POST[$field]) == "") return false;
            }
            return true;
        }
    }
}
?>

<!--
    Fonction permettant de verifier
    l'unicité du pseudo et de l'email
-->
<?php
if (!function_exists('is_already_in_use')) {
    function is_already_in_use($field, $value, $table)
    {
        //--Utiliser une variable de la fonction principal
        //--dans une autre fonction
        global $db;
        //--Selection ligne ayant ces infos
        $q = $db->prepare("SELECT id FROM $table
                         WHERE $field=?");
        $q->execute([$value]);
        //--On compte le nombre de ligne
        $count = $q->rowCount();
        $q->closeCursor();
        //--On retourne ce nombre soit 1 soit 0
        return $count;
    }
}
?>


<!--
    Fonction permettant de sauvegarder
    les valeurs des inputs dans des sessions
    pour les preremplir à en cas d'erreurs
-->
<?php
if (!function_exists('save_input_data')) {
    function save_input_data()
    {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'password') === false) {
                $_SESSION['input'][$key] = $value;
            }
        }

    }
}
?>


<!--
    Fonction permettant de supprimer
    les valeurs des inputs stocker dans les sessions
    Pour ne pas les afficher lorsqu'on revient sur
    la page
-->
<?php
if (!function_exists('clear_input_data')) {
    function clear_input_data()
    {
        if (isset($_SESSION['input'])) {
            $_SESSION['input'] = [];
        }
    }
}
?>


<!--
    Fonction permettant de definir les variables
    de session pour les messages qui seront affichés
    dans une autre page
-->
<?php
if (!function_exists('set_flash')) {
    function set_flash($message, $type = 'info')
    {
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;
    }
}
?>

<!--
    Fonction permettant de faire
    la redirection vers une page
-->
<?php
if (!function_exists('redirect')) {
    function redirect($page)
    {
        header("Location: $page");
        exit();
    }
}
?>


<!--
    Fonction permettant d'afficher
    les valeurs des inputs stocker dans les sessions
    pour les preremplir à en cas d'erreurs
-->
<?php
if (!function_exists('get_input')) {
    function get_input($key)
    {
        return !empty($_SESSION['input'][$key])
            ? e($_SESSION['input'][$key])
            : null;
    }
}
?>

<!--
    Fonction permettant de resoudre le
    problème des faille XSS
-->
<?php
if (!function_exists('e')) {
    function e($string)
    {
        if ($string) {
            /*return strip_tags($string);*/
            return htmlspecialchars($string);
        }

    }
}
?>

<!--
    Fonction permettant de verifier
    l'unicité du pseudo et de l'email
-->
<?php
if (!function_exists('is_already_in_use')) {
    function is_already_in_use($field, $value, $table)
    {
        //--Utiliser une variable de la fonction principal
        //--dans une autre fonction
        global $db;
        //--Selection ligne ayant ces infos
        $q = $db->prepare("SELECT id FROM $table
                         WHERE $field=?");
        $q->execute([$value]);
        //--On compte le nombre de ligne
        $count = $q->rowCount();
        $q->closeCursor();
        //--On retourne ce nombre soit 1 soit 0
        return $count;
    }
}
?>

<!--
Fonction permettant de retourner la classe active
ce qui permettra de mettre un background sur la
page sur laquelle nous nous trouverons
-->
<?php
if (!function_exists('set_active')) {
    function set_active($file)
    {
        //Recuperer la page sur laquelle nous sommes
        $temp = explode('/', $_SERVER['SCRIPT_NAME']);
        $page = array_pop($temp);

        return ($page == $file)
            ? "active"
            : "";
    }
}

?>

<!--
    Fonction permettant de
    les valeurs des $_SESSION['..'] stocker dans les sessions
    pour ne pas à chaque fois avoir à mettre $_SESSION['..']
-->
<?php
if (!function_exists('get_session')) {
    function get_session($key)
    {
        if ($key) {
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
    }
}
?>

<!--
    Fonction permettant de verifier
    si l'email ou le pseudo n'ont pas été modifié
-->
<?php
if (!function_exists('is_already_him')) {
    function is_already_him($field1, $value1, $table, $value2, $field2)
    {
        //--Utiliser une variable de la fonction principal
        //--dans une autre fonction
        global $db;
        //--Selection ligne ayant ces infos
        $q = $db->prepare("SELECT $field1 FROM $table
                         WHERE $field1=? AND $field2=?");
        $q->execute([$value1, $value2]);
        $count = $q->rowCount();
        $q->closeCursor();
        //--On retourne true ou false
        return $count;
    }
}
?>

<!--
    Fonction permettant de
    les valeurs des $_SESSION['..'] stocker dans les sessions
    pour ne pas à chaque fois avoir à mettre $_SESSION['..']
-->
<?php
if (!function_exists('get_session')) {
    function get_session($key)
    {
        if ($key) {
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
    }
}
?>

<!--
    Fonction permettant de retrouver un user
    dans la bd possedant dond $field correspond
    $value dans $table
-->
<?php
if (!function_exists('find_user')) {
    function find_user($field, $value, $table)
    {
        //--Utiliser une variable de la fonction principal
        //--dans une autre fonction
        global $db;
        //--Selection ligne ayant ces infos
        $q = $db->prepare("SELECT * FROM $table
                         WHERE $field=?");
        $q->execute([$value]);
        //--On recupère les données sous forme d'objet
        //--Ici on en aura qu'une
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        //--On retourne ce nombre soit 1 soit 0
        return $data;
    }
}
?>

<!--
    Fonction permettant de
    les générer l'url de l'avatar de l'utilisateurs
-->
<?php
if (!function_exists('get_avatar_url')) {
    function get_avatar_url($email, $size = 25)
    {
        $gravatar_url = "http://gravatar.com/avatar/" . md5(strtolower(trim(e($email)))) . "?s=" . $size . "&d=mm";
        return $gravatar_url;
    }
}
?>

<!--
    Fonction permettant de savoir si un user
    est connecté ou non
-->
<?php
if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
    }
}
?>

<!--
Fonction permettant de hacher le
mot de pass avec l'algorithme de Blow fish
-->
<?php
if (!function_exists('bcrypt_hash_password')) {
    function bcrypt_hash_password($value, $options = [])
    {
        $cost = isset($options['rounds']) ? $options['rounds'] : "10";
        $hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
        if ($hash === false) {
            throw new Exception("Bcrypt hashing'est pas supporté");
        }
        return $hash;
    }
}
?>

<!--
Fonction permettant de vérifier si le
mot de pass haché correspond bien à celui en base de donnée
-->
<?php
if (!function_exists('bcrypt_verify_password')) {
    function bcrypt_verify_password($value, $hachedValue)
    {
        return password_verify($value, $hachedValue);
    }
}
?>

<!--
Fonction permettant de faire une
friendly redirect
-->
<?php
if (!function_exists('redirect_intent_or')) {
    function redirect_intent_or($default_url)
    {
        if (!empty($_SESSION['forwading_url'])) {
            $url = $_SESSION['forwading_url'];
            $_SESSION['forwading_url'] = null;
        } else {
            set_flash("Bienvenu sur votre espace personnel", "info");
            $url = $default_url;
        }
        redirect($url);
    }
}
?>

<!--
Fonction permettant de stoker les
tokens de manière aléatoire
-->
<?php
if (!function_exists('remember_me')) {
    function remember_me($user_id)
    {
        global $db;
        //Générer le token de manière aléatoire
        $token = openssl_random_pseudo_bytes(24);
        //Générer le selecteur de manière aléatoire et s'assurer qu'il est unique
        do {
            $selector = utf8_encode (openssl_random_pseudo_bytes(9)) ;
            $count = is_already_in_use('selector', $selector, 'auth_tokens');
        } while ($count > 0);

        //Sauvez les infos(user_id, selector,expires(14 jours), token(hashed))
        $q = $db->prepare("INSERT INTO auth_tokens(expires, selector,user_id,token)
                         VALUES(DATE_ADD(NOW(),INTERVAL 14 DAY),:selector,:user_id,:token)");
        $q->execute([
            'selector' => $selector,
            'user_id' => $user_id,
            'token' => hash('sha256', $token)
        ]);
        //Créez un cookie expires(14 jours) httpOnly=>true
        //--Contenu: base64_encode(selector).':'.base64_encode(token)
        setcookie('auth', base64_encode($selector) . ':' . base64_encode($token),
            time() + 14 * 24 * 60 * 60, null, null, false, true);

    }
}
?>

<!--
Fonction permettant de connecter
automatiquement l'utilisateur
-->
<?php
if (!function_exists('auto_login')) {
    function auto_login()
    {
        global $db;
        //Vérifier que notre cookie 'auth' existe
        if (!empty($_COOKIE['auth'])) {
            $split = explode(':', $_COOKIE['auth']);
            if (count($split) !== 2) {
                return false;
            }
            //Récuperer via ce cookie le selecteur et le token
            list($selector, $token) = $split;
            $q = $db->prepare("SELECT a.token,a.user_id, u.id,u.pseudo,u.avatar,u.email
                               FROM auth_tokens a
                               LEFT JOIN users u
                               ON a.user_id=u.id
                               WHERE selector=? AND expires>=CURDATE()");
            $q->execute([base64_decode($selector)]);
            $data = $q->fetch(PDO::FETCH_OBJ);
            if ($data) {
                if (hash_equals($data->token, hash('sha256', base64_decode($token)))) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $data->user_id;
                    $_SESSION['pseudo'] = $data->pseudo;
                    $_SESSION['email'] = $data->email;
                    $_SESSION['avatar'] = $data->avatar;

                } else {
                    return false;
                }
            }
        }

        return false;
    }
}
?>


<!--
Fonction permettant de remplacer les
liens dans les microposts
-->
<?php
if (!function_exists('replace_links')) {
    function replace_links($texte)
    {
//        $array1=array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)
//            (?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»““””‘’]))/',
//            '/(^|[^a-z0-9_]@[^a-z0-9_]+)/i',
//            '/(^|[^a-z0-9_]#[^a-z0-9_]+)/i');
//        $array2=array('<a href="$1" target="_blank">$1</a>','$1<a href="">@$2</a>','$1<a href="index.php?hashtag=$2">#$2</a>');
//        $url=preg_replace($array1,$array2,$texte);
//        return $url;
        $regex_url = "/(http(s)?|ftp(s)?)\:(\/){2}[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";
        $url = preg_replace($regex_url, "<a href=\"$0\" target=\"_blank\">$0</a>", $texte);
        return $url;
    }
}
?>

<!--
Fonction permettant de verifier
si une demande d'amitié a déjà été
envoyé
-->
<?php
if (!function_exists('relation_link_to_display')) {
    function relation_link_to_display($id)
    {
        global $db;
        $q = $db->prepare("SELECT * FROM friends_relationships
                         WHERE (user_id1=:user_id1 AND user_id2=:user_id2)
                         OR (user_id1=:user_id2 AND user_id2=:user_id1)");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $id
        ]);
        $data = $q->fetch();
        if($data){
            if ($data['user_id1'] == $id && $data['status'] == '0') {
                //Lien pour accepter ou annuler la demande
                return 'accept_reject_relation_link';
            } elseif ($data['user_id1'] == get_session('user_id') && $data['status'] == '0') {
                //Lien pour annuler la demande
                return 'cancel_relation_link';
            } elseif (($data['user_id1'] == get_session('user_id') || $data['user_id1'] == $id) && $data['status'] == '1') {
                //Lien pour retirer de la liste d'amis
                return 'delete_relation_link';
            }
        }        
        //Lien pour envoyer la demande
        return 'add_relation_link';
        
    }
}
?>

<!--
Fonction permettant de compter
le nombre d'amis
-->
<?php
if (!function_exists('friends_count')) {
    function friends_count()
    {
        global $db;
        //--Selection ligne ayant ces infos
        $q = $db->prepare("SELECT status FROM friends_relationships
                           WHERE (user_id1=:user OR user_id2=:user)
                           AND status='1'");
        $q->execute([
            'user' => $_GET['id'],
            'status' => '1'
        ]);
        //--On compte le nombre de ligne
        $count = $q->rowCount();
        $q->closeCursor();
        //--On retourne ce nombre soit 1 soit 0
        return $count;
    }
}
?>

<!--
Fonction permettant de vérifier
si une demande d'amitié a déjà été
envoyée
-->
<?php
if (!function_exists('friend_request_has_been_sent')) {
    function friend_request_has_been_sent($id1, $id2)
    {
        global $db;
        $q = $db->prepare("SELECT * FROM friends_relationships
                         WHERE (user_id1=:user_id1 AND user_id2=:user_id2)
                         OR (user_id1=:user_id2 AND user_id2=:user_id1)");
        $q->execute([
            'user_id1' => $id1,
            'user_id2' => $id2
        ]);
        //--On compte le nombre de ligne
        $count = $q->rowCount();
        $q->closeCursor();
        //--On retourne ce nombre soit 1 soit 0
        return $count;
    }
}
?>

<!--
    Fonction permettant de verifier
    si deux users sont amis
-->
<?php
if (!function_exists('is_already_friend')) {
    function is_already_friend()
    {
        //--Utiliser une variable de la fonction principal
        //--dans une autre fonction
        global $db;
        //--Selection ligne ayant ces infos
        $q = $db->prepare("SELECT * FROM friends_relationships
                          WHERE ((user_id1=:user_id1 AND user_id2=:user_id2)
                          OR (user_id1=:user_id2 AND user_id2=:user_id1))
                          AND (status='1' OR status='2')");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $_GET['id'],
        ]);
        $count = $q->rowCount();
        $q->closeCursor();
        //--On retourne true ou false
        return $count;
    }
}
?>

<!--
    Fonction permettant de verifier
    si un micropost a déjà été aimé par l'utilisateur courant
-->
<?php
if (!function_exists('micropost_has_already_been_liked')) {
    function micropost_has_already_been_liked($micropost_id)
    {
        global $db;
        $q = $db->prepare('SELECT * FROM micropost_like
                       WHERE user_id=:user_id AND micropost_id=:micropost_id');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);

        $count = $q->rowCount();
        return (bool)$count;
    }
}
?>

<!--
    Fonction permettant d'aimer un micropost
-->
<?php
if (!function_exists('like_micropost')) {
    function like_micropost($micropost_id)
    {
        global $db;
        $q = $db->prepare('INSERT INTO micropost_like(user_id,micropost_id)
                       VALUES (:user_id,:micropost_id)');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);

        $q = $db->prepare('UPDATE microposts
                           SET like_count=like_count+1
                           WHERE id=?');
        $q->execute([$micropost_id]);
    }
}
?>

<!--
    Fonction permettant de ne pas aimer un micropost
-->
<?php
if (!function_exists('unlike_micropost')) {
    function unlike_micropost($micropost_id)
    {
        global $db;
        $q = $db->prepare('DELETE FROM micropost_like
                           WHERE (user_id=:user_id AND micropost_id=:micropost_id)');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);

        $q = $db->prepare('UPDATE microposts
                           SET like_count=like_count-1
                           WHERE id=?');
        $q->execute([$micropost_id]);
    }
}
?>

<!--
    Fonction permettant d'afficher
    les likers
-->
<?php
if (!function_exists('get_likers_text')) {
    function get_likers_text($micropost_id)
    {
        $like_count = get_like_count($micropost_id);
        $likers = get_likers($micropost_id);
        $output = '';
        if ($like_count > 0) {
            $remaining_like_count = $like_count - 3;
            $itself_like = micropost_has_already_been_liked($micropost_id);
            foreach ($likers as $liker) {
                if (get_session('user_id') !== $liker->id) {
                    $output .= '<a href="profile.php?id=' . $liker->id . '">' . e($liker->pseudo) . '</a>, ';
                }
            }
            $output = $itself_like
                ? 'Vous, ' . $output
                : $output;

            if(($like_count==2 || $like_count==3 )&&$output!=""){
                $output = trim($output, ', ');
                $arr=explode(',',$output);
                $lastItem=array_pop($arr);
                $output=implode(', ',$arr);
                $output.=' et '.$lastItem;
            }

            $output = trim($output, ', ');


            switch ($like_count) {
                case 1:
                    $output .= $itself_like
                        ? " aimez ce micropost."
                        : " aime ce micropost.";
                    break;
                case 2:
                case 3:
                    $output .= $itself_like
                        ? " aimez ce micropost."
                        : " aiment ce micropost.";
                    break;
                case 4:
                    $output .= $itself_like
                        ? " et 1 une autre personne aimez ce micropost."
                        : " et 1 une autre personne aiment ce micropost.";
                    break;
                default:
                    $output .= $itself_like
                        ?" et '.$remaining_like_count.' autres personnes aimez ce micropost."
                        :" et '.$remaining_like_count.' autres personnes aiment ce micropost.";
                    break;
            }
        }
        return $output;
    }
}
?>

<!--
    Fonction permettant de compter
    le nombre des likers
-->
<?php
if (!function_exists('get_like_count')) {
    function get_like_count($micropost_id)
    {
        global $db;
        $q = $db->prepare('SELECT like_count FROM microposts
                           WHERE id=?');
        $q->execute([$micropost_id]);

        $data = $q->fetch(PDO::FETCH_OBJ);

        return intval($data->like_count);

    }
}
?>

<!--
    Fonction permettant de retourner
    les pseudonyme des likers
-->
<?php
if (!function_exists('get_likers')) {
    function get_likers($micropost_id)
    {
        global $db;
        $q = $db->prepare('SELECT u.id,u.pseudo
                           FROM users u
                           LEFT JOIN micropost_like m
                           ON u.id=m.user_id
                           WHERE m.micropost_id=?
                           ORDER BY m.id DESC
                           LIMIT 3');
        $q->execute([$micropost_id]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        return $data;

    }
}
?>


<!--
    Fonction permettant de créer un micropost
-->
<?php
if (!function_exists('create_micropost')) {
    function create_micropost($content)
    {
        global $db;
        $q = $db->prepare("INSERT INTO microposts(content,user_id)
                             VALUES(:content,:user_id)");
        $q->execute([
            'content' => $content,
            'user_id' => get_session('user_id')
        ]);
    }
}
?>




