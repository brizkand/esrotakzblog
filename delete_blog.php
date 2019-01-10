<?php
    session_start();
    $sessionID = $_SESSION['accessID'];
    if($_SESSION['loginAccess'] != true){
        header("Location: destroy_session.php");
    }
    else{
        if(isset($_GET['id'])){
            include_once('conn.php');
            $data = $_GET['id'];
            $sql= "delete from posts where id = '".$data."' ";
            if($conn->query($sql)===true){
                header("Location: dashboard.php");
            }
            else{
                header("Location: dashboard.php");
            }
        }
    } 
?>