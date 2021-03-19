<?php
include "../classes/post.php";
session_start();

$id = $_SESSION['post_id'];
$content = $_POST['post_content'];
$image = $_FILES['post_image']['name'];
$image_tmp = $_FILES['post_image']['tmp_name'];

$post = new Post;

$post->updatePost($id, $content, $image, $image_tmp);
