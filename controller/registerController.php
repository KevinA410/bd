<?php
require_once '../crud/CrudUser.php';

CrudUser::insert(User::factory(
    NULL,
    $_POST['username'],
    $_POST['email'],
    password_hash($_POST['password'], PASSWORD_DEFAULT),
    NULL,
    NULL
));

echo 'inserted successfuly';