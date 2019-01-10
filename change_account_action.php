<?php
    session_start();
    $sessionID = $_SESSION['accessID'];
    if($_SESSION['loginAccess'] != true){
        header("Location: destroy_session.php");
    }
    else{
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['uploadProfile'])){
                include_once "conn.php";
                $id = $_POST['id'];
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
                    header('Location: account_setting.php');
                }
                else{
                    if(in_array($fileActualExt, $format)){
                        if($fileError === 0){
                            if($fileSize < 3000000){
                                $fileNewName = uniqid('', true) . "." . $fileActualExt;
                                $fileDestination = "storage/profile/" . $fileNewName;
                                move_uploaded_file($fileTempName, $fileDestination);
    
                                $sql="update users set profile='$fileNewName' where id='$id'";
                                if($conn->query($sql) === TRUE){
                                    header('Location: account_setting.php');
                                }
                                else{
                                    header('Location: account_setting.php');
                                }    
                            }
                            else{
                                ?>
                                <script>
                                    alert("The file you upload is too big");
                                    window.location.href='account_setting.php';
                                </script>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <script>
                                alert("Error occured uploading this file!");
                                window.location.href='account_setting.php';
                            </script>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <script>
                            alert("This file type you upload is not valid! Only jpg, jpeg and png file are allowed.");
                            window.location.href='account_setting.php';
                        </script>
                        <?php
                    }
                }
            }
            if(isset($_POST['uploadCover'])){
                include_once "conn.php";
                $id = $_POST['id'];
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
                    header('Location: account_setting.php');
                }
                else{
                    if(in_array($fileActualExt, $format)){
                        if($fileError === 0){
                            if($fileSize < 3000000){
                                $fileNewName = uniqid('', true) . "." . $fileActualExt;
                                $fileDestination = "storage/profile/" . $fileNewName;
                                move_uploaded_file($fileTempName, $fileDestination);
    
                                $sql="update users set cover='$fileNewName' where id='$id'";
                                if($conn->query($sql) === TRUE){
                                    header('Location: account_setting.php');
                                }
                                else{
                                    header('Location: account_setting.php');
                                }    
                            }
                            else{
                                ?>
                                <script>
                                    alert("The file you upload is too big");
                                    window.location.href='account_setting.php';
                                </script>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <script>
                                alert("Error occured uploading this file!");
                                window.location.href='account_setting.php';
                            </script>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <script>
                            alert("This file type you upload is not valid! Only jpg, jpeg and png file are allowed.");
                            window.location.href='account_setting.php';
                        </script>
                        <?php
                    }
                }
            }
            if(isset($_POST['editInfo'])){
                include_once('conn.php');
                $firstNameVal = mysqli_real_escape_string($conn,(test_input($_POST['infoFirstName'])));
                $lastNameVal = mysqli_real_escape_string($conn,(test_input($_POST['infoLastName'])));
                $emailVal = mysqli_real_escape_string($conn,(test_input($_POST['infoEmail'])));
                $sql = "update users set first_name='".$firstNameVal."', last_name = '".$lastNameVal."', email = '".$emailVal."' where id = '".$_POST['infoID']."' ";
                if($conn->query($sql)=== true){
                    header("Location: account_setting.php");
                }
            }
            if(isset($_POST['editPassword'])){
                include_once('conn.php');
                $oldPassword = mysqli_real_escape_string($conn, (test_input($_POST['oldPassword'])));
                $password = mysqli_real_escape_string($conn, (test_input($_POST['password'])));
                $rePassword = mysqli_real_escape_string($conn, (test_input($_POST['rePassword'])));
                
                $sqlSelectId ="select password from users where id='".$_POST['id']."' ";
                $result = $conn->query($sqlSelectId);
                if($result->num_rows > 0){
                    $row=$result->fetch_assoc();
                    if((md5($oldPassword))==$row['password']){
                        if(strlen($password) >= 8 || strlen($rePassword) >= 8){
                            if($password === $rePassword){
                                $passwordEnc = md5($password);
                                $sqlPasswordUpdate = "update users set password = '".$passwordEnc."' where id = '".$_POST['id']."'";
                                if($conn->query($sqlPasswordUpdate) === true){
                                    ?>
                                    <script>
                                        alert('Password change!');
                                        window.location.href = 'account_setting.php';
                                    </script>
                                    <?php
                                }
                                else{
                                    ?>
                                    <script>
                                        alert('Theres a problem in changing your password! Plese try again later.');
                                        window.location.href = 'account_setting.php';
                                    </script>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <script>
                                    alert('Password mismatched!');
                                    window.location.href = 'account_setting.php';
                                </script>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <script>
                                alert('Please type atleast 8 characters for password');
                                window.location.href = 'account_setting.php';
                            </script>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <script>
                            alert('Your old password is wrong!');
                            window.location.href = 'account_setting.php';
                        </script>
                        <?php
                    }
                }
            }
            if(isset($_POST['editUsername'])){
                include_once('conn.php');
                $username = mysqli_real_escape_string($conn ,(test_input($_POST['username'])));
                $sql="update users set username='".$username."' where id = '".$_POST['id']."' ";
                if($conn->query($sql)=== true){
                    ?>
                    <script>
                        alert('Username successfully updated');
                        window.location.href='account_setting.php';
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert('Theres a problem in changing username. Please try again later');
                        window.location.href='account_setting.php';
                    </script>
                    <?php
                }
            }
        }
        ///////////////////////////////////////////////////////////////////////////////
        if(isset($_POST['changeProfile'])){
            ?>
            <!-- Form -->
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center md-form" style="color: #757575;">
                <input type="hidden" name='id' value='<?php echo $_POST['changeProfile'];?>'>
                <div class="file-field">
                    <div class="btn blue-gradient float-left">
                        <span><i class="fa fa-cloud-upload mr-2" aria-hidden="true"></i>Choose file</span>
                        <input type="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Select profile">
                    </div>
                </div>
    
                <!-- Create Blog Button -->
                <button name="uploadProfile" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-upload mr-2" aria-hidden="true"></i>Upload</button>
            </form>
            <!-- Form -->
            <?php    
        }
        if(isset($_POST['changeCover'])){
            ?>
            <!-- Form -->
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center md-form" style="color: #757575;">
                <input type="hidden" name='id' value='<?php echo $_POST['changeCover'];?>'>
                <div class="file-field">
                    <div class="btn blue-gradient float-left">
                        <span><i class="fa fa-cloud-upload mr-2" aria-hidden="true"></i>Choose file</span>
                        <input type="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Select cover photo">
                    </div>
                </div>
    
                <!-- Create Blog Button -->
                <button name="uploadCover" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-upload mr-2" aria-hidden="true"></i>Upload</button>
            </form>
            <!-- Form -->
            <?php
        }
        if(isset($_POST['personalInfo'])){
            include_once('conn.php');
            $sqlInfo = "select id, first_name, last_name, email from users where id ='".$_POST['personalInfo']."' ";
            $result = $conn->query($sqlInfo);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                ?>
                <!-- Form -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center" style="color: #757575;">
                    <input name='infoID' type="hidden" value='<?php echo $row['id'];?>'>
                    <div class="form-row">
                        <div class="col">
                            <!-- First name -->
                            <div class="md-form">
                                <input value="<?php echo $row['first_name']?>" name="infoFirstName" type="text" id="materialRegisterFormFirstName" class="form-control" required>
                                <label class='active' for="materialRegisterFormFirstName">First name</label>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Last name -->
                            <div class="md-form">
                                <input value="<?php echo $row['last_name']?>" name="infoLastName" type="text" id="materialRegisterFormLastName" class="form-control" required>
                                <label class='active' for="materialRegisterFormLastName">Last name</label>
                            </div>
                        </div>
                    </div>

                    <!-- E-mail -->
                    <div class="md-form mt-0">
                        <input value="<?php echo $row['email']?>" name="infoEmail" type="email" id="materialRegisterFormEmail" class="form-control" required>
                        <label class='active' for="materialRegisterFormEmail">E-mail</label>
                    </div>
                    <button name="editInfo" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-edit mr-2" aria-hidden="true"></i>Update Info</button>
                </form>
                <!-- Form -->
                <?php
            }
        }
        if(isset($_POST['passwordInfo'])){
            ?>
            <!-- Form -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center" style="color: #757575;">
                <input type="hidden" name='id' value='<?php echo $_POST['passwordInfo'];?>'>
                <!--Old Password -->
                <div class="md-form">
                    <input name="oldPassword" type="password" id="materialRegisterFormOldPassword" class="form-control" aria-describedby="materialRegisterFormOldPasswordHelpBlock" required>
                    <label for="materialRegisterFormPassword">Old Password</label>
                </div>

                <!--New Password -->
                <div class="md-form">
                    <input name="password" type="password" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                    <label for="materialRegisterFormPassword">New Password</label>
                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                        At least 8 characters
                    </small>
                </div>

                <!-- New Re-type Password -->
                <div class="md-form">
                    <input name="rePassword" type="password" id="materialRegisterFormRePassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
                    <label for="materialRegisterFormPassword">Re-type New Password</label>
                    <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                        Make sure your passwords match!
                    </small>
                </div>
                <button name="editPassword" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-edit mr-2" aria-hidden="true"></i>Change</button>

            </form>
            <!-- Form -->
            <?php
        }
        if(isset($_POST['usernameInfo'])){
            include_once('conn.php');
            $sql = "select id, username from users where id='".$_POST['usernameInfo']."' ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                ?>
                <!-- Form -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="text-center" style="color: #757575;">
                    <input name='id' type="hidden" value='<?php echo $row['id']; ?>'>
                    <!--Username-->
                    <div class="md-form">
                        <input value='<?php echo $row['username'];?>' name="username" type="text" id="materialRegisterFormUserName" class="form-control" required>
                        <label class='active' for="materialRegisterFormLastName">Username</label>
                    </div>
                    <button name="editUsername" class="btn btn-info btn-rounded my-4 waves-effect z-depth-0" type="submit"><i style="font-size:14px;" class="fa fa-edit mr-2" aria-hidden="true"></i>Change</button>
                </form>
                <!-- Form -->
                <?php
            }
        }
    }
?>