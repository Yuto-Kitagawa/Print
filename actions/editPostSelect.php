<?php
include "../classes/post.php";
$id = $_GET['id'];
$post = new Post;
$post->getPost($id);
