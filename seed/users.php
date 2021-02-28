<?php
require_once('../config/database.php');
require_once('../includes/functions.php');
require_once('../vendor/autoload.php');

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

for ($i = 1; $i < 30; $i++) {
    $q = $db->prepare("INSERT INTO users(name,pseudo,email,password,active,created_at,city,country,link,cs,ck,description)
                       VALUES(:name,:pseudo,:email,:password,:active,:created_at,:city,:country,:link,:cs,:ck,:description)");

    $q->execute([
         'name'=> $faker->unique()->company,
         'pseudo'=>$faker->unique()->userName,
         'email'=>$faker->unique()->email,
         'password'=>bcrypt_hash_password('123654'),
         'active'=>1,
         'created_at'=>$faker->date().' '.$faker->time(),
         'city'=>$faker->city,
         'country'=>$faker->country,
         'link'=>'http://localhost:8081/eLoco/',
         'cs'=>'cs_c80be3a2b1b5b81f42f97bce7d585899ff6f280d',
         'ck'=>'ck_058cf2b810b26b3e6424462b11be67464e91f7fa',
         'description'=>$faker->paragraph()
    ]);

}

echo('Users added!!!');
