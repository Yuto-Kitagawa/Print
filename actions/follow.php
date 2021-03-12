<?php
include "../classes/follow.php";
session_start();

$user_id = $_SESSION['user_id']; //my ID
$follow_id = $_GET['id']; //add to userID

$follow = new Follow;
$follow->followUser($user_id, $follow_id);
