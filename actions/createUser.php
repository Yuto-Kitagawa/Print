<?php

include "../classes/user.php";

// $fullname = $_POST['fullname'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$username = $_POST['username'];
$email = $_POST['email'];

$icon = $_FILES['icon']['name'];
$icon_tmp = $_FILES['icon']['tmp_name'];
$password = $_POST['password'];
$password_second = $_POST['password_second'];

$user = new User;

if ($password == $password_second) {
    $newpassword = password_hash($password, PASSWORD_DEFAULT);
    $user->createUser($first_name, $last_name, $username, $email, $icon, $icon_tmp, $newpassword);
} else {
    echo "wrang password";
}
