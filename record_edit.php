<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลที่บันทึก by Need Oom</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <?php 

  require('sql/connect.php') ;
  session_start();
  require('controller/session.php');
  require('func/record_edit.php');

?>

</head>


<body class="body">

    <!-- main -->
<div class="container-fluid"> 

    <h1 align="center" style="margin: 20px;"><i class="fa fa-edit"></i> แก้ไขข้อมูลรายรับรายจ่าย </h1>
        <div class="container" style="background-color:#f1f1f1">
            <div class="card-body">

                <form action="#" method="POST">
                    <br>
                    <label for="menu"><b> คุณต้องการจะทำอะไร ? </b></label>
                    <!-- ซ่อนลิงค์หน้าเดิมไว้เพื่อเวลาอัพเดทแล้วจะกลับไปการค้นหาเดิม -->
                    <input type="hidden" value="<?= $token; ?>" name="url">
                    <select name="status" class="custom-select mb-3" id="menu" required>

                   <?php if($update_status == "IN"){ ?>

                        <option selected="<?php echo 'selected';?>" value="IN">รายรับ</option>
                        <option  value="OUT">รายจ่าย</option>
                    <?php }else if($update_status == "OUT"){ ?>     
                        <option value="IN">รายรับ</option>
                        <option selected="<?php echo 'selected';?>" value="OUT">รายจ่าย</option>

                    <?php } ?>  
                    
                    </select>

                    <label for="date" name="date" id="date"><b>วันที่:</b></label>

                    <br>

                    <input class="form-control" type="date" name="date" id="date"
                    value="<?= $update_create_date?>">
                    
                    <br>

                    <label for="wallet"><b>ชื่อบัญชี | กระเป๋า :</b></label>

                    <select name="wallet" class="custom-select mb-3" id="wallet">
                        <option selected>กรุณาเลือกกระเป๋า</option>
                        
                        <?php
                        $sql_wallet = "SELECT * FROM acc_wallet WHERE user_id=". $user_id;
                        $result = $conn->query($sql_wallet);
                        while($row = $result->fetch_assoc()) {
                        ?>
                          
                        <option 

                        <?php 
                            if( $update_wallet == $row['wallet_id'] ){ 
                                echo "selected='selected'"; }
                        ?>

                        value="<?=$row['wallet_id'];?>"> <?= $row['wallet_name'];?> </option>
          
                        <?php 
                        } 
                        ?>
                         
                    </select>

                    <label for="bank"><b>ธนาคาร:</b></label>                 

                    <select name="bank" class="custom-select mb-3" id="bank">
                        <option selected>กรุณาเลือกธนาคาร</option>

                            <?php

                            $sql_bank = "SELECT * FROM acc_bank";

                            $result = $conn->query($sql_bank);
                              while($row = $result->fetch_assoc()) {
                               
                            ?>

                            <option 

                            <?php 
                            if( $update_bank == $row['bank_id'] ){ 
                                echo "selected='selected'"; }
                            ?>

                            value="<?=$row['bank_id'];?>"> <?= $row['bank_name'];?>  </option>
                              
                            <?php } ?>

                    </select>
                    <br>

                    <label for="customer"><b> ชื่อลูกค้า : </b></label>
                    <br>
                    <input list="customer" name="customer" class="form-control" 
                    placeholder="กรุณาระบุชื่อลูกค้าหรือชื่อร้าน" value="<?=$update_customer?>" required/></label>
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
                    <!-- <input type="text" class="form-control" placeholder="กรุณาระบุชื่อลูกค้าหรือชื่อร้าน" name="customer"
                    id="customer" required> -->
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
                            <option 

                            <?php 
                            if($update_category == $row['category_id'] &&  $update_category <=8 ){ 
                                echo "selected='selected'"; }
                            ?>

                            value="<?=$row['category_id'];?>"> <?= $row['category_name'];?>  </option>
                            
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
                            <option

                            <?php 
                            if($update_category == 9 && $update_id_order == $row['order_id']  ){ 
                                echo "selected='selected'"; }
                            ?>

                                value="<?=$count_order;?>"> <?= $row['order_name'];?>  </option>
                            
                            <?php 
                            }
                            ?>

                            </select>            

                        <br>

                        <label for="catagory"><b> ประเภทสินค้าอื่นๆ : </b></label>

                        <input style="margin-inline: 5px;" type="radio" name="check" id="check" onclick="myFunction2()" value="2"> 
                        
                        <input type="text" class="form-control" style="margin: 0;" aria-label="Text input with dropdown button"
                        placeholder="เพิ่มประเภทสินค้นใหม่" name="update_order" id="update_order" disabled>
                        
                        <br>
                        
                    <label for="detail"><b> ชื่อสินค้า: </b></label>
                    <br>
                    <input type="text" class="form-control" placeholder="กรุณาระบุชื่อสินค้า" name="detail" id="detail"
                    value="<?=$update_detail?>"    required>
                    <br>
                    <label for="sum"><b> จำนวนเงิน: </b></label>
                    <br>
                    <?php if($update_status == "IN"){ ?>

                    <input type="number" class="form-control" placeholder="ระบุจำนวนเงิน" name="sum" id="sum" 
                     value= "<?= $update_income;?>" required>
                   
                   <?php
                     }else{
                    ?>

                     <input type="number" class="form-control" placeholder="ระบุจำนวนเงิน" name="sum" id="sum" 
                     value= "<?= $update_expense;?>" required>
                    
                    <?php
                    } 
                    ?>
                    
                    <br>
                    <label for="comment"><b> หมายเหตุ: </b></label>
                    <br>
                    <input type="text" class="form-control" placeholder="จะระบุหรือไม่ระบุก็ได้" name="comment" id="comment"
                    value="<?= $update_comment;?>">
                    <br>

                    <button type="submit" class="btn btn-warning" style="color: #fff;">แก้ไข</button> &emsp;
                    <a href="search.php" class="btn btn-danger">ยกเลิกการแก้ไข</a>
                    
                    <footer>
                        <hr>
                    <br>
                    </footer>

                </form>
           </div>
        </div>

</div>

    <!-- //main -->
<script>
   function myFunction() { 

    document.getElementById("category").disabled = false ;
    document.getElementById("update_order").disabled = true ;
    }

    function myFunction2() { 
    
    document.getElementById("update_order").disabled = false ;
    document.getElementById("category").disabled = true ;
    }

// ถ้าเลือกหมวดให้รับข้อมูลแค่หมวดหมู่ //ถ้าเลือกเขียนห้รับข้อมูลที่เขียน

</script>
<?php
        require('controller/footer.php');
        ?>
</body>
</html>