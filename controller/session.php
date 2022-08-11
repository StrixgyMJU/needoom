<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<linkb href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php
if (!isset($_SESSION["my_name"]["id"])) {
  header('Location:login.php');

} else if (isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1) { 
?>


    <nav class="navbar navbar-expand-lg navbar-light bg-info text-light link-light text-right">
      <div class="container-fluid">
        <div  class="col-6 col-responsive"></div>
        <div class="dropdown" >
            <a class="nav-link link-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-user"></i> สวัสดีคุณ : <?= $_SESSION["my_name"]["name"] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item">
              <a class="dropdown-item" href="admin.php">หน้าหลัก</a>
            </li>
              <li>
                <a class="dropdown-item" href="func/logout.php" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่')">ออกจากระบบ</a>
              </li>
            </ul>
          </div>
      </div>
    </nav>

<?php
} else if (isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 0) {
  $user_id = '';
  $user_id = $_SESSION["my_name"]["id"];

  $sql = 'SELECT * FROM acc_user WHERE user_id = ' . $user_id;

  //echo $sql;
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info text-light link-light">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler text-white" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><b class="text-light">หน้าหลัก</b></a>
            </li> <hr>
            <li class="nav-item">
              <a class="nav-link" href="record.php"><b class="text-light">บันทึก รายรับ/รายจ่าย</b></a>
            </li> <hr>
            <li class="nav-item">
              <a class="nav-link" href="search.php"><b class="text-light">ค้นหา รายรับ/รายจ่าย</b></a>
            </li> <hr>
            <li class="nav-item">
              <a class="nav-link" href="report.php"><b class="text-light">รายงาน รายรับ/รายจ่าย</b></a>
            </li> <hr>
            <li class="nav-item">
              <a class="nav-link" href="wallet.php"><b class="text-light">เพิ่มบัญชี</b></a>
            </li> <hr>
          </ul>
          <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
          <!-- Notifications -->
          <div class="dropdown">
            <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li>
                <a class="dropdown-item" href="#">ครบกำหนดการผ่อนชำระของ คุณ xxxx แล้ว</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">คุณตั้งการแจ้งเตือนการจ่ายเงินไว้กับ xxxxx </a>
              </li>
            </ul>
          </div>
          <!-- Avatar -->
          <div class="dropdown ">
            <a class="nav-link link-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-user"></i> สวัสดีคุณ : <?= $_SESSION["my_name"]["name"] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="profile.php">โปรไฟล์ผู้ใช้</a>
              </li>
              <li>
                <a class="dropdown-item" href="func/logout.php" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่')">ออกจากระบบ</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

<?php
  }
}
?>