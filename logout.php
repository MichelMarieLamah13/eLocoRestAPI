<?php
session_start();
require_once('config/database.php');
require_once('includes/functions.php');

$q=$db->prepare("DELETE FROM auth_tokens WHERE user_id=?");
$q->execute([get_session('user_id')]);
//setcookie('pseudo','',time()-365*24*60*60);
//setcookie('user_id','',time()-365*24*60*60);
//setcookie('avatar','',time()-365*24*60*60);
$session_keys_white_list=['locale'];
$new_session=array_intersect_key($_SESSION,array_flip($session_keys_white_list));
$_SESSION=$new_session;
setcookie('auth','',time()-365*24*60*60);
header('Location:login.php');
