<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Controller by Need Oom</title>
    <?php
    require('sql/connect.php');
    session_start();
    require('controller/session.php');

    if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
    ?>
</head>

<body>

    <div class="container">

        <main>

            <div class="container-fluid">
                <!-- เว้นช่องข้างบน -->
                <div class="mt-4"></div>

                <div class="card mb-4">

                    <div class="card-header">

                        <i class="fa-solid fa-user"></i> บัญชีผู้ใช้ในระบบ

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-responsive align-center bg-white">

                                <thead class="bg-light ">

                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>ตรวจสอบบันทึก</th>
                                        <th>แก้ไขบัญชี</th>
                                        <th>ขอยกเลิกบัญชี</th>
                                        <th>ลบบัญชี</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    $sql_user = "SELECT * FROM acc_user WHERE user_type=0";
                                    $result = $conn->query($sql_user);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>

                                        <tr>
                                            <td>

                                                <p class="fw-bold mb-1"><?= $row['user_username'] ?></p>

                                            </td>
                                            <td>

                                                <p class="fw-bold mb-1"><?= $row['user_email'] ?></p>

                                            </td>
                                            <td>

                                                <form action="admin_search.php" method="GET">
                                                    <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                                    <button type="submit" class="btn btn-info" name="submit">ตรวจสอบ</button>
                                                </form>

                                            </td>
                                            <td>

                                                <form action="profile.php" method="post">
                                                    <input type="hidden" name="user" value="<?= $row['user_id'] ?>">
                                                    <button type="submit" class="btn btn-warning" name="submit">แก้ไขบัญชี</button>
                                                </form>

                                            </td>
                                            <td>
                                            <?php
                                            
                                            if($row['user_check'] == 1){
                                            ?>
                                                <div class="ms-2">
                                                    <i class="fas fa-check" style='color: green'></i>
                                                </div>
                                            <?php
                                            }else if($row['user_check'] == 0){
                                            ?>
                                                <div class="ms-2">
                                                    <i class="fas fa-times" style='color: red'></i>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            </td>
                                            <td>

                                            <a href="func/delete_user.php?user_id=<?= $row['user_id']; ?>" 
                                            <?php
                                            if($row['user_check'] == 1){
                                             echo 'class="btn btn-danger"';
                                            }else if($row['user_check'] == 0){
                                            echo 'class="btn btn-danger disabled"';
                                            }
                                            ?>
                                            role="button " aria-disabled="true" onclick="return confirm('คุณต้องการจะลบผู้ใช้นี้ใช่หรือไม่?');">
                                                ลบ <i class="far fa-trash-alt"></i>
                                            </a>

                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </main>

    </div>

    <?php
    require('controller/footer.php');
    }else{
     $message = "คุณไม่ได้รับอนุญาตเข้าหน้านี้";
     echo "<script> alert('$message'); window.location='index.php'; </script>";
    }
    ?>

</body>
<style>
    a.disabled {
  pointer-events: none;
  cursor: default;
}
</style>
</html>