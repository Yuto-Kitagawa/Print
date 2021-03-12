<?php

include "../classes/user.php";

$editfirstname = $_POST['editfirstname'];
$editlastname = $_POST['editlastname'];
$editusername = $_POST['editusername'];
$editemail = $_POST['editemail'];
$edit_icon = $_FILES['editicon']['name'];
$edit_icon_tmp = $_FILES['editicon']['tmp_name'];

$user = new User;
$user->edit($editfirstname,$editlastname, $editusername, $editemail, $edit_icon, $edit_icon_tmp);
