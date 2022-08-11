<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อมูล Need Oom</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/body.css">


    <?php 

        require('sql/connect.php') ;
         session_start();
        require('controller/session.php');
        if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
            header('location: admin.php');
            }
    ?>

</head>

<body style="background-color:#f1f1f1">

<?php

    $sql_check_wallet = 'SELECT COUNT(*) AS count FROM acc_wallet WHERE user_id='. $user_id;
    $result_wallet= $conn->query($sql_check_wallet);
    $row_wallet = $result_wallet->fetch_assoc();
    $check = $row_wallet['count'];
    if($check == 0){ 
       echo '<script type="text/javascript">window.location="wallet.php";</script>า';
    }

?>

<?php

    require('func/record.php');      

?>
    
 <div class=".container-fluid">    
    <!-- main -->
    <br>

    <h1 align="center"><i class="fas fa-pen"></i> บันทึกรายรับรายจ่าย </h1>
   
        <div class="container" style="background-color:white">
            <div class="card-body" style="margin-bottom: 50px;">

                <form action="#" method="GET">
                    <br>
                    <label for="menu"><b> คุณต้องการจะทำอะไร ? </b></label>

                    <select name="status" class="custom-select mb-3" id="menu" required>
                
                        <option value="IN">รายรับ</option>
                        <option value="OUT">รายจ่าย</option>

                    </select>

                    <label for="date" name="date" id="date"><b>วันที่:</b></label>

                    <br>

                    <input class="form-control" type="date" name="date" id="date" value="mm/dd/yyyy" required>
                    
                    <br>

                    <label for="wallet"><b>ชื่อบัญชี | กระเป๋า :</b></label>

                    <select name="wallet" class="custom-select mb-3" id="wallet">
                        <option selected>กรุณาเลือกกระเป๋า</option>
                        
                        <?php
                        $sql_bank = "SELECT * FROM acc_wallet WHERE user_id=". $user_id;
                        $result = $conn->query($sql_bank);
                        while($row = $result->fetch_assoc()) {
                        ?>
                          
                        <option value="<?=$row['wallet_id'];?>"> <?= $row['wallet_name'];?>  </option>
          
                         <?php } ?>
                         
                    </select>

                    <label for="bank"><b>ธนาคาร:</b></label>                 

                    <select name="bank" class="custom-select mb-3" id="bank">
                        <option selected>กรุณาเลือกธนาคาร</option>

                            <?php

                            $sql_bank = "SELECT * FROM acc_bank";

                            $result = $conn->query($sql_bank);
                              while($row = $result->fetch_assoc()) {
                               
                            ?>

                            <option value="<?=$row['bank_id'];?>"> <?= $row['bank_name'];?>  </option>
                              
                            <?php } ?>

                    </select>
                    <br>

                    <label for="customer"><b> ชื่อลูกค้า : </b></label>
                    <br>
                    <input list="customer" name="customer" class="form-control" 
                    placeholder="กรุณาระบุชื่อลูกค้าหรือชื่อร้าน" required/></label>
                    <datalist id="customer">
                    <?php
                        $sql_customer = "SELECT * FROM acc_customer WHERE user_id=".$user_id;

                        $result = $conn->query($sql_customer);

                        while($row = $result->fetch_assoc()) {   
    
                        ?>
                        <option value="<?=$row['customer_name'];?>">

                        <?php 
                        }                       
                        ?>
                    </datalist>
                    
                    <br>

                    <label for="catagory"><b> ประเภทสินค้า : </b></label>

                        <input style="margin-inline: 5px;" type="radio"  class="form-check-center"  name="check" 
                        id="check" onclick="myFunction()" checked value="1">
    
                            <select name="category" class="custom-select mb-1" id="category">
                            <optgroup label="สินค้าทั่วไป">
                            <?php

                            $sql_category = "SELECT * FROM acc_category WHERE category_id < 9";

                            $result = $conn->query($sql_category);
                           
                              while($row = $result->fetch_assoc()) {   
                                
                            ?>
                            <option value="<?=$row['category_id'];?>"> <?= $row['category_name'];?>  </option>
                            
                            <?php 
                            }
                            ?>

                            <optgroup label="อื่นๆ">
                            <?php
                            $count_order = 0;
                             $sql_category = "SELECT * FROM acc_category_order WHERE user_id=".$user_id;

                            $result = $conn->query($sql_category);
                           
                              while($row = $result->fetch_assoc()) {   
                               $count_order = $row['order_id']+8;
                            ?>
                            <option value="<?=$count_order;?>"> <?= $row['order_name'];?>  </option>
                            
                            <?php 
                            }
                            ?>
                            </select>
                            
                    <br>

                    <label for="insert_order"><b> ประเภทสินค้าอื่นๆ : </b></label>
                    
                         <input style="margin-inline: 5px;" type="radio" name="check" id="check" onclick="myFunction2()" value="2"> 
                            
                         <input type="text" class="form-control" style="margin: 0;" aria-label="Text input with dropdown button"
                                placeholder="เพิ่มประเภทสินค้าอื่นๆ" name="insert_order" id="insert_order" disabled>
                    <br>
                    <label for="detail"><b> ชื่อสินค้า: </b></label>
                    <br>
                    <input type="text" class="form-control" placeholder="กรุณาระบุชื่อสินค้า" name="detail" id="detail"
                        required>
                    <br>
                    <label for="sum"><b> จำนวนเงิน: </b></label>
                    <br>
                    <input type="number" class="form-control" placeholder="ระบุจำนวนเงิน" name="sum" id="sum" required>
                    <br>
                    <label for="comment"><b> หมายเหตุ: </b></label>
                    <br>
                    <input type="text" class="form-control" placeholder="จะระบุหรือไม่ระบุก็ได้" name="comment" id="comment">
                    <br>

                    <button type="submit" class="btn btn-success col-lg">บันทึก</button> 
                    <footer>
                    <br>
                    </footer>
                    
                </form>

           </div>
        </div>
    </div>
    <br>

    <?php
    require("controller/footer.php");
    ?>

<script>
   function myFunction() { 

    document.getElementById("category").disabled = false ;
    document.getElementById("insert_order").disabled = true ;
    }

    function myFunction2() { 
    
    document.getElementById("insert_order").disabled = false ;
    document.getElementById("category").disabled = true ;
    }

// ถ้าเลือกหมวดให้รับข้อมูลแค่หมวดหมู่ //ถ้าเลือกเขียนห้รับข้อมูลที่เขียน


</script>

</body>
</html>