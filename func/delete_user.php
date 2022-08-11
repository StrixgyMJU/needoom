<?php
require('../sql/connect.php');
session_start();
if(!isset($_SESSION["my_name"]["id"])){
  header('Location:login.php');

}else if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
    
    if($_GET && isset($_GET['user_id'])){

        $user_id = $_GET['user_id'];

          $sql_delete = 'DELETE FROM acc_user WHERE user_id = '. $user_id;
          if($conn->query($sql_delete) === TRUE){
            $message = "ทำการลบข้อมูลสำเร็จ";
            echo "<script> alert('$message'); window.location='../admin.php'; </script>";
            
          }else{
            $message = "เกิดข้อผิดพลาดโปรดลองใหม่อีกครั้ง";
            echo "<script> alert('$message'); window.location='../admin.php'; </script>";
            
          }
      }

    }

?>