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

        echo "start serching<br>";
        if ($result->num_rows == 1) { //もし同じユーザー名があれば
            //email is exist 
            $user_details = $result->fetch_assoc();
            echo $password . "<br>";
            echo $user_details['password'] . "<br>";
            echo $result->num_rows . "<br>";
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
                //not correct password
                echo "exist account but wrang password";
            }
            // }
        } else {
            echo "Not exist account in this username<br>";
        }
    }

    public function createUser($newFirstName, $newLastName, $newUserName, $newEmail, $newImage, $newImageTmp, $newPassword)
    {


        //It need because fullname and email are unique.
        $sql1 = "SELECT id,first_name,last_name,username,email,`image` from users WHERE email =  $newEmail "; //database information
        $sql2 = "SELECT id,first_name,last_name,username,email,`image` from users WHERE first_name =  $newFirstName AND last_name = $newLastName "; //database information

        // if ($this->conn->query($sql1)->num_rows >= 1) {//check unique about email,J:emailはユニーク設定だから結果が１以上あれば追加しない
        //     die('The email address was used.');
        // }
        // if ($this->conn->query($sql2)->num_rows >= 1) {//check unique about fullname
        //     die('The fullname was used.');
        // }

        if ($newImageTmp == null) { //user追加のSQL文
            // $newImage = "../images/default.jpg";//69 and didn't work
            $sql3 = "INSERT INTO users(first_name,last_name,username,email,`password`) VALUES ('$newFirstName','$newLastName','$newUserName','$newEmail','$newPassword')";
        } else {
            $sql3 = "INSERT INTO users(first_name,last_name,username,email,`image`,`password`) VALUES ('$newFirstName','$newLastName','$newUserName','$newEmail','$newImage','$newPassword')";
            $destination = "../images/" . basename($newImage);
            move_uploaded_file($newImageTmp, $destination); //if i didn't select a picture,the function didn't work
        }


        if ($this->conn->query($sql3)) {
            //The sql for session
            $sql4 = "SELECT id,first_name,last_name,username,email,`image`,`password` FROM users WHERE username = '$newUserName'";
            $result = $this->conn->query($sql4);
            $user_details = $result->fetch_assoc();

            session_start();
            $_SESSION['username'] = $newUserName;
            $_SESSION['user_id'] = $user_details['id'];
            $_SESSION['username'] = $user_details['username'];
            // $_SESSION['fullname'] = $user_details['fullname'];
            $_SESSION['first_name'] = $user_details['first_name'];
            $_SESSION['last_name'] = $user_details['last_name'];
            $_SESSION['icon'] = $user_details['image'];
            $_SESSION['email'] = $user_details['email'];
            $_SESSION['password'] = $user_details['password'];
            header("location: ../views/home.php");
            exit;
        } else {
            die("Error create user: " . $this->conn->error);
        }
    }


    public function edit($editFirstName, $editLastName, $editUserName, $editEmail, $editImage, $editImageTmp)
    {
        session_start();
        //!!!!!!!!!check!!!!!!!!!!!!!!!!
        //it need because SQL does't use $_SESSION[];and get id of the user
        $nowemail = $_SESSION['email'];
        //the user information now
        $sql = "SELECT id,first_name,last_name,username,email,`image` from users WHERE email =  '$nowemail' ";
        //check same fullname;
        $sql2 = "SELECT id,first_name,last_name,username,email,`image` from users WHERE first_name = '$editFirstName' AND last_name = '$editLastName';"; //check same fullname;
        //check same email;
        $sql3 = "SELECT id,first_name,last_name,username,email,`image` from users WHERE email = '$editEmail' ;";
        //if those return bigger than 1, there is same fullname or email address.
        $checkfullname = $this->conn->query($sql2);
        $checkemail = $this->conn->query($sql3);
        if ($checkfullname->num_rows > 1) {
            die('This fullname was used');
        }
        if ($checkemail->num_rows > 1) {
            die('This eamil was used');
        }

        //get id of the user and update database of the user
        if ($result = $this->conn->query($sql)) {
            $user_details = $result->fetch_assoc();
            $id = $user_details['id'];

            if ($editImageTmp == null) { //if image is null,not change one
                $sql4 = "UPDATE users SET first_name = '$editFirstName',last_name ='$editLastName', username = '$editUserName', email = '$editEmail' WHERE id = $id;";
            } else {
                $sql4 = "UPDATE users SET first_name = '$editFirstName',last_name ='$editLastName', username = '$editUserName', email = '$editEmail',`image`='$editImage' WHERE id = $id;";
                $destination = "../images/" . basename($editImage);
                move_uploaded_file($editImageTmp, $destination); //if i didn't select a picture,the function didn't work
            }

            if ($this->conn->query($sql4)) {
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
                die("Error Updating users " . $this->conn->error);
            }
        } else {
            die('Error select information of the user');
        }
    }

    public function searchUser($username)
    {
        $sql = "SELECT id,first_name,last_name,username,`image` from users WHERE username LIKE '%$username%';";
        if ($result = $this->conn->query($sql)) {

            // foreach ($result as $number) {
            //     $user[] =$number['username'] . "<br>";
            // }
            // return $user;
            return $result;
        } else {
            die("ERROR:searching username");
        }
    }
}
