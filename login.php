<?php 
    session_start();
?>
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
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['login'])){
            include_once('conn.php');
            $loginUserName = mysqli_real_escape_string($conn, (test_input($_POST['username'])));
            $loginPassword = md5(mysqli_real_escape_string($conn, (test_input($_POST['password']))));
            $sql = "select * from users where username = '".$loginUserName."' and password = '".$loginPassword."' ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $_SESSION['accessID'] = $row['id'];
                $_SESSION['accessLastName'] = $row['last_name'];
                $_SESSION['accessFirstName'] = $row['first_name'];
                $_SESSION['accessEmail'] = $row['email'];
                $_SESSION['accessProfile'] = $row['profile'];
                $_SESSION['accessUsername'] = $row['username'];
                $_SESSION['accessPassword'] = $row['password'];
                $_SESSION['loginAccess'] = true;
                $_SESSION['welcome'] = 1;
                header("Location: /dashboard.php");
            }
            else{
                $pass_err = "Your password or username is not correct!";
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
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login</a>
                        <span class="sr-only">(current)</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register
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
                <div class="col-sm-12">
                    <!-- Material form login -->
                    <div class="card m-4 wow animated fadeInDown">

                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Sign in</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center" style="color: #757575;">

                                <!-- Username -->
                                <div class="md-form">
                                    <input name="username" type="text" id="materialLoginFormUserName" class="form-control" required>
                                    <label for="materialLoginFormUserName">Username</label>
                                </div>

                                <!-- Password -->
                                <div class="md-form">
                                    <input name="password" type="password" id="materialLoginFormPassword" class="form-control" required>
                                    <label for="materialLoginFormPassword">Password</label>
                                </div>

                                <div class="d-flex justify-content-around">
                                    <div>
                                        <!-- Remember me -->
                                        <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                        <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                                        </div>
                                    </div>
                                <div>
                                <!-- Forgot password -->
                                <a href="">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Sign in button -->
                        <button name="login" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                        <!-- Register -->
                        <p>Not a member?
                            <a href="register.php">Register</a>
                        </p>

                        <!-- Social login -->
                        <p>Please visit our social page:</p>
                        <a type="button" class="btn-floating btn-fb btn-sm">
                        <i class="fa fa-facebook"></i>
                        </a>
                    </form>
                    <!-- Form -->

                    </div>

                    </div>
                    <!-- Material form login -->
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
        <!-- Modal FOR ERROR-->
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Failed to Login</h5>
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