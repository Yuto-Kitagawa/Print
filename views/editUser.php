<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <link rel="stylesheet" href="../css4.6/modal/modal.css">
    <title>Edit User</title>
</head>
<style>
    #icon {
        display: none;
    }

    .font {
        font-family: "Showcard Gothic";
        font-size: 40px;
    }
</style>

<body>
    <div class="row h-100 m-0 ">
        <!-- navigation-bar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark w-100 " style="height: 9%;">
            <a href="home.php" class="navbar-brand pt-0 mt-0 ">
                <p class="my-auto font h4">Print</p>
            </a>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item"><a href="../views/profile.php" class="nav-link openmodal">USERNAME: </a></li> -->
                    <li type="button" class="nav-item pt-2 text-white mr-4"><?= $_SESSION['username'] ?></li>
                    <li class="nav-item"><a href="../actions/logout.php" class="btn btn-outline-warning btn-sm nav-link text-warning">Log Out</a></li>
                </ul>
            </div>
        </nav>
        <div class="pt-5 col-lg-6 col-md-9 mx-auto ">
            <p class="text-center h2 font">Edit Your Profile</p>
            <div class="card">
                <div class="card-content p-5">
                    <form action="../actions/editUser.php" method="POST" enctype="multipart/form-data">
                        <div class="w-75 alert alert-danger d-none mx-auto">The Email address is already taken.</div>

                        <div class="h3">Your FirstName: <input class="w-100 " name="editfirstname" type="text" value="<?= $_SESSION['first_name'] ?>" required></div>
                        <hr>
                        <div class="h3">Your LastName: <input class="w-100" name="editlastname" type="text" value="<?= $_SESSION['last_name'] ?>" required></div>
                        <hr>
                        <div class="h3">User Name: <input class="w-100" name="editusername" type="text" value="<?= $_SESSION['username'] ?>" required></div>
                        <hr>
                        <div class="h3">Email: <input class="w-100" name="editemail" type="text" value="<?= $_SESSION['email'] ?>" required></div>
                        <hr>
                        <div>
                            <input type="file" name="editicon" id="icon" accept=".jpg,jpeg,png" class="file_input w-100 btn btn-outline-warning text-warning">
                            <label style="margin:0;" for="icon" id="icon_label" class="file_input w-100 btn btn-outline-warning text-left bg-warning text-white ">SELECT ICON</label>
                            <label style="margin:0;white-space:nowrap;user-select:none;" class=" w-100 mb-1 text-right text-danger d-block">※You can set it up later</label>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-check rounded-pill btn-outline-secondary btn-block mt-4">Save Changes</button>
                    </form>
                </div>
                <div class="card-content mb-5 mt-5 pr-5 pl-5">
                    <a class="btn btn-check rounded-pill btn-outline-danger btn-block openModal">Delete My Account</a>
                </div>

                <!-- Modal -->
                <div class="popup js-popup">
                    <div class="popup-inner" style="max-width: 800px;">
                        <div class="close-btn js-close-btn"><i class="fas fa-times"></i></div>
                        <div class="h3 text-center" style="white-space:nowrap;">Are you sure you want to delete your account?</div>
                        <div class="pt-4 text-center">
                            <!-- <button class="rounded-circle border-0 bg-info text-white p-4 mr-3 mt-1 openSecondModal">Info</button> -->
                            <a href="../actions/remove.php" class="border-0 bg-danger text-white p-3 mr-3 mt-1 openSecondModal">Delete</a>
                            <a href="editUser.php" class="border-0 bg-secondary text-white mt-1 p-3 me-4 mr-3">Cancel</a>
                        </div>
                    </div>
                    <div class="black-background js-black-bg"></div><!-- background -->
                </div>

            </div>
        </div>


    </div>
    <script src="../../script/modal/openmodal.js"></script>
    <script>
        //change text with icon
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
</body>

</html>