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

    public function getuser()
    {
        // $sql = "SELECT content,`image`,`user_id`,`time` from posts;";
        // $post_result = $this->conn->query($sql);
        // $post_details = $post_result->fetch_assoc();
        // $id = $post_details['user_id'];
        // $sql2 = "SELECT `user_id`,username from users WHERE user_id = $id;";
        // $user_result = $this->conn->$query($sql2);
        // $user_details = $user_result->fetch_assoc();
    }

    public function getLatestPost()
    {
        $sql = "SELECT `user_id` from posts WHERE id=(SELECT max(id)from posts)";
        $result = $this->conn->query($sql);
        $user_details = $result->fetch_assoc();

        return $user_details['id'];
    }
}
