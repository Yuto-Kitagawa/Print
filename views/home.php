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
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <link rel="stylesheet" href="../css4.6/modal/modal.css">
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
    <title>Print</title>
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
        transition: 0.6s color;
        will-change: color;
        background-color: white;
        width: 100%;
    }

    button:hover {
        color: white;
    }

    .button-background {
        background: slategrey;
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
        <nav class="navbar navbar-expand navbar-dark bg-dark w-100 fixed-top" style="height: 10%;padding-right:-30px;z-index:9999">
            <a href="home.php" class="navbar-brand pt-0 mt-0">
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
                <div class="pt-4">
                    <!-- <button class="rounded-circle border-0 bg-info text-white p-4 mr-3 mt-1 openSecondModal">Info</button> -->
                    <a href="userInfoPosts.php?id=<?= $_SESSION['user_id'] ?>" class=" border-0 bg-info text-white p-4 mr-3 mt-1 " style="border-radius:22px">My Posts</a>
                    <a href="userInfoFollowing.php?id=<?= $_SESSION['user_id'] ?>" class=" border-0 bg-danger text-white p-4 mr-3 mt-1 " style="border-radius:22px">My Follow List</a>
                    <a href="editUser.php" class=" border-0 bg-primary text-white mt-1 p-4 me-4 mr-3" style="border-radius:22px">Profile Edit</a>
                    <br>

                </div>
            </div>
            <div class="black-background js-black-bg"></div><!-- background -->
        </div>
    </div>

    <!-- leftside of the page -->
    <div class="card font fixed-top" style="height: 100vh; width: 280px;padding-top:68px;">
        <a href="../views/userInfoPosts.php?id=<?= $_SESSION['user_id'] ?>">
            <button style="font-size: 22px; ">
                My Posts
                <div class="button-background button-background-start"></div>
                <div class="button-background button-background-end"></div>
            </button>
        </a>
        <a href="../views/editUser.php">
            <button style="font-size: 22px;">
                Edit My Profile
                <div class="button-background button-background-start"></div>
                <div class="button-background button-background-end"></div>
            </button>
        </a>
        <a href="../views/userInfoFollowing.php?id=<?= $_SESSION['user_id'] ?>">
            <button style="font-size: 22px;">
                Follow List
                <div class="button-background button-background-start"></div>
                <div class="button-background button-background-end"></div>
            </button>
        </a>
        <a href="../views/userInfoFollower.php?id=<?= $_SESSION['user_id'] ?>">
            <button style="font-size: 22px;">
                Follower List
                <div class="button-background button-background-start"></div>
                <div class="button-background button-background-end"></div>
            </button>
        </a>
    </div>


    <!-- main content -->
    <div class="pt-5 h-100 content d-flex">
        <div id="content" class="row m-0" style="height:100%;background-color: rgba(0,0,0,0.03);">


            <!-- post content -->
            <div class=" col-md-12  col-lg-6 card　mt-5 mx-auto" style="margin-bottom:250px">
                <div class="card-content">
                    <?php
                    $user_obj = new User; //user_obj instance
                    $follow_obj = new Follow; //follow_obj instance
                    $posts_obj = new Post; //post instance

                    //First, search following account 
                    $id = $_SESSION['user_id']; //this user_id
                    $following = $follow_obj->getFollowingUser($id); //followingにfollowしてる人のidが格納
                    $follow_id = $following->fetch_assoc();
                    $posts = $posts_obj->getLatestPost($follow_id['following']);
                    if ($posts->num_rows == 0) {
                    ?>
                        <div class="m-3 h-100 pl-5 ">
                            <div class=" d-flex pl-5" style="margin-left:20vw;margin-right:53vw;margin-bottom:17vh;padding-top:30%">
                                <a style="white-space: nowrap;" class=" btn btn-outline-secondary" href="../views/follow.php">Let's Follow someone!</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        while ($post_result = $posts->fetch_assoc()) {
                            $userDetail = $user_obj->getUser($post_result['following']);
                        ?>
                            <br>
                            <div class="bg-white card w-100" style="margin-left:13vw;margin-right:20vw;margin-top:30px;">
                                <div class="d-flex align-items-center w-100">
                                    <div style="width: 60px;">
                                        <img class="m-2 rounded-circle" src="../images/<?= $userDetail['image'] ?>" style="object-fit:cover" alt="" width="50px" height="50px">
                                    </div>
                                    <a href="../views/userInfoPosts.php?id=<?= $post_result['following'] ?>" class="h3 pl-4 text-dark"><?= $userDetail['username']; ?></a>

                                    <?php
                                    if ($_SESSION['user_id'] == $userDetail['id']) {
                                    ?>
                                        <div class="text-right w-100 mr-5">
                                            <a href="../actions/editPostSelect.php?id=<?= $post_result['id'] ?>" class="btn btn-outline-info lead text-right" name="edit" style="white-space:nowrap"><i class="fas fa-pen"></i></a>
                                        </div>
                                        <div class="text-right mr-4" style="right:0;width:10%;">
                                            <a href="../actions/deletePost.php?id=<?= $post_result['id'] ?>" class="btn btn-outline-danger lead text-right" name="delete" style="white-space:nowrap"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--think about only text -->
                                <?php
                                if ($post_result['image'] == null) {
                                ?>
                                    <img src="" alt=" " class="d-none" width="100%" height="100%">
                                <?php
                                } else { ?>
                                    <img src="../images/<?= $post_result['image'] ?>" alt=" " width="100%" height="100%">
                                <?php } ?>
                                <hr style="margin: 0;">
                                <p class="pl-5 pr-5 pt-3 pb-3 lead" style="font-size: 20px;margin:0;"><?= $post_result['content'] ?></p>
                                <hr style="margin:0;">
                                <p class="text-left m-0 ml-3 lead" style="font-size: 14px;"><?= $post_result['time']  ?></p>
                            </div>

                    <?php }
                    } ?>
                </div>
            </div>

            <!-- post_buttom -->
            <div style="z-index: 999;right:6%;bottom:10%;" class="position-fixed">
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
    <script src="../script/modal/openmodal.js"></script>
    <!-- <script>
        const screen = document.getElementById('content');
        // スワイプ／フリック
        screen.addEventListener('touchmove', logSwipe);
        // タッチ開始
        screen.addEventListener('touchstart', logSwipeStart);
        // タッチ終了
        screen.addEventListener('touchend', logSwipeEnd);

        function logSwipeStart(event) {
            event.preventDefault();
            startX = event.touches[0].pageX;
            console.log(startX);
        }

        function logSwipe(event) {
            event.preventDefault();
            endX = event.touches[0].pageX;
            console.log(endX);
        }

        function logSwipeEnd(event) {
            event.preventDefault();
            if (0 < (endX - startX)) {
                console.log("右向き");
                if (document.getElementsByClassName('pot-btn').classList.contains('invisible')) {} else { //invisibleがなかったら追加
                    document.getElementsByClassName('post-btn')[0].classList.add('invisible');
                    console.log(document.getElementsByClassName('post-btn')[0].classList);
                }
            } else {
                console.log("左向き");
                if (document.getElementsByClassName('post-btn').classList.contains('invisible')) {
                    document.getElementsByClassName('post-btn')[0].classList.remove('invisible');
                }
            }
        }
    </script> -->
    <script>
        let count = 0;
        const countUp = () => {
            let now = new Date;
            let dtf = now.getFullYear().toString() + "/" + (now.getMonth() + 1).toString() + "/" + +now.getDate().toString() + "  " + now.getHours().toString() + ":" + now.getMinutes().toString() + ":" + now.getSeconds().toString();
            console.log(dtf);
        }
        setInterval(countUp, 1000);
    </script>

</body>

</html>