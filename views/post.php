<?php
include "../classes/post.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>Document</title>
</head>
<style>
    .font {
        font-family: "Showcard Gothic";
        font-size: 40px;
    }

    .backover {
        background-color: rgba(0, 0, 0, 0.03);

    }
</style>

<body>
    <div id="content" class=" m-0" style="height:100vh;background-color: rgba(0,0,0,0.03);">
        <!-- navigation-bar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark w-100" style="height: 10%;padding-right:-30px;">
            <a href="home.php" class="navbar-brand pt-0 mt-0 ">
                <p class="my-auto font h4 pl-2">Print</p>
            </a>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item"><a href="../views/profile.php" class="nav-link openmodal">USERNAME: </a></li> -->
                    <li style="cursor: pointer;" class="nav-item openModal pt-2 text-white pr-4"><?= $_SESSION['username'] ?></li>
                    <li class="nav-item"><a href="../actions/logout.php" class="btn btn-outline-warning btn-sm nav-link text-warning">Log Out</a></li>
                </ul>
            </div>
        </nav>


        <!-- パソコンがmd -->
        <form action="../actions/post.php" method="POST" enctype="multipart/form-data">
            <div class="card w-50 mx-auto mt-5">

                <!-- picture label -->
                <div class="w-100 pt-5 pb-5 text-center">
                    <input type="file" id="post_image" name="post_image" class="d-none">
                    <label for="post_image" id="post_image_label" class="btn btn-outline-success " name="image_text">SELECT IMAGE</label>
                </div>

                <!-- textarea -->
                <div class="card h-25 mx-auto col-md-6 col-9 mb-3 d-none" id="content-wrapper">
                    <textarea placeholder="text" style="overflow: hidden;resize:none;outline:none;" class="border-0" name="post_content" id="post_content" maxlength="255" cols="30" maxlength="255" rows="6"></textarea>
                </div>

            </div>
            <div class="mx-auto text-center mb-5">
                <button type="button" class="btn btn-outline-success mt-5" id="next">NEXT</button>
                <button type="submit" class=" btn btn-outline-success d-none mt-5" id="submit">POST</button>
            </div>
        </form>
    </div>

    <script>
        let count = 0;
        const countUp = () => {
            let now = new Date;
            let dtf = now.getFullYear().toString() + "/" + (now.getMonth() + 1).toString() + "/" + +now.getDate().toString() + "  " + now.getHours().toString() + ":" + now.getMinutes().toString() + ":" + now.getSeconds().toString();
            // console.log(dtf);
        }
        setInterval(countUp, 1000);
    </script>

    <script>
        var next = document.getElementById('next');
        next.addEventListener('click', function() {
            var content = document.getElementById('content-wrapper');
            var submit = document.getElementById('submit');
            content.classList.remove('d-none');
            submit.classList.remove('d-none');
            next.classList.add('d-none')
        });
    </script>

    <script>
        var label_text = document.getElementById('post_image_label'); //select image
        var image = document.getElementById('post_image');
        image.addEventListener('change', function() {
            //change label text
            label_text.textContent = image.value;
        });
    </script>
</body>

</html>