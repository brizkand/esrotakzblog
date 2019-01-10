<?php
    session_start();
    $sessionID = $_SESSION['accessID'];
    if($_SESSION['loginAccess'] != true){
        header("Location: destroy_session.php");
    }
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
        .shadow-textarea textarea.form-control::placeholder {
            font-weight: 300;
        }
        .shadow-textarea textarea.form-control {
            padding-left: 0.8rem;
        }
        #coverImage{
            height: auto;
            width: 100%;
        }
        .profile{
            position: absolute;
            top: 8px;
            left: 16px;
        }
        .changeCover{
            position: absolute;
            bottom: 80px;
            left: 0;
        }
    </style>
     <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="mdb_hack/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <header class="stickyTop">
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
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <h2 class="h1-responsive font-weight-bold text-center my-5 wow animated bounceInUp">Account Settings</h2>
                <?php 
                    include_once('conn.php');
                    $sql="select * from users where id = '$sessionID' limit 1";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        ?>
                        <div class='card wow animated tada slow'>
                            <img id='coverImage' src="storage/profile/<?php echo $row['cover'];?>" alt="Cover Image">
                            <!--Zoom effect-->
                            <div id='<?php echo $row['id'];?>' class="profile view overlay zoom avatar mx-auto p-2 wow animated swing slow">
                                <img style='width: 25%' src="storage/profile/<?php echo $row['profile'];?>" class="float-left rounded-circle z-depth-1" alt="zoom">
                                <div id='changeProfile' style='width: 27%' class="mask rgba-black-light flex-center waves-effect waves-light">
                                    <p class="text-light text-center">Change profile</p>
                                </div>
                            </div>
                            <button class='lead changeCover btn bg-transparent btn p-2 wow animated slideInRight slow' id='<?php echo $row['id'];?>'><strong>Change Cover Photo</strong></button>
                            <h4 class='card-title p-1 text-center wow animated slow zoomIn'><strong><?php echo strToUpper($row['first_name'] . ' ' . $row['last_name']);?></strong></h4>
                            <small class='p-1 card-footer text-center text-primary wow animated zoomIn slow'><strong><?php echo $row['email'];?></strong></small>
                        </div>
                        <button id='<?php echo $row['id'];?>' class='personalInfoButton btn btn-info btn-sm mb-5 float-left  animated zoomInRight delay-3s px-1 py-40'><i style="font-size:14px;" class='fa fa-info-circle mr-1'></i>Change Personal Info</button>
                        <button id='<?php echo $row['id'];?>' class='passwordButton btn btn-warning btn-sm mb-5 float-right  animated zoomInLeft delay-3s px-1 py-40'><i style="font-size:14px;" class='fa fa-lock mr-1'></i>Change Password</button>
                        <button id='<?php echo $row['id'];?>' class='usernameButton btn btn-warning btn-sm mb-5 float-right  animated zoomInLeft delay-3s px-1 py-40'><i style="font-size:14px;" class='fa fa-lock mr-1'></i>Change Username</button>
                        <hr class='mb-5'>
                        <?php
                    }
                ?>
        </div>

        <!-- Modal FOR Profile-->
        <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Select your new profile picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='profileBody'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal FOR Cover-->
        <div class="modal fade" id="coverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Select your new cover photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='coverBody'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal FOR PERSONAL iNFO-->
        <div class="modal fade" id="personalInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change your information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='personalInfoBody'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal FOR Password-->
        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change your password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='passwordBody'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal FOR USERNAME-->
        <div class="modal fade" id="usernameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change your username</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='usernameBody'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
        <!--<script>
            $(document).ready(function(){
                $("#modalDel").modal("show");
            });
        </script>-->
        <script>
            $(document).ready(function(){
                $('.profile').click(function(){
                    var changeProfile = $(this).attr('id');
                    $.ajax({
                        url:'change_account_action.php',
                        method: 'post',
                        data:{changeProfile:changeProfile},
                        success: function(data){
                            $('#profileBody').html(data);
                            $('#profileModal').modal('show');
                        }
                    });
                });
                $('.changeCover').click(function(){
                    var changeCover = $(this).attr('id');
                    $.ajax({
                        url:'change_account_action.php',
                        method: 'post',
                        data:{changeCover:changeCover},
                        success: function(data){
                            $('#coverBody').html(data);
                            $('#coverModal').modal('show');
                        }
                    });
                });
                $('.personalInfoButton').click(function(){
                    var personalInfo = $(this).attr('id');
                    $.ajax({
                        url:'change_account_action.php',
                        method: 'post',
                        data:{personalInfo:personalInfo},
                        success: function(data){
                            $('#personalInfoBody').html(data);
                            $('#personalInfoModal').modal('show');
                        }
                    });
                });
                $('.passwordButton').click(function(){
                    var passwordInfo = $(this).attr('id');
                    $.ajax({
                        url : 'change_account_action.php',
                        method: 'post',
                        data : {passwordInfo:passwordInfo},
                        success: function(data){
                            $('#passwordBody').html(data);
                            $('#passwordModal').modal('show');
                        }
                    });
                });
                $('.usernameButton').click(function(){
                    var usernameInfo = $(this).attr('id');
                    $.ajax({
                        url: 'change_account_action.php',
                        method: 'post',
                        data: {usernameInfo:usernameInfo},
                        success: function(data){
                            $('#usernameBody').html(data);
                            $('#usernameModal').modal('show');
                        }
                    });
                });
            });
            
        </script>
        
</body>

</html>