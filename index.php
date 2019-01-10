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
</head>

<body>
    <!-- Start your project here-->
    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade " data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-2" data-slide-to="1"></li>
        <li data-target="#carousel-example-2" data-slide-to="2"></li>
        <li data-target="#carousel-example-2" data-slide-to="3"></li>
        <li data-target="#carousel-example-2" data-slide-to="4"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="view">
                <img class="d-block w-100" src="storage/carousel/carousel1.png" alt="First slide">
                <div class="mask rgba-blue-light"></div>
            </div>
            <!--<div class="carousel-caption">
                <h1 class="p-2 rounded wow animated fadeInUpBig text-primary font-weight-bold">Complete 14</h1>
                <p class="bg-info p-2 rounded lead wow animated fadeInDownBig text-light">This is the only picture that the troop is complete. Hopefully this is
                not the last and we're waiting to this moment to happen again.</p>
            </div>-->
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="storage/carousel/carousel2.png" alt="Second slide">
                <div class="mask rgba-black-strong"></div>
            </div>
            <!--<div class="carousel-caption">
                <h3 class="h3-responsive">Strong mask</h3>
                <p>Secondary text</p>
            </div>-->
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="storage/carousel/carousel3.png" alt="Third slide">
                <div class="mask rgba-black-slight"></div>
            </div>
            <!--<div class="carousel-caption">
                <h3 class="h3-responsive">Slight mask</h3>
                <p>Third text</p>
            </div>-->
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="storage/carousel/carousel4.png" alt="Fourth slide">
                <div class="mask rgba-green-slight"></div>
            </div>
            <!--<div class="carousel-caption">
                <h3 class="h3-responsive">Slight mask</h3>
                <p>Third text</p>
            </div>-->
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="storage/carousel/carousel5.png" alt="Fifth slide">
                <div class="mask rgba-red-slight"></div>
            </div>
            <!--<div class="carousel-caption">
                <h3 class="h3-responsive">Slight mask</h3>
                <p>Third text</p>
            </div>-->
        </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon p-5" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon p-5" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->

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
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">Who we are?</a>
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

    <!--Main Navigation-->
    <!-- Main layout -->
    <main>

    <div class="view jarallax" style="height: 100vh;">
        <img class="jarallax-img" src="storage/parallax/parallax1.png" alt="Parallax 1">
        <div class="mask rgba-blue-slight">
        <div class="container flex-center text-center">
            <div class="row mt-5">
            <div class="col-md-12 wow fadeIn mb-3">
                <h1 class="display-3 mb-2 wow animated fadeInDownBig text-light">ESROTAKZ <a class="indigo-text font-weight-bold">BLOG</a></h1>
                <h5 class="text-uppercase mb-3 mt-1 font-weight-bold wow text-secondary animated zoomIn" data-wow-delay=".5s">This is a blog site of ezrotaks from Pooc Balayan Batangas</h5>
                <?php
                    if(empty($_SESSION['loginAccess'])){
                        ?>
                        <a href="login.php" class="btn btn-light-blue btn-lg wow animated fadeInLeft" data-wow-delay="1s">LOGIN</a> <a href="register.php" class="btn btn-indigo btn-lg wow animated fadeInRight" data-wow-delay="1s">REGISTER</a>        
                        <?php
                    }
                ?>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="container">

        <!--Grid row-->
        <div class="row mb-4 pb-4">

            <!--Grid column-->
            <div class="col-md-12 text-center">

                <h2 class="h1 font-weight-bold light-blue-text my-5 py-4 wow animated rollIn">Esrotakz <del class="text-danger">Friendship </del><mark>Brotherhood</mark></h2>
                <p align="justify" class="wow animated bounceInUp" data-wow-delay="0.5s">When your best friends are more like your brothers, the friendship you share reaches a whole different level. 
                Women often have their gal pals; the one’s that can finish off each other’s sentences and know each other’s favorite foods, movies 
                and activities. Well, men have the same relationship with some of their closest friends. 
                We have what we call, “a bro code” or “brotherly bond” and in most cases we act more like 
                blood brothers than just good buddies. These friends last a lifetime.</p>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>

    <!--<div class="view jarallax">
        <img class="jarallax-img" src="http://mdbootstrap.com/img/Photos/Others/nature4.jpg" alt="">
    </div>-->
    <div class="view jarallax" style="height: 100vh;">
        <img class="jarallax-img" src="storage/parallax/parallax2.png" alt="Parallax 1">
        <div class="mask pattern-4 flex-center">
        <div class="container flex-center text-center">
            <div class="row mt-5">
            <div class="col-md-12 wow fadeIn mb-3">
                <h1 class="display-3 mb-2 wow animated zoomInDown slow text-primary" >True Friends Never Die</h1>
                <p align="justify" class="text-white wow animated zoomInUp slow" >Two things you will never have to chase: True friends & true love.” “True friends are those who came into your life, saw the most negative part of you, but are not ready to leave you, no matter how contagious you are to them.”</p>
            </div>
            </div>
        </div>
        </div>
    </div>


    </main>
    <!-- Main layout -->


<!--Footer-->
<footer class="footer">
<?php
    include_once("footer.php");
?>
</footer>
<!--Footer--> 
<!-- /Start your project here-->



    <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="mdb_hack/js/jquery-3.3.1.min.js"></script>
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