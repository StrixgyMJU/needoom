<?php
    $record_id = '';
    if($_GET && isset($_GET['record_id'])){
        $record_id = $_GET['record_id'];
        $user_id = $_GET['user_id'];
        //เก็บลิงค์เดิมไว้
        if(isset($_SERVER["HTTP_REFERER"])){
        $token = $_SERVER['HTTP_REFERER'];
        }
        $sql_record = 'SELECT * FROM acc_record WHERE record_id = '. $record_id;
        $result = $conn->query($sql_record);
        //echo $conn->error;
        $row = $result->fetch_assoc();
            $record_id = $row['record_id'];
?>
    <title><?= 'EDIT DATA NO. ' . $record_id ?></title>

<?php
} else {
    ini_set("display_errors", true);
        error_reporting(E_ALL);
    header( "location: ../search.php" ) ;
}
?>

<?php
        $update_status = '';
        $update_wallet = '';
        $update_customer = '';
        $update_category = '';
        $update_bank = '';
        $update_detail = '';
        $update_comment = '';
        $update_income = '';
        $update_expense = '';
        $update_image = '';
        $update_create_date = '';
        $update_order_category = '' ;
        $update_id_order = 0 ;
        $update_time = '' ;

        require('sql/select_update_record.php');

        $result_record_update = $conn->query($sql_record_update);
        $row = $result_record_update->fetch_assoc();

        $update_status = $row['status'];
        $update_wallet =  $row['wallet_id'];
        $update_customer =  $row['customer_name'];
        $update_category =  $row['category_id'];
        $update_bank =  $row['bank_id'];
        $update_detail =  $row['record_detail'];
        $update_comment =  $row['record_comment'];
        $update_income =  $row['income'];
        $update_expense =  $row['expense'];
        $update_image =  $row['record_image'];
        $update_id_order = $row['order_id'];
        $update_create_date =  $row['record_create_date'];
        $update_id_order =  $row['order_id'];
        
        
        
  if($_POST){
    //เก็บลิงค์เดิมไว้
    $url = $_POST['url'];
    date_default_timezone_set('Asia/Bangkok');
    $update_time = date("Y-m-d H:i:s");

    $update_wallet = $_POST['wallet'] ;

    $update_customer = $_POST['customer'] ;
    
    $sql_check_customer = 'SELECT customer_id FROM acc_customer
    WHERE user_id ='. $user_id .' AND acc_customer.customer_name="'. $update_customer . '" ' ;
    $result_check_customer= $conn->query($sql_check_customer);
    $row_check_customer = $result_check_customer->fetch_assoc();
    $check_customer = $row_check_customer['customer_id'];

    if($check_customer != 0 ){
        
        $update_id_customer = $check_customer;

    }else if($check_customer == 0){

    $sql_insert_customer= 'INSERT INTO acc_customer (customer_name, user_id)
                         VALUES ("'. $update_customer .'","'. $user_id .'")';
    
    if($conn->query($sql_insert_customer) === TRUE){

        $sql_id_customer = "SELECT MAX(customer_id) AS last_customer_id FROM acc_customer WHERE user_id=".$user_id;
        $result_id_customer = $conn->query($sql_id_customer);
        $count_id_customer = $result_id_customer->fetch_array();
        $update_id_customer = $count_id_customer['last_customer_id'] ;


      }else{

        echo 'ERROR'. $sql_update_customer . "<br>" . $conn->error; 
        echo '<br> <a href="record.php">Refesh</a> <br>' ;

      }
    } 

    if($_POST['check'] == 1){
        if($_POST['category'] <= 8){
            $update_category = $_POST['category'] ;
            $update_id_order =  0 ;
        }else{
            $update_category = 9 ;
            $sum_order = 0 ;
            $sum_order = $_POST['category']-8 ;
            $update_id_order = $sum_order ; 
        }
    }else if($_POST['check'] == 2){

        $update_category = 9 ;
        $update_order_category = $_POST['update_order'] ;

        $sql_check_order = 'SELECT order_id FROM acc_category_order
        WHERE user_id ='. $user_id .' AND acc_category_order.order_name="'. $update_order_category . '" ' ;
        $result_check_order= $conn->query($sql_check_order);
        $row_check_order = $result_check_order->fetch_assoc();
        $check_order = $row_check_order['order_id'];

        if($check_order != 0 ){
            
            $update_id_order = $check_order;

        }else if($check_order == 0){

        $sql_update_order = 'INSERT INTO acc_category_order (order_name, category_id, user_id)
                             VALUES ("'. $update_order_category .'","'. $update_category .'","'. $user_id .'")';
        
        if($conn->query($sql_update_order) === TRUE){

            $sql_id_order = "SELECT MAX(order_id) AS last_order_id FROM acc_category_order WHERE user_id=".$user_id;
            $result_id_order = $conn->query($sql_id_order);
            $count_id_order = $result_id_order->fetch_array();
            $update_id_order = $count_id_order['last_order_id'] ;


          }else{
            $message = "การดำเนินการไม่สำเร็จ โปรดลองอีกครั้ง";
            echo "<script>alert('$message'); window.location='record_edit.php'; </script>";
            
          }
        }  
          

     }else{
         echo ('error');
     }

   
    $update_bank = $_POST['bank'] ;
    $update_detail = $_POST['detail'] ;
    $update_comment = $_POST['comment'] ;
    $update_status = $_POST['status'] ;
    $update_date = $_POST['date'] ;
    $update_sum = $_POST['sum'] ;

    if ($update_status == 'IN') {

        $_POST['income'] = $update_sum;
        $_POST['expense'] = 0;

    } else {

        $_POST['expense'] = $update_sum;
        $_POST['income'] = 0;

    }

    $update_income = $_POST['income'];
    $update_expense = $_POST['expense'];
   
      $sql_update = 'UPDATE acc_record SET wallet_id = "'. $update_wallet .'",
                                           customer_id = "'. $update_id_customer .'",
                                           category_id = "'. $update_category .'",
                                           order_id =  "'. $update_id_order .'",
                                           bank_id = "'. $update_bank .'",
                                           record_detail = "'. $update_detail .'",
                                           record_comment = "'. $update_comment .'",
                                           status = "'. $update_status .'",
                                           income = "'. $update_income .'",
                                           expense =  "'. $update_expense .'",
                                           record_image = "'. $update_image .'",
                                           record_create_date = "'. $update_date .'",
                                           record_update_date = "'. $update_time .'"
                                           WHERE record_id = '. $record_id;

      if($conn->query($sql_update) === TRUE){
        
        $message = "การดำเนินการสำเร็จ";
        echo "<script> alert('$message'); window.location='".$url."'; </script>";

      }else{
        
        $message = "การดำเนินการไม่สำเร็จ โปรดลองอีกครั้ง";
        echo "<script> alert('$message'); window.location='record_edit.php?record_id=". $record_id ."'; </script>";
        
     }

    }
?>