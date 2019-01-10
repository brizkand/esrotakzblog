<?php
    session_start();
    $sessionID = $_SESSION['accessID'];
    if($_SESSION['loginAccess'] != true){
        header("Location: destroy_session.php");
    }
    else{
        if(isset($_POST['dataDel'])){
            include_once('conn.php');
            $data = $_POST['dataDel'];
            $sql="select * from posts where id = '".$data."' limit 1";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                    ?>
                        <div class="card">
                            <img class="card-img-top" style='width: 200px' src="storage/blog/<?php echo $row['image'];?>" alt="Image to Delete">
                            <div class="card-image-overlay p-4">
                                <h5 class='card-title'><?php echo $row['title'];?></h5>
                                <p class='card-text'><?php echo $row['body'];?></p>
                                <small class='mb-5'><?php echo $row['created_at'];?></small><br>
                                <a href="delete_blog.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Yes</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    <?php
            }
        }
        if(isset($_POST['dataEdit'])){
            include_once('conn.php');
            $data = $_POST['dataEdit'];
            $sql = "select * from posts where id='".$data."' limit 1 ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                ?>
                <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center md-form" style="color: #757575;">
                    <input type="hidden" value='<?php echo $row['id'];?>' name='id'>
                    <div class="md-form">
                        <p><strong>Title:</strong></p>
                        <input value='<?php echo $row['title'];?>' name="title" type="text" id="materialLoginFormTitle" class="form-control" required>
                    </div>
                    <div class="form-group shadow-textarea">
                        <p><strong>Body:</strong></p>
                        <textarea required name="body" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="5" placeholder="Write something here..."><?php echo $row['body'];?></textarea>
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
                    <button name="updateBlog" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-edit mr-2" aria-hidden="true"></i>Update</button>
                </form>
                <?php
            }
        }
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['updateBlog'])){
            include_once "conn.php";
            $id = $_POST['id'];
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
                $sql = "update posts set title='$titleVal', body='$bodyVal' where id = '$id'";
                $conn->query($sql);
                header('Location: dashboard.php');
            }
            else{
                if(in_array($fileActualExt, $format)){
                    if($fileError === 0){
                        if($fileSize < 300000){
                            $fileNewName = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = "storage/blog/" . $fileNewName;
                            move_uploaded_file($fileTempName, $fileDestination);
    
                            //$sql = "insert into posts(title, body, user_id, image) values('$titleVal', '$bodyVal', '$sessionID', '$fileNewName')";
                            $sql="update posts set title='$titleVal', body='$bodyVal', image='$fileNewName' where id='$id'";
                            if($conn->query($sql) === TRUE){
                                header('Location: dashboard.php');
                            }
                            else{
                                header('Location: dashboard.php');
                            }    
                        }
                        else{
                            ?>
                            <script>
                                alert("The file you upload is too big");
                                window.location.href='dashboard.php';
                            </script>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <script>
                            alert("Error occured uploading this file!");
                            window.location.href='dashboard.php';
                        </script>
                        <?php
                    }
                }
                else{
                    ?>
                    <script>
                        alert("This file type you upload is not valid! Only jpg, jpeg and png file are allowed.");
                        window.location.href='dashboard.php';
                    </script>
                    <?php
                }
            }
        }
    }
?>