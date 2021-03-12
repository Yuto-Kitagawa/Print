<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css4.6/bootstrap.css">
    <title>Login</title>
    <style class="invisible">
        body {
            background-image: url("../../images/background.jpg");
            background-size: cover;
        }

        .font {
            font-family: "Showcard Gothic";
            font-size: 40px;
        }
    </style>
</head>

<body>

    <div style="background-color:rgba(0,0,0,0.5);">
        <div style="height:100vh;">
            <div class="row h-100 m-0">
                <!-- navigation-bar -->
                <nav class="navbar navbar-dark bg-dark w-100" style="height: 9%;">
                    <a href="#.php" class="navbar-brand pt-0 mt-0 text-start">
                        <p class="my-auto font h4">Print</p>
                    </a>
                </nav>


                <div class="card w-25 my-auto mx-auto d-table">
                    <div class="card-header bg-white border-0">
                        <h1 class="text-center h1 font">Print
                        </h1>
                    </div>
                    <div class="card-body">
                        <form action="../actions/login.php" method="POST">
                            <input type="text" name="email" placeholder="EMAIL" class="form-control mb-3" required autofocus>
                            <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-5">
                            <button class="btn btn-check rounded-pill btn-outline-secondary btn-block">Log in</button>
                        </form>
                        <hr>
                        <p class=" btn-outline-light btn mx-auto card w-50 text-center mt-3 "><a href="createUser.php">Create Account</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
<script src="../../script/bootstrap.bundle.js"></script>


</html>