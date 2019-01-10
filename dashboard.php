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
    </style>
     <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="mdb_hack/js/jquery-3.3.1.min.js"></script>
</head>

<body>
<?php
    if($_SESSION['welcome']==1){
        $_SESSION['welcome'] = 0;
        ?>
        <script>
            $(document).ready(function(){
                $('#welcome').modal('show');
            });
        </script>
        <?php
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['uploadBlog'])){
            include_once "conn.php";
            $titleVal = mysqli_real_escape_string($conn, (test_input($_POST['title'])));
            $bodyVal = mysqli_real_escape_string($conn, (test_input($_POST['body'])));
            $file = $_FILES['file'];
                            
            //print_r ($file);

		    $fileName = $file['name'];
		    $fileTempName = $file['tmp_name'];
		    $fileError = $file['error'];
		    $fileSize = $file['size'];
            $fileType = $file['type'];
            
            $fileExt = explode('.', $fileName);
            //echo "<br>";
            //print_r ($fileExt);
            $fileActualExt = strtolower(end($fileExt));
            $format = array('jpg', 'jpeg', 'png');

            if(empty($fileName)){
                $sql = "insert into posts(title, body, user_id) values('$titleVal', '$bodyVal', '$sessionID')";
                if($conn->query($sql) === TRUE){
                    $blogUploadSuccess = "Successfully created a blog!";
                ?>
                    <script>
                        $(document).ready(function(){
                            $("#successModal").modal("show");
                        });
                    </script>
                <?php
                }
                else{
                    $blogUploadError = $conn->connect_error;
                    ?>
                    <script>
                        $(document).ready(function(){
                            $("#errorModal").modal("show");
                        });
                    </script>
                    <?php
                }
            }
            else{
                if(in_array($fileActualExt, $format)){
                    if($fileError === 0){
                        if($fileSize < 3000000){
                            $fileNewName = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = "storage/blog/" . $fileNewName;
                            move_uploaded_file($fileTempName, $fileDestination);
    
                            $sql = "insert into posts(title, body, user_id, image) values('$titleVal', '$bodyVal', '$sessionID', '$fileNewName')";
                            if($conn->query($sql) === TRUE){
                                $blogUploadSuccess = "Successfully created a blog!";
                                ?>
                                <script>
                                    $(document).ready(function(){
                                        $("#successModal").modal("show");
                                    });
                                </script>
                                <?php
                            }
                            else{
                                $blogUploadError = $conn->connect_error;
                                ?>
                                <script>
                                    $(document).ready(function(){
                                        $("#errorModal").modal("show");
                                    });
                                </script>
                                <?php
                            }    
                        }
                        else{
                            $blogUploadError = "The file you upload is too big";
                            ?>
                            <script>
                                $(document).ready(function(){
                                    $("#errorModal").modal("show");
                                });
                            </script>
                            <?php
                        }
                    }
                    else{
                        $blogUploadError = "Error occured uploading this file!";
                        ?>
                        <script>
                            $(document).ready(function(){
                                $("#errorModal").modal("show");
                            });
                        </script>
                        <?php
                    }
                }
                else{
                    $blogUploadError = "This file type you upload is not valid! Only jpg, jpeg and png file are allowed.";
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
                <!--<ul class="navbar-nav ml-auto">-->
                    <!-- Dropdown -->
                    <!--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                            <a class="dropdown-item" href="account_setting.php">Account Setting</a>
                            <a class="dropdown-item" href="/">Logout</a>
                        </div>
                    </li>

                </ul>-->
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
                <!-- Links -->
            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->

    </header>

    <main>
        <div class="container">
            <h2 class="h1-responsive font-weight-bold text-center my-5 wow animated bounceInUp">Dashboard</h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card m-4 wow animated fadeInLeft">
                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Create Blog</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center md-form" style="color: #757575;">

                                <!-- Title -->
                                <div class="md-form">
                                    <input name="title" type="text" id="materialLoginFormTitle" class="form-control" required>
                                    <label for="materialLoginFormUserName">Title</label>
                                </div>

                                <!-- Body -->
                                <div class="form-group shadow-textarea">
                                    <textarea required name="body" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="5" placeholder="Write something here..."></textarea>
                                </div>

                                <div class="file-field">
                                    <div class="btn blue-gradient float-left">
                                        <span><i class="fa fa-cloud-upload mr-2" aria-hidden="true"></i>Choose file</span>
                                        <input type="file" name="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Upload your image">
                                    </div>
                                </div>

                                <!-- Create Blog Button -->
                                <button name="uploadBlog" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-upload mr-2" aria-hidden="true"></i>Upload Blog</button>
                            </form>
                            <!-- Form -->
                        </div>
                    </div>
                    <!-- Material form login -->
                </div>

                <div class="col-sm-6">
                    <div class="card m-4 wow animated fadeInRight"> 
                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Your Blogs</strong>
                        </h5>
                        <div class="card-body">
                            <?php
                                include_once "conn.php";
                                $sql ="select * from posts where user_id = '$sessionID' order by id desc";
                                $result= $conn->query($sql);
                                if($result->num_rows > 0){
                                    echo "
                                        <table id='dtBasicExample' class='table table-responsive table-striped table-bordered table-sm' cellspacing='0' width='100%'>
                                            <thead>
                                                <tr>
                                                    <th colspan='2' class='text-center'>Actions</th>
                                                    <th>Title</th>
                                                    <th>Body</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ";
                                    while($row= $result->fetch_assoc()){
                                        ?>
                                        <tr>
                                            <td><button id='<?php echo $row["id"];?>' class="blogEdit btn btn-sm rounded btn-primary" style="font-size:9px;"><i style="font-size:18px;" class="fa fa-edit" aria-hidden="true"></i></button></td>
                                            <td><button id='<?php echo $row["id"];?>' class="blogDelete btn btn-sm rounded btn-danger" style="font-size:9px;"><i style="font-size:18px;" class="fa fa-trash" aria-hidden="true"></i></button></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['body']; ?></td>
                                            <td><img src="storage/blog/<?php echo $row['image']; ?>" class="rounded z-depth-0" alt="blog image" height="25px"></td>
                                        </tr>
                                        <?php
                                    }
                                    echo "
                                        </tbody>
                                        </table>
                                    ";
                                }
                                else{
                                    echo "<p class='card-text text-danger lead'><strong>You don't have blog created! Please create blog.</strong></p>";
                                }
                            ?>                   
                        </div>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Successful</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $blogUploadSuccess; ?>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Failed to create blog!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $blogUploadError; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal FOR SUCCESS login-->
        <div class="modal fade" id="welcome" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Welcome</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo "Welcome " . $_SESSION['accessFirstName'] . " " . $_SESSION['accessLastName'] . " to Esrotakz Blog!";?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Modal for deleting blog-->
        <div class='modal fade' id='modalDel' tabindex='1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header bg-danger text-warning'>
                        <h5 class='modal-title'><strong>Are you sure you want to delete this blog?</strong></h5>
                        <button type='button' class='close' data-dismiss="modal" aria-label='close'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class='modal-body' id='deleteBody'>
                        <!--DISPLAY THE DATA THAT WILL DELETE!-->
                    </div>
                </div>
            </div>
        </div>

        <!--Modal for Editing blog-->
        <div class='modal fade' id='modalEdit' tabindex='1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header bg-primary text-light'>
                        <h5 class='modal-title'><strong>Are you sure you want to update this data?</strong></h5>
                        <button type='button' class='close' data-dismiss="modal" aria-label='close'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class='modal-body' id='editBody'>
                        <!--DISPLAY THE DATA THAT WILL DELETE!-->
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
                $('.blogDelete').click(function(){
                    var dataDel = $(this).attr('id');
                    $.ajax({
                        url: 'blog_action.php',
                        method: 'post',
                        data:{dataDel:dataDel},
                        success:function(data){
                            $('#deleteBody').html(data);
                            $('#modalDel').modal('show');
                        }
                    });
                });
                $('.blogEdit').click(function(){
                    var dataEdit = $(this).attr('id');
                    $.ajax({
                        url : 'blog_action.php',
                        method : 'post',
                        data:{dataEdit:dataEdit},
                        success:function(data){
                            $('#editBody').html(data);
                            $('#modalEdit').modal('show');
                        }
                    });
                });
            });
            
        </script>
        
</body>

</html>