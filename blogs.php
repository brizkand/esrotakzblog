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
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">Who we are?</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="blogs.php">Blogs</a>
                        <span class="sr-only">(current)</span>
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

            <!-- Section: Blog v.1 -->
            <section class="my-5">

                <!-- Section heading -->
                <h2 class="h1-responsive font-weight-bold text-center my-5 wow animated bounceInUp">Recent posts</h2>
                <!-- Section description -->
                <p class="text-center w-responsive mx-auto mb-5 wow animated bounceInDown">These are all the stories shared. Read other blogs to know the story behind the picture.</p>
                <?php
                    include_once("conn.php");
                    $sql = "select posts.id, posts.title, posts.body, posts.created_at, posts.updated_at, posts.image, users.first_name, users.last_name, users.profile
                        from posts inner join users on posts.user_id = users.id order by posts.id desc";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            ?>
                            <!-- Grid row -->
                            <div class="row mb-2 wow animated zoomIn slow">

                                <!-- Grid column -->
                                <div class="col-sm-5">

                                    <!-- Featured image -->
                                    <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                                        <img class="img-fluid" src="storage/blog/<?php echo $row['image'];?>" alt="Blog image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-7">
                                    <!-- Post title -->
                                    <h3 class="font-weight-bold mb-4"><strong><?php echo $row['title'];?></strong></h3>
                                    <!-- Excerpt -->
                                    <!--<p><?php echo $row['body'];?></p>-->
                                    <!-- Post data -->
                                    <!--<p>by <a><strong><?php echo $row['first_name'];?> </strong></a><?php echo $row['created_at'];?></p>-->
                                    
                                    <div class="mdb-feed mb-4">
                                        <div class="news">
                                            <!-- Label -->
                                            <div class="label">
                                                <img src="storage/profile/<?php echo $row['profile'];?>" class="rounded-circle z-depth-1-half">
                                            </div>
                                            <!-- Excerpt -->
                                            <div class="excerpt">
                                                <!-- Brief -->
                                                <div class="brief">
                                                    <a class="name"><?php echo $row['first_name'] . " " . $row['last_name'];?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Feed footer -->
                                        <div class="feed-footer">
                                        <a class="like">
                                            <span><strong>Created at: </strong><?php echo $row['created_at'];?></span>
                                        </a>
                                        </div>
                                    </div>
                                    
                                        <a class="readMore btn btn-success btn-md" id="<?php echo $row['id'];?>"><i style="font-size:14px;" class="fa fa-eye mr-2" aria-hidden="true"></i>Read more</a>    
                                </div>
                            </div>
                            <hr class="mb-5">
                            <?php   
                        }
                    }
                ?>

            </section>
        </div>


        <!-- Modal Read More-->
        <div class="modal fade" id="blogReadMore" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">Read what's behind in this story</h5>
                        <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="blogReadMoreBody">
                        <!--In this division display the data when user click read more . Display using jquery ajax-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
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
        <script>
            $(document).ready(function(){
                $('.readMore').click(function(){
                    var blogID = $(this).attr('id');
                    $.ajax({
                        url:'read_more.php',
                        method: 'post',
                        data:{blogID:blogID},
                        success:function(data){
                            $('#blogReadMoreBody').html(data);
                            $('#blogReadMore').modal('show');
                        }
                    })
                });
            });
        </script>
</body>

</html>