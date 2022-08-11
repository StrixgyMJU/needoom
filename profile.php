<!DOCTYPE html>
<html lang="en">

<head>

    <title>HOME-OOMDEE</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require('sql/connect.php');
    session_start();
    require('controller/session.php');
    if($_POST && isset($_POST['user'])){
        $user_id = $_POST['user'];
    }
    ?>
</head>

<body class="body" style="background-color:#f1f1f1">
    <div class="container">
        <div class="container-fluid" >
            <!-- เว้นช่องข้างบน -->
            <div class="mt-4"> </div>

            <div class="card mb-4" ste>

                <div class="card-header">

                    ข้อมูลบัญชีผู้ใช้ <i class="fa-solid fa-user"></i> : <?= $_SESSION["my_name"]["name"] ?>

                </div>

                <div class="card-body">
                    <?php

                    if ($_GET) {

                        $user_email = $_GET['email'];
                        $user_first_name = $_GET['fn'];
                        $user_last_name = $_GET['ln'];
                        $user_id = $_GET['user'];

                        $sql_update = 'UPDATE acc_user
                                       
                                       SET 
                                       user_email = "' . $user_email . '",
                                       user_first_name = "' . $user_first_name . '",
                                       user_last_name = "' . $user_last_name . '"  
                                       WHERE acc_user.user_id = ' . $user_id;

                                       if($conn->query($sql_update) === TRUE){
                                        if($_SESSION["my_name"]["type"] == 1){
                                            $message = "แก้ไขสำเร็จ";
                                            echo "<script> alert('$message'); window.location='admin.php'; </script>";
                                        }
                                        $message = "การดำเนินการสำเร็จ กรุณาเข้าสู้ระบบใหม่อีกครั้ง";
                                        echo "<script> alert('$message'); window.location='func/logout.php'; </script>";
                    
                                    }else{
                                    $miss = "บันทึกข้อมูลไม่สำเร็จ";
                                    echo "<script type='text/javascript'>alert('$miss');</script>";
                                    //echo 'ERROR'. $sql_insert . "<br>" . $conn->error; 
                    
                                    }
                    }

                    $sql_profile = "SELECT * FROM acc_user WHERE acc_user.user_id=" . $user_id;
                    $result = $conn->query($sql_profile);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="col">

                            <form action="#" method="GET">

                            <input type="hidden" name="user" value="<?= $user_id ?>">

                                <p>
                                    <h7> ชื่อ : </h7> <br> <input type="text" name="fn" class="form-control" value="<?= $row['user_first_name'] ?>"><br>
                                </p>

                                <p>
                                    <h7> นามสกุล : </h7> <br>  <input type="text" name="ln" class="form-control" value="<?= $row['user_last_name'] ?>"><br>
                                </p>

                                <p>
                                    <h7> Email : </h7> <br>  <input type="text" name="email"  class="form-control"value="<?= $row['user_email'] ?>"><br>
                                </p>
                                
                                <button type="submit" class="btn btn-warning" name="submit">แก้ไข้ข้อมูลบัญชีผู้ใช้</button>

                            </form> <br>
                        <?php
                        

                        if($_SESSION["my_name"]["type"] == 0 ){
                        ?>
                            
                            <form action="func/user_check.php" method="GET">
                                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                <input type="hidden" name="record_id" value="<?= $row['record_id']; ?>">
                                <button type="submit" class="btn btn-danger" name="submit" onclick="return confirm('คุณแน่ใจแล้วใช่หรือไม่?')">
                                
                                <?php
                                if($row['user_check'] == 0){
                                    echo 'ร้องขอการลบบัญชี'.' '.'<i class="fas fa-delete"></i>';
                                }else if($row['user_check'] == 1){
                                    echo 'ยกเลิกการลบบัญชี'.' '.'<i class="fas fa-edit"></i>';
                                }
                                ?>
                            </button>
                            </form>
                        
                        <?php
                        }
                    }
                        ?>
                        </div>
                </div>
            </div>
        </div>
    </div>    

    <?php
        require('controller/footer.php');
    ?>
    
</body>

</html>