<?php
require_once "database.php";

class User extends Database
{
    public function login($email, $password)
    {
        $sql = "SELECT id,first_name,last_name,username,email,`image`,`password` FROM users WHERE email = '$email'";

        $result  = $this->conn->query($sql);
        //1.If the email exists
        //2.If the password is correct.Compare the login password to database

        // echo "start serching<br>";
        if ($result->num_rows == 1) { //もし同じユーザー名があれば
            //email is exist 
            $user_details = $result->fetch_assoc();
            // echo $password . "<br>";
            // echo $user_details['password'] . "<br>";
            // echo $result->num_rows . "<br>";
            // while ($user_details = $result->fetch_assoc()) { //user名はuniqueではないのでループで回す

            if (password_verify($password, $user_details['password'])) { //ユーザー名とパスワードが一致
                //correct password
                session_start();
                $_SESSION['user_id'] = $user_details['id'];
                $_SESSION['username'] = $user_details['username'];
                $_SESSION['first_name'] = $user_details['first_name'];
                $_SESSION['last_name'] = $user_details['last_name'];
                $_SESSION['icon'] = $user_details['image'];
                $_SESSION['email'] = $user_details['email'];
                $_SESSION['password'] = $user_details['password'];
                header("location: ../views/home.php"); //go to undex.php / login page
            } else {
                // const alertClass = document.getElementsByClassName('alert')[0];
                // alertClass.classList.remove('d-none');
                //not correct password
                // echo "exist account but wrang password";
                header('Location: ../views/index.php?err=1');
                exit;
            }
        } else {
            // echo "Not exist account in this username<br>"
            header('Location: ../views/index.php?err=1');
            exit;
        }
    }

    // change to snake case
    public function createUser($newFirstName, $newLastName, $newUserName, $newEmail, $newImage, $newImageTmp, $newPassword)
    {
        //check unique the email 
        $sql1 = "SELECT id from users WHERE email = '$newEmail';";; //database information
        $result_sql1 = $this->conn->query($sql1);
        if ($result_sql1->num_rows >= 1) {
            header('Location: ../views/createUser.php?err=2');
            exit;
        }


        // make sql sentence
        if ($newImageTmp == null) { //if newImage is null
            $sql3 = "INSERT INTO users(first_name,last_name,username,email,`password`) VALUES ('$newFirstName','$newLastName','$newUserName','$newEmail','$newPassword')";
        } else { //newImage is not null
            $sql3 = "INSERT INTO users(first_name,last_name,username,email,`image`,`password`) VALUES ('$newFirstName','$newLastName','$newUserName','$newEmail','$newImage','$newPassword')";
            $destination = "../images/" . basename($newImage);
            move_uploaded_file($newImageTmp, $destination); //if i didn't select a picture,the function didn't work
        }

        //insert into database(users)
        if ($this->conn->query($sql3)) {
            //The sql for session
            $sql4 = "SELECT id,first_name,last_name,username,email,`image`,`password` FROM users WHERE username = '$newUserName'";
            $result = $this->conn->query($sql4);
            $user_details = $result->fetch_assoc();

            //SESSION start
            session_start();
            $_SESSION['username'] = $newUserName;
            $_SESSION['user_id'] = $user_details['id'];
            $_SESSION['username'] = $user_details['username'];
            $_SESSION['first_name'] = $user_details['first_name'];
            $_SESSION['last_name'] = $user_details['last_name'];
            $_SESSION['icon'] = $user_details['image'];
            $_SESSION['email'] = $user_details['email'];
            $_SESSION['password'] = $user_details['password'];

            //this can show my post
            $id = $user_details['id'];
            //follow myself
            $sql6 = "INSERT INTO follow(`user_id`,`following`) VALUES ($id,$id);";
            if ($this->conn->query($sql6)) {
                header("location: ../views/home.php");
                exit;
            } else {
                header('Location: ../views/createUser.php');
                exit;
            }
        } else {
            header('Location: ../views/createUser.php');
            exit;
        }
    }

    //editUser and snake case
    public function edit($editFirstName, $editLastName, $editUserName, $editEmail, $editImage, $editImageTmp)
    {
        session_start();

        //it need because SQL does't use $_SESSION[];and get id of the user
        $nowemail = $_SESSION['email'];
        //the user information now
        $sql = "SELECT id,first_name,last_name,username,email,`image` from users WHERE email =  '$nowemail' ";
        //check unique email sentence
        $sql3 = "SELECT id from users WHERE email = '$editEmail' ;";

        //if those return bigger than 1, there is same email address.
        $checkemail = $this->conn->query($sql3);
        if ($checkemail->num_rows >= 1) {
            if ($nowemail == $editEmail) {
            } else {
                header('Location: ../views/editUser.php?err=1');
                exit;
            }
        }

        //get id of the user and update database of the user
        if ($result = $this->conn->query($sql)) {
            $user_details = $result->fetch_assoc();
            $id = $user_details['id'];

            if ($editImageTmp == null) { //if image is null,not change one
                $sql4 = "UPDATE users SET first_name = '$editFirstName',last_name ='$editLastName', username = '$editUserName', email = '$editEmail' WHERE id = $id;";
            } else { //edit all of them
                $sql4 = "UPDATE users SET first_name = '$editFirstName',last_name ='$editLastName', username = '$editUserName', email = '$editEmail',`image`='$editImage' WHERE id = $id;";
                $destination = "../images/" . basename($editImage);
                move_uploaded_file($editImageTmp, $destination); //if i didn't select a picture,the function didn't work
            }

            //update database(users)
            if ($this->conn->query($sql4)) {
                //The sentence for resave session
                $sql5 = "SELECT id,first_name,last_name,username,email,`image` FROM users WHERE id = $id;";
                $select = $this->conn->query($sql5);
                $now_user_details = $select->fetch_assoc();
                // $_SESSION['fullname'] = $editFullName;
                $_SESSION['first_name'] = $now_user_details['first_name'];
                $_SESSION['last_name'] = $now_user_details['last_name'];
                $_SESSION['username'] = $now_user_details['username'];
                $_SESSION['email'] = $now_user_details['email'];
                $_SESSION['icon'] = $now_user_details['image'];
                header("Location: ../views/home.php");
                exit;
            } else {
                header('Location: ../views/home.php');
                exit;
            }
        } else {
            header('Location: ../views/home.php');
            exit;
        }
    }

    //search follow username
    public function searchUser($username)
    {
        $sql = "SELECT id,first_name,last_name,username,`image` from users WHERE username LIKE '%$username%';";
        if ($result = $this->conn->query($sql)) {
            return $result;
        } else {
            die("ERROR:searching username");
        }
    }

    //getUserDetail
    public function getUser($id)
    {
        $sql = "SELECT * from users WHERE id = $id";

        if ($result = $this->conn->query($sql)) {
            return $result->fetch_assoc();
        } else {
            die('Error selecting username : ' . $this->conn->error);
        }
    }

    //delete User
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = $id";
        if ($this->conn->query($sql)) {
            $sql2 = "DELETE FROM follow WHERE `following` = $id OR `user_id` = $id;";
            if ($this->conn->query($sql2)) {
                $sql3 = "DELETE FROM posts WHERE `user_id` = $id";
                if ($this->conn->query($sql3)) {
                    $sql4 = "DELETE FROM chat WHERE `user_id` = $id";
                    if ($this->conn->query($sql4)) {

                        session_unset();
                        session_destroy();
                        header('Location: ../views/index.php');
                        exit;
                    }
                }
            } else {
                die('Error deleting user' . $this->conn->error);
            }
        } else {
            die('Error deleting user' . $this->conn->error);
        }
    }
}
