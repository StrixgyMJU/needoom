<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD WALLET - OOMDEE</title>


<?php 
if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
    header('location: admin.php');
    }
  require('sql/connect.php') ;
  session_start();
  require('controller/session.php');
  require('func/wallet_edit.php');
?>

</head>

<body style="background-color:#f1f1f1">
<div class="container" style="margin-top: 20px;">
<h1 align="center"><i class="fas fa-edit fas fa-wallet"></i> แก้ไขชื่อกระเป๋าเงินหรือบัญชีของท่าน </h1>

    <div class="box2">

        <div class="container" style="background-color:white">
            <div class="agileits-top">
                <form action="#" method="POST">
                    <br>
                <label for="wallet"><b> ชื่อกระเป๋า / ชื่อบัญชี :</b></label>

                    <br>

                    <input type="text" class="form-control" name="edit_wallet" placeholder="ชื่อกระเป๋าหรือบัญชีของทา่น" value="<?= $wallet_name; ?>">
                    <input type="hidden" name="edit_wallet_id" value="<?= $wallet_id; ?>">
                    &emsp;
                    <br>

                    <button type="submit" class="btn btn-success editbtn" >
                    SUBMIT
                    </button>

                    <a href="wallet.php" class="btn btn-danger btn"> ยกเลิก </a> 

                    <footer>

                    <br>
                    </footer>
                </form>
           </div>
        </div>
</div>
    </div>
    <?php
        require('controller/footer.php');
        ?>
</body>
</html>