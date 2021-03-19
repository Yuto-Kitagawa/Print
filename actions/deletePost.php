<?php
include "../classes/post.php";

$id = $_GET['id'];

$posts = new Post;
$posts->deletePost($id);
