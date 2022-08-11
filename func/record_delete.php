<?php
require('../sql/connect.php');
session_start();
if(!isset($_SESSION["my_name"]["id"])){
  header('Location:login.php');

}else if(isset($_SESSION["my_name"]["id"])){
  $user_id = $_SESSION["my_name"]["id"];

  if(isset($_SERVER["HTTP_REFERER"])){
    $token = $_SERVER['HTTP_REFERER'];
    }
    
    if($_GET && isset($_GET['record_id'])){

        $record_id = $_GET['record_id'];
        // echo $wallet_id;
          $sql_delete = 'DELETE FROM acc_record WHERE record_id = '. $record_id;
          if($conn->query($sql_delete) === TRUE){
            $message = "ทำการลบข้อมูลสำเร็จ";
            echo "<script> alert('$message'); window.location='".$token."'; </script>";
            
          }else{
            $message = "เกิดข้อผิดพลาดโปรดลองใหม่อีกครั้ง";
            echo "<script> alert('$message'); window.location='".$token."'; </script>";
            
          }
      }

    }

?>