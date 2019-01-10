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
                    <li class="nav-item active">
                        <a class="nav-link" href="about_us.php">Who we are?</a>
                        <span class="sr-only">(current)</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blogs.php">Blogs</a>
                    </li>
                </ul>
                <?php
                    if(!empty($_SESSION['loginAccess'])){
                        if($_SESSION['loginAccess']!= true){
                            ?>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="register.php">Register</a>
                                    </li>
    
                                </ul>
                            <?php
                        }
                        else{
                        ?>
                            <ul class="navbar-nav ml-auto">
                                <!--<li class="nav-item">
                                    <a class="nav-link waves-effect waves-light">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </li>-->
                                <li class="nav-item avatar dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <?php
                                            include_once('conn.php');
                                            $sql="select profile from users where id='".$_SESSION["accessID"]."'";
                                            $result = $conn->query($sql);
                                            if($result->num_rows > 0){
                                                $row = $result->fetch_assoc();
                                                ?>
                                                <img src="/storage/profile/<?php echo $row['profile'];?>" class="rounded-circle z-depth-0" alt="avatar image">
                                                    <i class="fa fa-caret-down" style="font-size:24px"></i>
                                                <?php
                                            }
                                        ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="dashboard.php"><i style="font-size:14px;" class="fa fa-dashboard mr-2" aria-hidden="true"></i>Dashboard</a>
                                        <a class="dropdown-item" href="account_setting.php"><i style="font-size:14px;" class="fa fa-cog mr-2" aria-hidden="true"></i>Account Settings</a>
                                        <a class="dropdown-item" href="destroy_session.php"><i style="font-size:14px;" class="fa fa-sign-out mr-2" aria-hidden="true"></i>Logout</a>
                                    </div>
                                </li>
                            </ul>
                        <?php
                        }
                    }
                    else{
                        ?>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="register.php">Register</a>
                                </li>
                            </ul>
                        <?php
                    }
                    ?>
                <!-- Links -->
            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->

    </header>

    <main>
                    
        <div class="container">
            <!-- Section: Team v.4 -->
            <section class="my-5">

                <!-- Section heading -->
                <h2 class="h1-responsive font-weight-bold text-center my-5 wow animated bounceInUp">ESROTAKZ</h2>
                <!-- Section description -->
                <p class="grey-text text-center w-responsive mx-auto mb-5">We are Esrotakz, group from Pooc Balayan Batangas.</p>

                <!-- Grid row -->
                <div class="row">

                    <?php
                        include_once("conn.php");
                        $sql = "select * from about_us";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                ?>
                                    <!-- Grid column -->
                                    <div class="col-sm-4 mb-4 wow animate rollIn slow">

                                        <!-- Rotating card -->
                                        <div class="card-wrapper">
                                        <div id="card-<?php echo $row['id'];?>" class="card-rotating effect__click text-center w-100 h-100">
                                            <!-- Front Side -->
                                            <div class="face front">
                                            <!-- Image -->
                                            <div class="card-up">
                                                <img class="card-img-top" src="storage/esrotakz_images/<?php echo $row['cover'];?>" alt="Esrotakz cover image">
                                            </div>
                                            <!-- Avatar -->
                                            <div class="avatar mx-auto white wow animated flip slower">
                                                <img src="storage/esrotakz_images/<?php echo $row['profile'];?>" class="rounded-circle img-fluid" alt="Profile image">
                                            </div>
                                            <!-- Content -->
                                            <div class="card-body">
                                                <h4 class="font-weight-bold mt-1 mb-3"><?php echo $row['name'];?></h4>
                                                <p class="font-weight-bold dark-grey-text"><?php echo $row['nickname'];?></p>
                                                <!-- Triggering button -->
                                                <a class="rotate-btn grey-text" data-card="card-<?php echo $row['id'];?>">
                                                <i class="fa fa-repeat grey-text"></i> Click here to rotate</a>
                                            </div>
                                            </div>
                                            <!-- Front Side -->
                                            <!-- Back Side -->
                                            <div class="face back">
                                            <!-- Content -->
                                            <div class="card-body">
                                                <!-- Content -->
                                                <h4 class="font-weight-bold mt-4 mb-2">
                                                <strong>About me</strong>
                                                </h4>
                                                <hr>
                                                <p><?php echo $row['about'];?></p>
                                                <hr>
                                                <!-- Social Icons -->
                                                <ul class="list-inline list-unstyled">
                                                <li class="list-inline-item">
                                                    <a class="p-2 fa-lg fb-ic">
                                                    <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="p-2 fa-lg pin-ic">
                                                        <i class="fa fa-pinterest"> </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="p-2 fa-lg ins-ic">
                                                        <i class="fa fa-instagram"> </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="p-2 fa-lg tw-ic">
                                                        <i class="fa fa-twitter"> </i>
                                                    </a>
                                                </li>
                                                </ul>
                                                <!-- Triggering button -->
                                                <a class="rotate-btn grey-text" data-card="card-<?php echo $row['id'];?>">
                                                <i class="fa fa-repeat grey-text"></i> Click here to rotate back</a>
                                            </div>
                                            </div>
                                            <!-- Back Side -->
                                        </div>
                                        </div>
                                        <!-- Rotating card -->

                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <!-- Grid row -->

            </section>
            <!-- Section: Team v.4 -->
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