<?php
session_start();
include "../classes/user.php";
include "../classes/follow.php";

$user_list = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css4.6/bootstrap.css">
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
    <title>Document</title>
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
            <a href="home.php" class="navbar-brand pt-0 mt-0 ">
                <p class="my-auto font h4 pl-2">Print</p>
            </a>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li style="cursor: pointer;" class="nav-item openModal pt-2 text-white pr-4 "><?= $_SESSION['username'] ?></li>
                    <li class="nav-item"><a href="../actions/logout.php" class="btn btn-outline-warning btn-sm nav-link text-warning">Log Out</a></li>
                </ul>
            </div>
        </nav>

        <div class="m-0 border-top w-100 h-100">
            <div class="bg-dark text-center py-2" style="height:10%;">
                <form class="h-100" action="" method="GET">
                    <input type="search" name="search_name" style="padding-left:10px;border-radius:40px;background-color:rgba(100, 100, 100,0.3); outline:none;" class="h-100 text-white border-0 w-50" placeholder="SEARCH USERNAME">
                </form>
            </div>


            <div class="h-100 text-center col-lg-9 col-md-12 mx-auto">
                <div class="col-lg-9 col-md-12  h-25 mx-auto">
                    <?php
                    if (isset($_GET['search_name']) && $_GET['search_name'] != "") { //get mthod
                        $username = $_GET['search_name'];
                        $user = new User;
                        $user_list = $user->searchUser($username); //array user info

                        while ($user_detail = $user_list->fetch_assoc()) {
                            if ($_SESSION['user_id'] == $user_detail['id']) {
                                continue;
                            }
                    ?>
                            <div class="h3 col-lg-9 col-md-12 bg-white m-3 mx-auto pr-0" style="white-space: nowrap;">
                                <div class="d-flex col-lg-9 col-md-12 pl-3">
                                    <div class="w-50 h-100">
                                        <img class="p-3" style="border-radius: 50%;display:inline-block;" src="../images/<?= $user_detail['image'] ?>" alt="icon" width="90px" height="90px">
                                    </div>
                                    <a href="../views/userinfo.php?id=<?= $user_detail['id'] ?>" class="pt-2 text-dark text-decoration-none ml-2 mr-4 w-25">
                                        <?= $user_detail['username'] ?>
                                        <p class="text-dark mt-3" style="font-weight: 100;font-size:20px">
                                            <?= $user_detail['first_name'] . "  " . $user_detail['last_name'] ?>
                                        </p>
                                    </a>
                                    <br>
                                    <?php
                                    $follow = new Follow;
                                    $checkfollow_array = $follow->checkFollow($_SESSION['user_id'], $user_detail['id']);
                                    if ($checkfollow_array->num_rows > 0) {
                                    ?>
                                        <a href="../actions/unfollow.php?id=<?= $user_detail['id'] ?>" class="btn btn-outline-danger m-4 ml-lg-5">
                                            UNFOLLOW
                                        </a>
                                    <?php
                                    } else {

                                    ?>
                                        <a href="../actions/follow.php?id=<?= $user_detail['id'] ?>" class="btn btn-outline-info m-4 text-right ml-lg-5">
                                            FOLLOW
                                        </a>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        <?php }
                    } else {
                        ?>
                        <div class="text-center align-items-center h2 mt-5 font">
                            SEARCH NAME
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>


</body>

</html>