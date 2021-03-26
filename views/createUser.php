<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>Creating account</title>
</head>
<style>
    body {
        background-image: url(../images/background2.jpg);
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.1);
    }

    .font {
        font-family: "Showcard Gothic";
        font-size: 40px;
    }
</style>

<body>
    <div>
        <div style="height:100vh;">
            <div class="row h-100 m-0">
                <!-- navigation-bar -->
                <nav class="navbar navbar-dark bg-dark w-100" style="height: 9%;">
                    <a href="index.php" class="navbar-brand pt-0 mt-0 text-start">
                        <p class="my-auto font h4">Print</p>
                    </a>
                </nav>


                <div class="card w-25 my-auto mx-auto d-table">
                    <div class="card-header bg-white border-0 pb-2 pt-2">
                        <h1 class="text-center h1 font " style="white-space:nowrap;">Create account
                        </h1>
                    </div>
                    <div class="card-body text-center">
                        <div class="w-75 alert alert-danger d-none mx-auto">Diffrent Password</div>
                        <div class="w-75 alert alert-danger d-none mx-auto">The Email address is already taken.</div>

                        <form action="../actions/createUser.php" method="POST" enctype="multipart/form-data">
                            <!-- fullname -->
                            <div class="d-flex">
                                <!-- <input type="text" name="fullname" placeholder="YOURNAME" class="form-control mb-3" required autofocus> -->
                                <input type="text" name="first_name" maxlength="50" placeholder="YOUR FIRSTNAME" class="form-control mb-3 mr-1" minlength="1" required autofocus>
                                <input type="text" name="last_name" maxlength="50" placeholder="YOUR LASTNAME" class="form-control mb-3 ml-1" minlength="1" required>
                            </div>
                            <!-- username -->
                            <input type="text" name="username" maxlength="50" placeholder="USERNAME" class="form-control mb-3" minlength="1" required>
                            <!-- icon -->
                            <input type="file" name="icon" id="icon" accept=".jpg,jpeg,png" class="d-none file_input w-100 btn btn-outline-warning text-warning">
                            <label style="margin:0;" for="icon" id="icon_label" class="file_input w-100 btn btn-outline-warning text-left bg-warning text-white ">SELECT ICON</label>
                            <label style="margin:0;white-space:nowrap;" class=" w-100 mb-1 text-right text-danger d-block">※You can set it up later.</label>
                            <!-- email  -->
                            <input type="email" name="email" placeholder="EMAIL" class="form-control mb-3" minlength="3" required>
                            <!-- password -->
                            <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-3" minlength="8" required>
                            <!-- It compare password.Also If it match, password inserted into database. -->
                            <input type="password" name="password_second" placeholder="INPUT PASSWORD ONE MORE PLEASE" class="form-control mb-3" minlength="8" required>

                            <button type="submit" class="btn btn-check rounded-pill btn-outline-secondary btn-block mt-5">Create</button>
                        </form>
                        <hr>
                        <a href="index.php" type="button" class="btn btn-outline-secondary bg-secondary text-white">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../script/modal/closemodal.js"></script>
    <script src="../../script/modal/expandmodal.js"></script>
    <script src="../../script/modal/openmodal.js"></script>
    <script>
        var label_text = document.getElementById('icon_label');
        // inputのid取得
        var icon = document.getElementById('icon');

        console.log("labeltext.text: " + label_text.textContent);
        console.log("icon.value: " + icon.value);
        icon.addEventListener('change', function() {
            console.log("after icon.value:" + icon.value);
            icon.value.replace("/C:\\fakepath\\/g", " ");
            label_text.textContent = icon.value;
            console.log("after labeltext.value: " + label_text.textContent);
            console.log("after icon.value: " + icon.value);

        })
    </script>
    <?php
    if (isset($_GET['err']) && $_GET['err'] == 1) {
        echo "<script> const alertClass = document.getElementsByClassName('alert');
                 alertClass[0].classList.remove('d-none');
                 </script>";
    } ?>
    <?php
    if (isset($_GET['err']) && $_GET['err'] == 2) {
        echo "<script> const alertClass = document.getElementsByClassName('alert');
                 alertClass[1].classList.remove('d-none');
                 </script>";
    } ?>
    <script src="../script/bootstrap.bundle.js"></script>
</body>

</html>