<?php
session_start();
include "../classes/user.php";
include "../classes/follow.php";
include "../classes/post.php";

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
    <title>Print Home</title>
</head>

<style>
    .font {
        font-family: "Showcard Gothic";
        font-size: 40px;
    }

    button {
        cursor: pointer;
        outline: none;
        border: none;
        border-radius: 8px;
        position: relative;
        height: 18px;
        z-index: 1;
        transition: 1s color;
        will-change: color;
        background-color: white;
        width: 100%;
    }

    button:hover {
        color: white;
    }

    .button-background {
        background: red;
        position: absolute;
        top: 5px;
        /* 12px / 2 = 6px */
        left: 0%;
        width: 100%;
        height: calc(100% + 8px);
        /**red height */
        z-index: -9999;
        pointer-events: none;
        transform: scaleX(0);
    }

    .button-background-start {
        transform-origin: 0;
    }

    .button-background-end {
        transform-origin: 100%;
        transform: scaleX(0);
        transition: 0.5s transform;
        will-change: transform;
    }

    button:hover .button-background-start {
        transform: scaleX(1);
        transition: 0.5s transform;
        will-change: transform;
    }

    button:hover .button-background-end {
        transform: scaleX(1);
        visibility: hidden;
    }

    .button-animation-progress .button-background-start {
        transform: scaleX(1);
        transition: 0.5s transform;
        will-change: transform;
    }

    .button-animation-progress .button-background-end {
        transform: scaleX(1);
        visibility: hidden;
    }
</style>

<body>
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
                <div class="h3">Profile</div>
                <div class="pt-4">
                    <!-- <button class="rounded-circle border-0 bg-info text-white p-4 mr-3 mt-1 openSecondModal">Info</button> -->
                    <a href="userinfo.php?id=<?= $_SESSION['user_id'] ?>" class="rounded-circle border-0 bg-info text-white p-4 mr-3 mt-1 openSecondModal">Info</a>
                    <a href="editUser.php" class="rounded-circle border-0 bg-primary text-white mt-1 p-4 me-4 mr-3">Edit</a>
                </div>
            </div>
            <div class="black-background js-black-bg"></div><!-- background -->
        </div>

        <!-- bottom of the page  -->
        <div class="w-100 pt-5 h-100 content d-flex">
            <div class="card font">
                <a href="../views/userinfo.php?id=<?= $_SESSION['user_id'] ?>" style="margin-bottom:8px;">
                    <button style="font-size: 22px; ">
                        User Information
                        <div class="button-background button-background-start"></div>
                        <div class="button-background button-background-end"></div>
                    </button>
                </a>
                <a href="../views/editUser.php">
                    <button style="font-size: 22px;">
                        Edit User Infomation
                        <div class="button-background button-background-start"></div>
                        <div class="button-background button-background-end"></div>
                    </button>
                </a>
            </div>
            <div class=" col-md-12  col-lg-6 card　mt-5 mx-auto">
                <div class="card-content">
                    <?php
                    $user_obj = new User; //user_obj instance
                    $follow_obj = new Follow; //follow_obj instance
                    $posts_obj = new Post; //post instance

                    //First, search following account 
                    $id = $_SESSION['user_id']; //this user_id
                    $following = $follow_obj->getFollowingUser($id); //followingにfollowしてる人のidが格納
                    $follow_id = $following->fetch_assoc();
                    $posts = $posts_obj->getLatestPost($follow_id);
                    if ($posts->num_rows == 0) {
                    ?>
                        <div class="m-3 h-100 align-items-center " style="height:75vh !important; user-select:none;">
                            <h4 class="text-center">Let's Follow someone!</h4>
                        </div>
                        <?php
                    } else {
                        while ($post_result = $posts->fetch_assoc()) {

                            $userImage = $user_obj->getUserImage($post_result['following']);
                            $userName = $user_obj->getUser($post_result['following']);
                        ?>
                            <br>
                            <div class="bg-white m-3 card">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../images/<?= $userImage['image'] ?>" alt="" width="50px" height="50px">
                                    <a href="../views/userinfo.php?id=<?= $post_result['following'] ?>" class="h3 pl-4 text-dark"><?= $userName['username']; ?></a>
                                </div>
                                <img src="../images/<?= $post_result['image'] ?>" alt="" width="100%" height="100%">
                                <p class="text-right m-0 "><?= $post_result['time']  ?></p>
                                <hr style="margin: 0;">
                                <p class="pl-5 pr-5 pt-2 font-weight-bold" style="font-size: 20px;"><?= $post_result['content'] ?></p>
                            </div>

                    <?php }
                    } ?>
                </div>
            </div>


            <!-- post_buttom -->
            <div style="z-index: 999;right:10%;bottom:10%;" class="position-fixed">
                <a href="post.php" style="background-color: sienna;" class="btn border-0 text-white rounded-circle pr-4 pl-4 pb-3 pt-3 post"><i class="fas fa-plus"></i></a>
            </div>


        </div>



    </div>

    <script>
        {
            'use strict'

            const button = document.querySelectorAll('button');
            for (let i = 0, len = button.length; i < len; i++) {
                button[i].addEventListener('mouseover', buttonMouseOver);
            }

            function buttonMouseOver(e) {
                const button = e.target.parentElement.querySelector('button');
                const button_background_start = e.target.querySelector('.button-background-end');
                button.addEventListener('mouseout', buttonMouseOut);
                button_background_start.addEventListener('transitionend', (function() {
                    button.removeEventListener('mouseout', buttonMouseOut);
                }), {
                    once: true
                });
            }

            function buttonMouseOut(e) {
                const button_background_end = e.target.querySelector('.button-background-end');
                e.target.classList.add('button-animation-progress');
                button_background_end.addEventListener('transitionend', (function() {
                    e.target.classList.remove('button-animation-progress');
                }), {
                    once: true
                });
            }
        }
    </script>
    <script src="../../script/modal/openmodal.js"></script>
    <script src="../../script/modal/secondmodal.js"></script>
    <script src="../../script/modal/thirdmodal.js"></script>

    <script>
        let count = 0;
        const countUp = () => {
            let now = new Date;
            let dtf = now.getFullYear().toString() + "/" + (now.getMonth() + 1).toString() + "/" + +now.getDate().toString() + "  " + now.getHours().toString() + ":" + now.getMinutes().toString() + ":" + now.getSeconds().toString();
            // console.log(dtf);
        }
        setInterval(countUp, 1000);
    </script>

</body>

</html>