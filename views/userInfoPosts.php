<?php
session_start();
include "../classes/user.php";
include "../classes/follow.php";
include "../classes/post.php";
$user_obj = new User;
$follow_obj = new Follow;
$post_obj = new Post;
$id = $_GET['id'];

$user_array = $user_obj->getUser($id);
$follow_user_array = $follow_obj->getFollowingUser($id);
$follower_user_array = $follow_obj->getFollower($id);
$posts = $post_obj->getUserPost($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css4.6/bootstrap.css">
    <link rel="stylesheet" href="../../css4.6/modal/modal.css">

    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
    <title>userinfo</title>
    <style>
        .font {
            font-family: "Showcard Gothic";
            font-size: 40px;
        }
    </style>
</head>

<body style="margin-bottom: 100px; border:0;">
    <div id="content" class="row m-0" style="height:100%;background-color: rgba(0,0,0,0.03);">
        <!-- navigation-bar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark w-100" style="height: 10%;padding-right:-30px;">
            <a href="home.php" class="navbar-brand pt-0 mt-0 ">
                <p class="my-auto font h4 pl-2">Print</p>
            </a>
            <a href="follow.php" style="background-color:rgba(200,200,200,0.3); padding:10px 14px 10px 14px; " class="btn text-white rounded-circle "><i class="fas fa-search-plus"></i></a>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li style="cursor: pointer;" class="nav-item openModal pt-2 text-white pr-4 "><?= $_SESSION['username'] ?></li>
                    <li class="nav-item"><a href="../actions/logout.php" class="btn btn-outline-warning btn-sm nav-link text-warning">Log Out</a></li>
                </ul>
            </div>


        </nav>


        <!-- modal1 -->
        <div class="popup js-popup">
            <div class="popup-inner">
                <div class="close-btn js-close-btn"><i class="fas fa-times"></i></div>
                <div class="h3 font">Profile</div>
                <div class="pt-4 w-100 h-100">
                    <!-- <button class="rounded-circle border-0 bg-info text-white p-4 mr-3 mt-1 openSecondModal">Info</button> -->
                    <div class="w-25 h-100 mb-5">
                        <a style="border-radius: 5px;" href="home.php" class="border-0 bg-info text-white w-100 h-100 p-3">Home</a><br>
                    </div>
                    <div class="w-25 h-100">
                        <a style="border-radius: 5px;" href="editUser.php" class=" border-0 bg-primary text-white w-100 p-3 h-100">Edit</a>
                    </div>
                </div>
            </div>
            <div class=" black-background js-black-bg">
            </div><!-- background -->
        </div>


        <div class="col-lg-12 card mx-auto p-0 pt-5 d-flex" style="border-bottom: none;">
            <div class="card-body text-center p-0 mx-auto col-md-6">
                <img src="../images/<?= $user_array['image'] ?>" alt="" width="auto" height="300px">
                <!-- content -->
                <div class="h2 mt-3 pt-3 mr-5" style="white-space:nowrap;">
                    <div class="d-flex justify-content-around pl-4">
                        <div class="text-left pl-4 pt-3">
                            <?= $user_array['username'] ?>
                        </div>
                        <div class="text-right">
                            <?php

                            $user_id = $_SESSION['user_id'];
                            $follow_id = $_GET['id'];
                            $checkfollow_array = $follow_obj->checkFollow($user_id, $follow_id);
                            if ($user_id == $follow_id) {
                            ?>
                                <a href="../views/editUser.php" class="text-right mt-3 h2 w-100 text-dark">
                                    <i class="fas fa-cogs mt-3 ml-5" style="cursor: pointer;"></i>
                                </a>
                            <?php
                            } else if ($checkfollow_array->num_rows > 0) {
                            ?>
                                <a href="../actions/unfollow.php?id=<?= $follow_id ?>" class="btn btn-outline-danger m-4 ml-lg-5">
                                    UNFOLLOW
                                </a>
                            <?php
                            } else {
                                die('Error: display button');
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- follow -->
                <div class="w-100 m-md-0 mx-auto" style="border-bottom:1px solid rgba(0,0,0,0.08);">
                    <div class="d-flex justify-content-around w-75 mx-auto mt-4">
                        <!-- posts -->
                        <div class="h5" style="margin:0;border-bottom:1px solid black;">
                            <a href="../views/userInfoPosts.php?id=<?= $id ?>" class="text-decoration-none text-dark">
                                <p style="white-space: nowrap;"><?= "posts: " . $posts->num_rows ?></p>
                            </a>
                        </div>
                        <!-- following -->
                        <div class="h5 text-muted" style="white-space: nowrap;">
                            <a href="../views/userInfoFollowing.php?id=<?= $id ?>" class="text-dark text-decoration-none text-muted" type="submit" style="user-select: none;"><?= "following: " . (($follow_user_array->num_rows) - 1) ?>
                            </a>
                        </div>
                        <!-- follower -->
                        <div class=" h5 text-muted" style="white-space: nowrap;">
                            <a href="../views/userInfoFollower.php?id=<?= $id ?>" class="text-dark text-decoration-none text-muted" type="submit" style="user-select: none;">
                                <?= "follower: " . (($follower_user_array->num_rows) - 1) . "<br>"; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin:0">
            <div class="mx-auto w-50">
                <?php
                $posts = $post_obj->getUserPost($id);
                $user = $user_obj->getUser($id);
                while ($post_result = $posts->fetch_assoc()) {
                ?>
                    <div class="card-content card w-100 mt-4">

                        <div class="bg-white">
                            <div class=" text-center">
                                <div class="d-flex w-100 align-items-center">
                                    <div class="w-25">
                                        <img class="rounded-circle m-2" src="../images/<?= $user['image'] ?>" alt="" width="50px" height="50px">

                                    </div>
                                    <div class="w-50 text-left h3" style="white-space: nowrap;">
                                        <?= $user['username'] ?>
                                    </div>
                                    <div class="w-50 text-right pr-5 h5">
                                        <button style="background:none" class="border-0 option">
                                            <?php
                                            if ($_SESSION['user_id'] == $id) {
                                            ?>
                                                <div class="text-right w-100">
                                                    <a href="../actions/editPostSelect.php?id=<?= $post_result['id'] ?>" class="btn btn-outline-info lead text-right" name="edit">Edit the post</a>
                                                </div>
                                                <div class="text-right w-100" style="right:0">
                                                    <a href="../actions/deletePost.php?id=<?= $post_result['id'] ?>" class="btn btn-outline-danger lead text-right m-2" name="delete">Delete the post</a>
                                                </div>
                                            <?php } ?>
                                        </button>
                                    </div>
                                </div>
                                <img class="w-100" src="../images/<?= $post_result['image'] ?>" alt="" width="50%" height="50%">
                            </div>

                            <hr class="m-0">
                            <p class="pl-5 pr-5 pt-2 lead" style="font-size: 20px;"><?= $post_result['content'] ?></p>
                            <p class="text-left m-0 ml-2" style="font-size: 15px;"><?= $post_result['time']  ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- post_buttom -->
        <div style="z-index: 999;right:10%;bottom:10%;" class="position-fixed">
            <a href="post.php" style="background-color: sienna;" class="btn border-0 text-white rounded-circle pr-4 pl-4 pb-3 pt-3 post"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <script>
        const option_id = document.getElementById('option');
        const option = document.getElementsByClassName('option')[0];
        option.addEventListener('click', function() {
            option_id.classList.remove('invisible');
        })
    </script>
    <script src="../../script/modal/openmodal.js"></script>

</body>

</html>