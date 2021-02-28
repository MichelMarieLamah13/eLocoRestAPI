<?php
/*
Uploadify v3.1.0
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
// Define a destination
$targetFolder = '/uploads/'.$_SESSION['user_id']; // Relative to the root

if (!empty($_FILES)) {
    $tempFile = $_FILES['avatar']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

    if(!file_exists($targetPath)){
        mkdir($targetPath,0755,true);
    }

    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
    $fileParts = pathinfo($_FILES['avatar']['name']);

    $randomFileName = md5(uniqid(rand())).'.'.$fileParts['extension'];
    $targetFile = rtrim($targetPath, '/') . '/' . $randomFileName;

    if (in_array($fileParts['extension'], $fileTypes)) {
        move_uploaded_file($tempFile, $targetFile);
        $q = $db->prepare("UPDATE users SET avatar=:avatar WHERE id=:id");
        $q->execute([
            'avatar' => $targetFolder .'/'. $randomFileName,
            'id' => $_POST['user_id']
        ]);
        alertify.success('Image de profile changer avec success');
        $_SESSION['avatar']=$targetFolder.'/' . $randomFileName;
    } else {
       alertify.error('Type de fichier invalide.');
    }
}
?>