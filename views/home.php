<?php
session_start();
include "../classes/user.php";
include "../classes/follow.php";

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
</style>

<body>
    <div id="content" class="row m-0" style="height:100vh;background-color: rgba(0,0,0,0.03);">
        <!-- navigation-bar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark w-100" style="height: 10%;padding-right:-30px;">
            <a href="#" class="navbar-brand pt-0 mt-0 ">
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
                    <button class="rounded-circle border-0 bg-info text-white p-4 mr-3  openSecondModal">Info</button>
                    <a href="editUser.php" class="rounded-circle border-0 bg-danger text-white p-4 me-4 mr-3">Edit</a>
                </div>
            </div>
            <div class="black-background js-black-bg"></div><!-- background -->
        </div>

        <!-- modal2 -->
        <div class="popup js-secondPopup">
            <div class="popup-inner text-center">
                <div class="close-btn js-close-btn"><i class="fas fa-times"></i></div>
                <div class="d-flex">
                    <div class=" rounded-circle h-25 w-25"><img src="../images/<?= $_SESSION['icon'] ?>" alt="Icon"></div>
                    <div class="h3 m-auto"><?= $_SESSION['username'] ?></div>
                </div>
                <hr>
                <div class="h3 m-auto" style="margin-top:0;">FullName: <?= $_SESSION['first_name'] ?><?= $_SESSION['last_name'] ?></div>
                <hr>
                <div class="h3">YourEmail: <?= $_SESSION['email'] ?></div>


            </div>
            <div class="black-background js-black-bg"></div>
        </div>

        <!-- bottom of the page  -->
        <div class="w-100 pt-5 h-100 content" style="height: 90%;">
            <div class="w-75 card　mt-5 mx-auto ">
                <div class="card-content ">
                    <div class="post bg-white">
                        <?php
                        //First, search following account 
                        $folllow = new Follow;
                        $id = $_SESSION['user_id'];
                        $following = $follow->getFollowingUser($id); //followingにfollowしてる人のidが格納
                        //Second, search a post database which has a post about the user
                        print_r($following);

                        ?>
                    </div>
                </div>
            </div>


            <!-- post_buttom -->
            <div style="z-index: 999;right:10%;bottom:10%;" class="position-fixed">
                <a href="post.php" style="background-color: sienna; height:62px;" class="btn border-0 text-white rounded-circle p-4 post"><i class="fas fa-plus"></i></a>
            </div>


        </div>



    </div>

    <script src="../../script/modal/openmodal.js"></script>
    <script src="../../script/modal/expandmodal.js"></script>
    <script>
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
    </script>
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