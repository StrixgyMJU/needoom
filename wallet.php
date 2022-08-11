<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD WALLET - OOMDEE</title>

    <?php
if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
    header('location: admin.php');
    }
    require('sql/connect.php');
    session_start();
    require('controller/session.php');
    $date = date('Y-m-d')

    ?>

</head>

<body style="background-color:#f1f1f1">

    <br>

    <h1 align="center"><i class="fa fa-wallet"></i> เพิ่มกระเป๋าเงินหรือบัญชีของท่าน </h1>

    <div class="box2">

        <div class="container" style="background-color:white">
            <div class="agileits-top">
                <form action="#" method="POST">
                    <br>

                    <label for="wallet"><b> ชื่อกระเป๋า / ชื่อบัญชี :</b></label>

                    <br>

                    <input type="text" class="form-control" placeholder="กรุณาระบุชื่อกระเป๋าหรือชื่อบัญชีของท่าน" name="wallet" id="wallet" required>
                    
                    <br>
                    
                    <label for="in"><b> จำนวนเงิน:</b></label>

                    <br>

                    <input type="text" class="form-control" placeholder="กรอกจำนวนเงินที่มีเบื้องต้น" name="in" id="in" required>
                    <br>

                    <button type="submit" class="btn btn-success editbtn">
                        SUBMIT
                    </button>

                    <footer>
                        <br>
                    </footer>

                </form>

                <?php

                $insert_wallet = '';

                if ($_POST) {

                    $insert_wallet = $_POST['wallet'];
                    $insert_income = $_POST['in'];

                    $sql_wallet = 'SELECT COUNT(*) AS count FROM `acc_wallet` WHERE acc_wallet.user_id =' . $user_id . ' AND acc_wallet.wallet_name="' . $insert_wallet . '" ';
                    $result_wallet = $conn->query($sql_wallet);
                    $row_wallet = $result_wallet->fetch_assoc();
                    $wallet = $row_wallet['count'];

                    if ($wallet != 0) {
                        $message = "คุณมีกระเป๋าเงินหรือบัญขีนี้แล้วโปรดลองใหม่อีกครั้ง";

                        echo "<script type='text/javascript'>alert('$message');</script>";
                    } else if ($wallet == 0) {

                        $sql_insert = 'INSERT INTO acc_wallet ( wallet_name, user_id) VALUES ("' . $insert_wallet . '", "' . $user_id . '")';

                        if ($conn->query($sql_insert) === TRUE) {

                            $sql_id_wallet = "SELECT MAX(wallet_id) as wallet FROM acc_wallet WHERE user_id=".$user_id;
                            $result_id_wallet = $conn->query($sql_id_wallet);
                            $count_id_wallet = $result_id_wallet->fetch_array();
                            $insert_id_wallet = $count_id_wallet['wallet'] ;

                        } else {

                            $miss = "บันทึกข้อมูลไม่สำเร็จ";
                            echo "<script> alert('$message'); window.location='wallet.php'; </script>";
                            //echo 'ERROR'. $sql_insert . "<br>" . $conn->error; 

                        }

                        $sql_insert_money = 'INSERT INTO acc_record (user_id, wallet_id, customer_id, category_id, order_id,
                                                             bank_id, record_detail, record_comment, status, 
                                                        income, expense, record_image, record_create_date ) 
                                                        VALUES 
                                                        ("' . $user_id . '","' . $insert_id_wallet . '",
                                                        "1",9,0,5,"ฝากในบัญชีครั้งแรก"," ",
                                                        "IN","' . $insert_income . '",0," ","'. $date .'")';

                        if ($conn->query($sql_insert_money) === TRUE) {

                            $message = "บันทึกข้อมูลสำเร็จ";
                            echo "<script> alert('$message'); window.location='record.php'; </script>";
                        } else {

                            // $miss = "บันทึกข้อมูลไม่สำเร็จ";
                            // echo "<script> alert('$message'); window.location='wallet.php'; </script>";
                            echo 'ERROR'. $sql_insert . "<br>" . $conn->error; 

                        }
                    }
                }
                ?>

                <div class="table-responsive">
                    <table class="table" id="" width="100%" cellspacing="0">

                        <thead class="table-dark">

                            <tr>
                                <th>ชื่อกระเป๋า</th>
                                <th width="120">แก้ไข</th>
                            </tr>

                        </thead>


                        <?php
                        $sql = 'SELECT * FROM `acc_wallet` WHERE user_id = ' . $user_id;
                        $result = $conn->query($sql);
                        //echo $conn->error;

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {

                        ?>


                                <tbody>

                                    <tr>
                                        <!-- <td> <?php //echo $row['wallet_total'] ; 
                                                    ?> </td> -->
                                        <td> <?php echo $row['wallet_name']; ?> </td>
                                        <td>

                                            <a href="wallet_edit.php?rwid=<?= $row['wallet_id'] ?>" class="btn btn-warning btn"> แก้ไข
                                                <i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>


                            <?php

                            }
                        } else {

                            echo "<label style='color:red'><b> ยังไม่มีข้อมูล </b></label><br>";
                        }

                        $conn->close();

                            ?>

                                </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php
        require('controller/footer.php');
        ?>
</body>

</html>