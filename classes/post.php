<?php
require_once "database.php";

class POST extends Database
{
    public function uploadPost($id, $content, $image, $image_tmp, $time)
    {
        if ($image_tmp == null) { //user追加のSQL文
            // $newImage = "../images/default.jpg";//69 and didn't work
            $sql = "INSERT INTO posts(content,`user_id`,`time`) VALUES ('$content','$id','$time');";
        } else {
            $sql = "INSERT INTO posts(content,`image`,`user_id`,`time`) VALUES ('$content','$image','$id','$time');";
            $destination = "../images/" . basename($image);
            move_uploaded_file($image_tmp, $destination); //if i didn't select a picture,the function didn't work
        }

        if ($this->conn->query($sql)) {
            header('location: ../views/home.php');
            exit;
        } else {
            die('Error: Connection database : ' . $this->conn->error);
        }
    }

    public function getLatestPost($id)
    {
        $id_str = current($id);
        $sql = "SELECT posts.id,follow.following,posts.content,posts.image,posts.time FROM posts INNER JOIN follow ON posts.user_id = follow.following WHERE follow.user_id = $id_str ORDER BY time DESC";
        if ($result = $this->conn->query($sql)) {
            return $result;
        } else {
            die("Error getting latest post" . $this->conn->error);
        }
    }

    public function getUserPost($id)
    {
        $sql = "SELECT * FROM posts WHERE user_id = $id ORDER BY time DESC;";
        if ($result = $this->conn->query($sql)) {
            return $result;
        } else {
            die('Error getting post' . $this->conn->error);
        }
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM posts WHERE id = $id;";
        if ($this->conn->query($sql)) {
            header('Location: ../views/home.php');
        } else {
            die('Error deleting post' . $this->conn->error);
        }
    }

    public function getPost($id)
    {
        $sql = "SELECT id,content,`image` from posts WHERE id = $id";
        if ($result_array = $this->conn->query($sql)) {
            session_start();
            $result = $result_array->fetch_assoc();
            $_SESSION['post_id'] = $result['id'];
            $_SESSION['content'] = $result['content'];
            $_SESSION['post_image'] = $result['image'];
            // die($_SESSION['content'] . " " . $_SESSION['post_image']);
            header('Location: ../views/editPost.php');
            exit;
        } else {
            die('Error selecting post' . $this->conn->error);
        }
    }

    public function updatePost($id, $content, $image, $image_tmp)
    {
        if ($image_tmp == null) { //user追加のSQL文
            // $newImage = "../images/default.jpg";//69 and didn't work
            $sql = "UPDATE posts SET content = '$content' WHERE id = $id;";
        } else {
            $sql = "UPDATE posts SET content = '$content',`image` = '$image' WHERE id=$id;";
            $destination = "../images/" . basename($image);
            move_uploaded_file($image_tmp, $destination); //if i didn't select a picture,the function didn't work
        }

        if ($this->conn->query($sql)) {
            unset($_SESSION['post_id']);
            unset($_SESSION['post_image']);
            unset($_SESSION['post_content']);
            header('location: ../views/home.php');
            exit;
        } else {
            die('Error: Connection database : ' . $this->conn->error);
        }
    }
}
