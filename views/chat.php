<?php
include "../classes/chat.php";
include "../classes/user.php";
session_start();
$id = $_GET['id'];
$user = new User;
$user_detail = $user->getUser($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
    <title>Chat</title>
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
        background-color: white;
        transition: 0.6s color;
        will-change: color;
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

<body style="overflow:hidden">
    <div id="content" class="row m-0" style="height:100%;background-color: rgba(0,0,0,0.03);">
        <!-- navigation-bar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark w-100 fixed-top" style="height: 10%;padding-right:-30px;z-index:9999">
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
    </div>

    <!-- leftside of the page -->
    <div class="card font fixed-top" style="height: 100vh; width: 280px;padding-top:68px;">
        <a href="../views/userInfoPosts.php?id=<?= $_SESSION['user_id'] ?>">
            <button style="font-size: 22px; ">
                Your Posts
                <div class="button-background button-background-start"></div>
                <div class="button-background button-background-end"></div>
            </button>
        </a>
        <a href="../views/editUser.php">
            <button style="font-size: 22px;">
                Edit Your Profile
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
    <!-- center -->
    <div style="height: 90vh;margin-left:20vw;margin-top:6%;overflow:hidden">
        <div class="h4 pl-4 ml-4">
            <?= $user_detail['username'] ?>
        </div>
        <div class="card mr-5 ml-5 mb-3 p-4">
            <div class="w-100" id="chatbox" style="height: 60vh;overflow:auto">
                <?php
                $chat = new Chat;
                $messages_array = $chat->getMessage($_SESSION['user_id'], $id);
                while ($message = $messages_array->fetch_assoc()) {
                    if ($message['user_id'] == $_SESSION['user_id']) {
                ?>
                        <p class="p-2 ml-auto" style="background-color: rgb(132,0,  255); border-radius:22px;width:fit-content;right:0;color:white;"><?= $message['text']; ?></p>
                    <?php
                    } else {
                    ?>
                        <p class=" border-1 p-2" style="background-color: rgba(0,0,0,0.2);border-radius:22px;width:auto;width:fit-content;"><?= $message['text']; ?></p>
                <?php
                    }
                }
                ?>
            </div>
            <hr>
            <div class=" bottom-0 d-flex" style="height: 1.4em;">
                <form action="../actions/sendMessage.php?id=<?= $id ?>" class="w-100" method="POST">
                    <input class="w-75 border-0 pl-4" style="outline: none;" placeholder="Message" type="text" name="text" id="chat" minlength="1" required>
                    <button style="color:black !important; border:1px black solid;border-radius:8px; height:2em;width:15%">Send message</button>
                </form>
            </div>
        </div>

    </div>
    <script>
        const chatbox = document.getElementById('chatbox');
        chat_height = chatbox.scrollHeight - chatbox.clientHeight;
        chatbox.scroll(0, chat_height);
    </script>

    <script src="../script/bootstrap.bundle.js"></script>
</body>

</html>