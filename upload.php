<?php
/*
Uploadify v3.1.0
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/
// Define a destination
$targetFolder = '/uploads/' . get_session('user_id'); // Relative to the root
if (!empty($_FILES)) {
    $tempFile = $_FILES['avatar']['tmp_name'];
    if (file_exists($tempFile)) {
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        // Validate the file type
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
        $fileParts = pathinfo($_FILES['avatar']['name']);

        $randomFileName = md5(uniqid(rand())) . '.' . $fileParts['extension'];
        $targetFile = rtrim($targetPath, '/') . '/' . $randomFileName;
        $fileExtension = strtolower($fileParts['extension']);
        if (in_array($fileExtension, $fileTypes)) {
            move_uploaded_file($tempFile, $targetFile);
            $q = $db->prepare("UPDATE users SET avatar=:avatar WHERE id=:id");
            $q->execute([
                'avatar' => $targetFolder . '/' . $randomFileName,
                'id' => get_session('user_id')
            ]);
            $_SESSION['avatar'] = $targetFolder . '/' . $randomFileName;
        } else {
            $errors[] = 'Type de fichier invalide.';
        }
    }
}
?>