<?php
require('../sql/connect.php');
session_start();
if(!isset($_SESSION["my_name"]["id"])){
  header('Location:login.php');

}else if(isset($_SESSION["my_name"]["id"])){

    if($_GET && isset($_GET['user_id'])){

        $user_id = $_GET['user_id'];
       
        $sql_check = 'SELECT acc_user.user_check FROM acc_user WHERE acc_user.user_id ='. $user_id ;
        $result_check= $conn->query($sql_check);
        $row_check = $result_check->fetch_assoc();
        
        if($row_check['user_check'] == 1){

          $sql_check_delete = 'UPDATE acc_user SET user_check = 0 WHERE user_id = '. $user_id ;
          if($conn->query($sql_check_delete) === TRUE){
            header("Location: ../index.php"); 
            
          }else{
            header("Location: ../profile.php");  
          }

        }else if($row_check['user_check'] == 0){
        
          $sql_check_delete = 'UPDATE acc_user SET user_check = 1 WHERE user_id = '. $user_id ;
          if($conn->query($sql_check_delete) === TRUE){
            header("Location: ../index.php"); 
            
          }else{
            header("Location: ../profile.php");  
          }
        }
    }
  }
?>