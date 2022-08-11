<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEED-OOM.co.th</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <link rel="stylesheet" href="styles.e41eb5076eefabc7c908.css">
    <linkb href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<?php 

session_start();
require('sql/connect.php');

?>

<?php

$user = '';
$pass = '';
$error = '';
$link = '';

if($_POST){

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    $sql_user='SELECT * FROM acc_user WHERE user_username = "'. $user .'" AND user_password = "'.$pass.'" ';
    $result = $conn->query($sql_user);
    echo $conn->error;
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
    // echo '<b style="color:Limegreen;">Success!!!</b>';

        $_SESSION["my_name"] = array("id"=>$row['user_id'],
                                     "name"=>$row['user_first_name'].' '.$row['user_last_name'],
                                     "username"=>$row['user_username'],
                                     "type"=>$row['user_type']
                                    );

                                    if($_SESSION["my_name"]['type'] == 0){
                                    header("Location: index.php" );  

                                    }else if($_SESSION["my_name"]['type'] == 1){        
                                    header("Location: admin.php" );
                                    }
                                    
                                    }else{
                                    $miss = "บัญชีหรือรหัสไม่ถูกต้อง โปรดลองใหม่อีกครั้ง";
                                    echo "<script type='text/javascript'>alert('$miss');</script>";
                                    }
}

?>

<body class="bg-info">
    
    <div class="container"  style="padding-bottom:100px; padding-top:50px;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                <div class="card" style="border-radius: 1rem;">
                    <div class="card-body text-center">
                            <h1 class="fw-bold mb-0">NeeD-OoM</h1>

                            <img src="img/money.png" width="200">

                            <form action="" method="POST">
                            <div class="form-outline mb-4">
                                <input type="text" id="typeEmail" class="form-control form-control-lg" name="user" required />
                                <label class="form-label" for="typeEmail">บัญชีผู้ใช้</label>
                                <div class="form-notch">
                                    <div class="form-notch-leading" style="width: 9px;"></div>
                                    <div class="form-notch-middle" style="width: 40px;"></div>
                                    <div class="form-notch-trailing"></div>
                                </div>
                            </div>

                            <div class="form-outline mb-5">
                                <input type="password" id="typePassword" class="form-control form-control-lg" name="pass" required />
                                <label class="form-label" for="typePassword">รหัสผ่าน</label>
                                <div class="form-notch">
                                    <div class="form-notch-leading" style="width: 9px;"></div>
                                    <div class="form-notch-middle" style="width: 40px;"></div>
                                    <div class="form-notch-trailing"></div>
                                </div>
                            </div>

                            <button class="btn btn-success btn-lg btn-rounded " type="submit">เข้าสู่ระบบ</button>
                            </form>
                            <hr>
                        <div>
                            <p>หากคุณยังไม่มีบัญชีผู้ใช้? <a href="register.php">สมัครสมาชิก</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center fixed-bottom">
            <div class="text-center text-white p-3 bg-dark" >
                ©2022 Copyright:
                <a class="text-white" href="Mailto:csmju82305@gmail.com">Mr.Korawit cheanghom</a>
            </div>
    </footer>

</body>

</html>