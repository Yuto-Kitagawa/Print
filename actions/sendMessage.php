<?php

include "../classes/chat.php";
session_start();

$user_id = $_SESSION['user_id'];
$chat_user_id = $_GET['id'];
$text = htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8');

//adjast time
date_default_timezone_set('Asia/Tokyo');
$time = date("Y/m/d H:i:s");
//chat instance
$chat = new Chat;
$chat->sendMessage($user_id, $chat_user_id, $text, $time);
