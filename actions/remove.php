<?php
include "../classes/user.php";
session_start();
$id = $_SESSION['user_id'];

$users = new User;
$users->deleteUser($id);
