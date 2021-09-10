<?php
require_once '../crud/CrudUser.php';

$user = CrudUser::select('username', $_POST['username']);
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(!$user){
    echo "This user doesn't exist";
    return;
}

if(!password_verify($_POST['password'], $user->getPassword())){
    echo "User and password doesn't match";
    return;
}

session_start();
$_SESSION['user'] = $user;
header("Location: ../home.php");