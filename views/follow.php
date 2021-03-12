<?php
session_start();
include "../classes/user.php";

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

        <div class="d-flex m-0 border-top w-100" style="height:90%;">
            <div class="w-25">
                <div class="bg-dark h-100 w-100">
                    <div class="text-center py-2" style="height:10%;">
                        <form class="h-100" action="" method="GET">

                            <input type="text" name="search_name" style="padding-left:10px;border-radius:40px;background-color:rgba(100, 100, 100,0.3); outline:none;" class="h-100 text-white border-0" placeholder="SEARCH USERNAME">

                        </form>
                    </div>
                </div>
            </div>
            <div class="h-100 text-center w-75">
                <div class="w-75 m-3 h-25 mx-auto">
                    <?php
                    if (isset($_GET['search_name']) && $_GET['search_name'] != "") {
                        $username = $_GET['search_name'];
                        $user = new User;
                        $user_list = $user->searchUser($username);

                        while ($user = $user_list->fetch_assoc()) {
                            if ($_SESSION['user_id'] == $user['id']) {
                                continue;
                            }
                    ?>
                            <div class="h3 w-100 bg-white m-3" style="white-space: nowrap;">
                                <div class="d-flex w-100">
                                    <div class=" w-25 h-100"><img class="p-3" style="border-radius: 50%;display:inline-block;" src="../images/<?= $user['image'] ?>" alt="icon" width="90px" height="90px"></div>
                                    <a href="" class="pt-2 text-dark  text-decoration-none ml-2 mr-4"><?= $user['username'] ?><p class="h5 text-dark"><?= $user['first_name'] . "  " . $user['last_name'] ?></p></a><br>
                                    <a href="../actions/follow.php?id=<?= $user['id'] ?>" id="follow" class="btn btn-outline-info m-4">
                                        FOLLOW
                                    </a>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>

    </div>

    <script>
        const idbtn = document.getElementById('follow');
        idbtn.addEventListener('click', function() {
            idbtn.classList.toggle('btn-outline-info');
            idbtn.classList.toggle('btn-outline-danger');
            idbtn.textContent = "UNFOLLOW";

        })
    </script>

</body>

</html>