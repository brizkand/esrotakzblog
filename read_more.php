<?php
    if(isset($_POST['blogID'])){
        
                    include_once("conn.php");
                    $sql = "select posts.id, posts.title, posts.body, posts.created_at, posts.updated_at, posts.image, users.first_name, users.last_name, users.profile
                        from posts inner join users on posts.user_id = users.id where posts.id = '".$_POST['blogID']."'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            ?>
                            <!-- Grid row -->
                            <div class="row mb-2 wow animated tada slow">

                                <!-- Grid column -->
                                <div class="col-sm-12">

                                    <!-- Featured image -->
                                    <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4 p-4">
                                        <img class="img-fluid" src="storage/blog/<?php echo $row['image'];?>" alt="Blog image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h3 class="font-weight-bold m-4"><strong><?php echo $row['title'];?></strong></h3>
                                    <p class="m-4"><?php echo $row['body'];?></p>
                                    <div class="mdb-feed">
                                        <div class="news">
                                            <div class="label">
                                                <img src="storage/profile/<?php echo $row['profile'];?>" class="rounded-circle z-depth-1-half">
                                            </div>
                                            <div class="excerpt">
                                                <div class="brief">
                                                    <a class="name"><?php echo $row['first_name'] . " " . $row['last_name'];?></a>
                                                    <br><span><strong>Created at: </strong><?php echo $row['created_at'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        <?php   
                        }
                    }
    }
?>