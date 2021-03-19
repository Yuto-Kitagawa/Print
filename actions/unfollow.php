<?php
include "../classes/follow.php";

session_start();
$user_id = $_SESSION['user_id'];
$unfollow_id = $_GET['id'];

$follow = new Follow;
$follow->unfollow($user_id, $unfollow_id);
