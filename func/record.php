<?php

        $insert_status = '';
        $insert_wallet = '';
        $insert_customer = '';
        $insert_category = '';
        $insert_bank = '';
        $insert_detail = '';
        $insert_comment = '';
        $insert_income = '';
        $insert_expense = '';
        $insert_image = '';
        $insert_date = '';
        $insert_order_category = '' ;
        $insert_id_order = 0 ;

  if($_GET){

    $insert_wallet = $_GET['wallet'] ;

    $insert_customer = $_GET['customer'] ;
    
    $sql_check_customer = 'SELECT customer_id FROM acc_customer
    WHERE user_id ='. $user_id .' AND acc_customer.customer_name="'. $insert_customer . '" ' ;
    $result_check_customer= $conn->query($sql_check_customer);
    $row_check_customer = $result_check_customer->fetch_assoc();
    $check_customer = $row_check_customer['customer_id'];

    if($check_customer != 0 ){
        
        $insert_customer = $check_customer;

    }else if($check_customer == 0){

    $sql_insert_customer= 'INSERT INTO acc_customer (customer_name, user_id)
                         VALUES ("'. $insert_customer .'","'. $user_id .'")';
    
    if($conn->query($sql_insert_customer) === TRUE){

        $sql_id_customer = "SELECT MAX(customer_id) AS last_customer_id FROM acc_customer WHERE user_id=".$user_id;
        $result_id_customer = $conn->query($sql_id_customer);
        $count_id_customer = $result_id_customer->fetch_array();
        $insert_customer = $count_id_customer['last_customer_id'] ;


      }else{

        echo 'ERROR'. $sql_insert_customer . "<br>" . $conn->error; 
        echo '<br> <a href="record.php">Refesh</a> <br>' ;

      }
    } 

    if($_GET['check'] == 1){
        if($_GET['category'] <= 8){
            $insert_category = $_GET['category'] ;
            $insert_id_order =  0 ;
        }else{
            $insert_category = 9 ;
            $sum_order = 0 ;
            $sum_order = $_GET['category']-8 ;
            $insert_id_order = $sum_order ; 
        }
    }else if($_GET['check'] == 2){

        $insert_category = 9 ;
        $insert_order_category = $_GET['insert_order'] ;

        $sql_check_order = 'SELECT order_id FROM acc_category_order
        WHERE user_id ='. $user_id .' AND acc_category_order.order_name="'. $insert_order_category . '" ' ;
        $result_check_order= $conn->query($sql_check_order);
        $row_check_order = $result_check_order->fetch_assoc();
        $check_order = $row_check_order['order_id'];

        if($check_order != 0 ){
            
            $insert_id_order = $check_order;

        }else if($check_order == 0){

        $sql_insert_order = 'INSERT INTO acc_category_order (order_name, category_id, user_id)
                             VALUES ("'. $insert_order_category .'","'. $insert_category .'","'. $user_id .'")';
        
        if($conn->query($sql_insert_order) === TRUE){

            $sql_id_order = "SELECT MAX(order_id) AS last_order_id FROM acc_category_order WHERE user_id=".$user_id;
            $result_id_order = $conn->query($sql_id_order);
            $count_id_order = $result_id_order->fetch_array();
            $insert_id_order = $count_id_order['last_order_id'] ;


          }else{
            $message = "การดำเนินการไม่สำเร็จ โปรดลองอีกครั้ง";
            echo "<script>alert('$message'); window.location='record.php'; </script>";
            
          }
        }  
          

     }else{
         echo ('error');
     }

   
    $insert_bank = $_GET['bank'] ;
    $insert_detail = $_GET['detail'] ;
    $insert_comment = $_GET['comment'] ;
    $insert_status = $_GET['status'] ;
    $insert_date = $_GET['date'] ;
    $insert_sum = $_GET['sum'] ;

    if ($insert_status == 'IN') {

        $_GET['income'] = $insert_sum;
        $_GET['expense'] = 0;

    } else {

        $_GET['expense'] = $insert_sum;
        $_GET['income'] = 0;

    }

    $insert_income = $_GET['income'];
    $insert_expense = $_GET['expense'];
   
      $sql_insert = 'INSERT INTO acc_record (user_id, wallet_id, customer_id, category_id, order_id,
                                             bank_id, record_detail, record_comment, status, 
                                             income, expense, record_image, record_create_date ) 
      VALUES 
      ("'. $user_id .'","'. $insert_wallet .'",
      "'. $insert_customer .'","'. $insert_category .'",
      "'. $insert_id_order .'","'. $insert_bank .'",
      "'. $insert_detail .'","'. $insert_comment .'",
      "'. $insert_status .'","'. $insert_income .'",
      "'. $insert_expense .'","'. $insert_image .'","'. $insert_date .'")';
      
      if($conn->query($sql_insert) === TRUE){
        
        $message = "การดำเนินการสำเร็จ";
        echo "<script> alert('$message'); window.location='record.php'; </script>";

      }else{
        
        $message = "การดำเนินการไม่สำเร็จ โปรดลองอีกครั้ง";
        echo "<script> alert('$message'); window.location='record.php'; </script>";
        
      }

    }
?>