<!DOCTYPE html>
<html>

<head>

  <title>สมัครสมาชิก : เก็บเก่ง</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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

<body class="bg-info ">

  <?php
  require('sql/connect.php');

  if ($_POST) {
    if ($_POST["psw"] === $_POST["psw-repeat"]) {

      $user = $_POST['user'];
      $pass = $_POST['psw'];
      $email = $_POST['email'];
      $fn = $_POST['fn'];
      $ln = $_POST['ln'];

      $sql = 'INSERT INTO acc_user(user_first_name, user_last_name, user_username, user_password, user_email) 
                       VALUES ("' . $fn . '","' . $ln . '","' . $user . '","' . $pass . '","' . $email . '")';
      if ($conn->query($sql) === TRUE) {
        //header("Location: success.php");
        $message = "สมัครสมาชิกสำเร็จ";
        echo "<script> alert('$message'); window.location='login.php'; </script>";
      } else {
        $miss = "บันทึกข้อมูลไม่สำเร็จ โปรดลองใหม่อีกครั้ง";
                echo "<script type='text/javascript'>alert('$miss');</script>";
      }
    }
  }
  ?>

  <!-- main -->

  <div class="container" style="padding-bottom:100px; padding-top:50px;">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-6">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body text-center">

            <form action="" method="POST">

              <h1 class="imgcontainer mb-4"><i class="fas fa-user-edit"></i> สมัครสมาชิก </h1>

              <div class="form-outline mb-4">
                <input type="text" id="typeEmail" class="form-control form-control-lg" 
                minlength="6" maxlength="16" name="user" required />
                <label class="form-label" for="typeEmail">บัญชีผู้ใช้</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 40px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>

              <?php
              if ($_POST) {
                if ($_POST["psw"] !== $_POST["psw-repeat"]) {
                  echo '<b style="color:red;"> *กรุณากรอกรหัสผ่านให้ตรงกัน</b>';
                }
              }
              ?>

              <div class="form-outline mb-4">
                <input type="password" id="typePassword" class="form-control form-control-lg" minlength="8" maxlength="16" name="psw" required />
                <label class="form-label" for="typePassword">รหัสผ่าน</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 40px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>

              <?php
              if ($_POST) {
                if ($_POST["psw"] !== $_POST["psw-repeat"]) {
                  echo '<b style="color:red;"> *กรุณากรอกรหัสผ่านให้ตรงกัน</b>';
                }
              }
              ?>

              <div class="form-outline mb-4">
                <input type="password" id="typePassword" class="form-control form-control-lg" minlength="8" maxlength="16" name="psw-repeat" required />
                <label class="form-label" for="typePassword">ยืนยันรหัสผ่าน</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 40px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <input type="email" id="typePassword" class="form-control form-control-lg" name="email" required />
                <label class="form-label" for="typePassword" minlength="8">Email หรือ Gmail</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 40px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="typePassword" class="form-control form-control-lg" name="fn" required />
                <label class="form-label" for="typePassword">ชื่อ</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 40px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="typePassword" class="form-control form-control-lg" name="ln" required />
                <label class="form-label" for="typePassword">นามสกุล</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 40px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>



              <button class="btn btn-success btn-lg btn-rounded " type="submit">สมัครสมาชิก</button>
            </form>
            <hr>
            <div>
              <p>หากคุณมีบัญชีผู้ใช้แล้ว? <a href="login.php"> เข้าสู่ระบบ </a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- //main -->
</body>

<footer class="text-center fixed-bottom">
  <div class="text-center text-white p-3 bg-dark">
    ©2022 Copyright:
    <a class="text-white" href="Mailto:csmju82305@gmail.com">Mr.Korawit cheanghom</a>
  </div>
</footer>

</html>