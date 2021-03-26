<?php
require_once "database.php";
class Follow extends Database
{
    public function followUser($user_id, $follow_id) //adduser = follow id , $id = my id
    {
        $sql = "SELECT 'user_id','following' from follow WHERE `user_id`= $user_id AND `following` = $follow_id; ";

        if ($result = $this->conn->query($sql)) {
            if ($result->num_rows >= 1) {
                die("ERROR:you are still following");
            }
        }

        $sql2 = "INSERT INTO follow(`user_id`,`following`) VALUE ('$user_id','$follow_id');";

        if ($this->conn->query($sql2)) {
            header('Location: ../views/userInfoPosts.php?id=' . $follow_id);
        } else {
            die('ERROR :following ' . $this->conn->error);
        }
        /*
        LOGGED IN AS john(2)

        follow emma(5)
        follow mark(3)

        id      user_id     following
        1       john        emma
        2       john        mark

        Get followers
        select username where following = $session id

        //not needed
        id      user_id     follower
        1       emma        john
        2       mark        john
        //not needed
        */
    }

    public function getFollowingUser($id)
    {
        $sql = "SELECT `following` from follow WHERE `user_id` = $id ";
        if ($result = $this->conn->query($sql)) {
            return $result;
        } else {
            die('ERROR: getting following user  ' . $this->conn->error);
        }
    }

    public function checkFollow($user_id, $follow_id)
    {
        $sql = "SELECT `following` from follow WHERE `user_id` = $user_id AND `following` = $follow_id;";
        if ($result = $this->conn->query($sql)) {
            // print_r($result);
            return $result;
        } else {
            die('Error checking following user   ' . $this->conn->error);
        }
    }

    public function unfollow($user_id, $unfollow_id)
    {
        $sql = "DELETE FROM follow WHERE `user_id` = $user_id and `following` = $unfollow_id";
        if ($this->conn->query($sql)) {
            header('Location: ../views/home.php');
            exit;
        } else {
            die('error unfollowing ' . $this->conn->error);
        }
    }

    public function getFollower($id)
    {
        $sql = "SELECT `user_id`,`following` from follow WHERE `following` = $id ";
        if ($result = $this->conn->query($sql)) {
            return $result;
        } else {
            die('ERROR: getting follower user  ' . $this->conn->error);
        }
    }
}
