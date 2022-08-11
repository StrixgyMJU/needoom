<?php
       $wallet_id = '';
       $wallet_name = '';
       
       if($_GET && isset($_GET['rwid'])){
        $wallet_id = $_GET['rwid'];
        //echo $wallet_id ;
          $sql = 'SELECT * FROM acc_wallet WHERE wallet_id = '. $wallet_id;
          $result = $conn->query($sql);
          //echo $conn->error;
          $row = $result->fetch_assoc();
              
               $wallet_name = $row['wallet_name'];
       }

       if($_POST && isset($_POST['edit_wallet']) && isset($_POST['edit_wallet_id'])){

        $wallet_id = $_POST['edit_wallet_id'];
        $wallet_name = $_POST['edit_wallet'];

        $sql_wallet = 'SELECT COUNT(*) AS count FROM `acc_wallet` WHERE acc_wallet.user_id ='. $user_id .' AND acc_wallet.wallet_name="'. $wallet_name . '" ' ;
        $result_wallet= $conn->query($sql_wallet);
        $row_wallet = $result_wallet->fetch_assoc();
        $wallet = $row_wallet['count'];
        
            if($wallet != 0 ){
            $message = "คุณมีกระเป๋าเงินหรือบัญชีที่ใช้ชื่อนี้แล้วโปรดลองใหม่อีกครั้ง";
            
            echo "<script type='text/javascript'>alert('$message');</script>";
            }else if($wallet == 0){

            $sql_update = 'UPDATE acc_wallet SET wallet_name = "'. $wallet_name .'" WHERE wallet_id = '. $wallet_id ;
            
                if($conn->query($sql_update) === TRUE){
                    $message = "การดำเนินการสำเร็จ";
                    echo "<script> alert('$message'); window.location='wallet.php'; </script>";

                }else{
                $miss = "บันทึกข้อมูลไม่สำเร็จ";
                echo "<script type='text/javascript'>alert('$miss');</script>";
                //echo 'ERROR'. $sql_insert . "<br>" . $conn->error; 

                }
            }
        }
                    
?>
