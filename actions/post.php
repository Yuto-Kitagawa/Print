<?php
include "../classes/post.php";

session_start();

//username,email(unique),text,image,

$id = $_SESSION['user_id'];
$content = $_POST['post_content'];
$image = $_FILES['post_image']['name'];
$image_tmp = $_FILES['post_image']['tmp_name'];


date_default_timezone_set('Asia/Tokyo');
// $time = date("Y/m/d H:i:s");
$time = date("M d, Y  H:i");

$post = new POST;
$post->uploadPost($id, $content, $image, $image_tmp, $time);
