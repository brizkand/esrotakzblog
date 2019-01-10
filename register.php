<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="/storage/logo/esrotakz_logo.png" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="author" content="Kevin Holgado">
    <title>Welcome to EZROTAKS Blog</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="mdb_hack/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="mdb_hack/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) 
    <link href="mdb_hack/css/style.css" rel="stylesheet">-->
    <style>
        .stickyTop{        
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1;
        }
    </style>
     <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="mdb_hack/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(isset($_POST["createUser"])){
                include_once("conn.php");
                $firstNameVal = mysqli_real_escape_string($conn,(test_input($_POST['firstName'])));
                $lastNameVal = mysqli_real_escape_string($conn,(test_input($_POST['lastName'])));
                $emailVal = mysqli_real_escape_string($conn,(test_input($_POST['email'])));
                $usernameVal = mysqli_real_escape_string($conn,(test_input($_POST['username'])));
                $passwordVal = mysqli_real_escape_string($conn,(test_input($_POST['password'])));
                $rePasswordVal = mysqli_real_escape_string($conn,(test_input($_POST['rePassword'])));
                $secretCodeVal = mysqli_real_escape_string($conn,(test_input($_POST['secretCode'])));
                if(strlen($passwordVal) <= 7 || strlen($rePasswordVal) <= 7){
                    $pass_err = "Please type atlease 8 characters for password";
                    ?>
                        <script>
                        $(document).ready(function(){
                            $("#errorModal").modal("show");
                        });
                        </script>
                           
                    <?php

                }
                else{
                    if($passwordVal != $rePasswordVal){
                        $pass_err = "Password mismatch!";
                        ?>
                        <script>
                        $(document).ready(function(){
                            $("#errorModal").modal("show");
                        });
                        </script>
                        <?php
                    }
                    else{
                        if(md5($secretCodeVal) != "c3f761977385892838ea3072b5c4563b"){
                            $pass_err = "Secret code is wrong!";
                            ?>
                                <script>
                                    $(document).ready(function(){
                                        $("#errorModal").modal("show");
                                    });
                                </script>   
                            <?php
                        }
                        else{
                            $encPass = md5($passwordVal);
                            $sql = "insert into users(first_name, last_name, email, username, password) values
                            ('$firstNameVal', '$lastNameVal', '$emailVal', '$usernameVal', '$encPass')";
                            if($conn->query($sql)===TRUE){
                                $accountSuccess = "Account successfully created!";
                            ?>
                                <script>
                                    $(document).ready(function(){
                                        $("#successModal").modal("show");
                                    });
                                </script>   
                            <?php    
                            }
                            else{
                                $pass_err = $conn->error;
                            ?>
                                <script>
                                    $(document).ready(function(){
                                        $("#errorModal").modal("show");
                                    });
                                </script>   
                            <?php
                            }
                        }
                    }
                }
            }
        }
    ?>
    <!-- Start your project here-->
    <!--Main Navigation-->
    <header class="stickyTop">
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark purple-gradient scrolling-navbar">

            <!-- Navbar brand -->
            <a class="navbar-brand animated flip slower infinite" href="#">
                <img class="circle" src="/storage/logo/esrotakz_logo.png" alt="Esrotakz Logo" style="width:40px;">
            </a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
            aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">
                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">Who we are?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blogs.php">Blogs</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="register.php">Register
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>

                </ul>
                <!-- Links -->
            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->

    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="card m-4 wow animated fadeInLeft">
                        <div class="card-body">
                            <h2 class="card-title text-primary">Please signup to create blog!</h2>
                            <p class="card-text">
                                In able to create account you must know the secret code.
                                After creating account you can create, edit and delete blogs.
                            </p>
                            <p class="card-text text-warning">
                                All fields are required to create account.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- Material form register -->
                    <div class="card m-4 animated fadeInRight">
                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Register</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center" style="color: #757575;">

                                <div class="form-row">
                                    <div class="col">
                                        <!-- First name -->
                                        <div class="md-form">
                                            <input name="firstName" type="text" id="materialRegisterFormFirstName" class="form-control" required>
                                            <label for="materialRegisterFormFirstName">First name</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Last name -->
                                        <div class="md-form">
                                            <input name="lastName" type="text" id="materialRegisterFormLastName" class="form-control" required>
                                            <label for="materialRegisterFormLastName">Last name</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- E-mail -->
                                <div class="md-form mt-0">
                                    <input name="email" type="email" id="materialRegisterFormEmail" class="form-control" required>
                                    <label for="materialRegisterFormEmail">E-mail</label>
                                </div>

                                <!--Username-->
                                <div class="md-form">
                                    <input name="username" type="text" id="materialRegisterFormUserName" class="form-control" required>
                                    <label for="materialRegisterFormLastName">Username</label>
                                </div>

                                <!--Password -->
                                <div class="md-form">
                                    <input name="password" type="password" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                                    <label for="materialRegisterFormPassword">Password</label>
                                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                        At least 8 characters
                                    </small>
                                </div>

                                <!-- Re-type Password -->
                                <div class="md-form">
                                    <input name="rePassword" type="password" id="materialRegisterFormRePassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                                    <label for="materialRegisterFormPassword">Re-type Password</label>
                                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                        Make sure your passwords match!
                                    </small>
                                </div>

                                <!-- Secret Password -->
                                <div class="md-form">
                                    <input name="secretCode" type="password" id="materialRegisterFormSecretCode" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                                    <label for="materialRegisterFormPassword">Secret Code</label>
                                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                        Authorized person only knows the secret code
                                    </small>
                                </div>
                                <!-- Sign up button -->
                                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="createUser">Sign up</button>
                                
                                <!-- Register -->
                                <p>Already have account?
                                    <a href="login.php">Sign in</a>
                                </p>

                                <hr>
                                <!-- Social register -->
                                <p>Please visit our other social page:</p>

                                <a type="button" class="btn-floating btn-fb btn-sm">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </form>
                            <!-- Form -->

                        </div>

                    </div>
                    <!-- Material form register -->
                </div>
            </div>
        </div>


        <!-- Modal FOR ERROR-->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Failed to Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $pass_err; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal FOR SUCCESS-->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Successful to Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $accountSuccess; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
<!--Footer-->
<footer class="footer">
<?php
    include_once("footer.php");
?>
</footer>
<!--Footer--> 
<!-- /Start your project here-->

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="mdb_hack/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="mdb_hack/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="mdb_hack/js/mdb.min.js"></script>

   

        <script>
            // object-fit polyfill run
            objectFitImages();

            /* init Jarallax */
            jarallax(document.querySelectorAll('.jarallax'));

            jarallax(document.querySelectorAll('.jarallax-keep-img'), {
                keepImg: true,
            });
        </script>
        <script>
            new WOW().init();
        </script>
        
</body>

</html>