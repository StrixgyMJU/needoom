<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาข้อมูลNeed Oom</title>
    

    <?php

    require('sql/connect.php');
    session_start();
    require('controller/session.php');
    if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
        header('location: admin.php');
        }
    ?>

</head>

<body style="background-color:#f1f1f1; padding-bottom: 100px">

    <!-- หัวเรื่องที่จะค้นหา -->
    <div class="container" style="background-color:white;">

        <div class="card-header text-center" style="margin: 20px;">

            <h2><i class="fas fa-search"></i> ค้นหารายงานรายรับ-รายจ่าย </h2>

        </div>
        
            <div class="row" style="margin: 20px;" >
                <form method="GET" enctype="multipart/form-data" class="row row-cols-lg g-1 align-items-center">
                <input type="hidden" name="check" value="1">
                    <div class="col-6 col-responsive">
                        <label class="visually-hidden" for="detail">ข้อมูลสินค้า</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-search text-success" aria-hidden="true"></i></div>
                            <input type="search" class="form-control col" id="detail" placeholder="ข้อมูลสินค้า" name="search_detail" />
                        </div>
                    </div>

                    <div class="col-6 col-responsive">
                        <label class="visually-hidden" for="detail">ชื่อลูกค้า</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-user text-success" aria-hidden="true"></i></div>
                            <input type="search" class="form-control col" id="customer" placeholder="ชื่อลูกค้า" name="customer" />
                        </div>
                    </div>

                    <datalist id="customer">
                        <?php
                        $sql_customer = "SELECT * FROM acc_customer WHERE user_id=" . $user_id;

                        $result = $conn->query($sql_customer);

                        while ($row = $result->fetch_assoc()) {

                        ?>
                            <option value="<?= $row['customer_name']; ?>">

                            <?php
                        }
                            ?>
                    </datalist>

                    <div class="col-6 col-responsive">
                        <select name="wallet" class="form-select">
                            <option value=""> กระเป๋า | บัญชี </option>

                            <?php
                            $sql_bank = "SELECT * FROM acc_wallet WHERE user_id=" . $user_id;
                            $result = $conn->query($sql_bank);
                            while ($row = $result->fetch_assoc()) {
                            ?>

                                <option value="<?= $row['wallet_id']; ?>"> <?= $row['wallet_name']; ?> </option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="col-6 col-responsive">
                        <select name="status" class="form-select">

                            <option value="">ประเภท</option>
                            <option value="IN">รายรับ</option>
                            <option value="OUT">รายจ่าย</option>

                        </select>
                    </div>

                    <div class="col-6 col-responsive">
                        <select name="bank" class="form-select" id="bank">
                            <option value="">ธนาคาร</option>

                            <?php

                            $sql_bank = "SELECT * FROM acc_bank";

                            $result = $conn->query($sql_bank);
                            while ($row = $result->fetch_assoc()) {

                            ?>

                                <option value="<?= $row['bank_id']; ?>"> <?= $row['bank_name']; ?> </option>

                            <?php } ?>

                        </select>
                    </div>


                    <div class="col-6 col-responsive">

                        <select name="category" class="form-select" id="category">
                            <option value=''> หมวดหมู่สินค้า </option>
                            <?php
                            $sql_category = "SELECT * FROM acc_category WHERE category_id";
                            $result = $conn->query($sql_category);
                            while ($row = $result->fetch_assoc()) {
                            ?>

                                <option value="<?= $row['category_id']; ?>"> <?= $row['category_name']; ?> </option>

                            <?php
                            }
                            ?>

                        </select>

                    </div>

                    <div class="col-6 col-responsive">
                        <input placeholder="ตั้งแต่วันที่" type="select" name="date" id="date" class="form-control" onfocus="(this.type = 'date')">
                    </div>
                    <div class="col-6 col-responsive">
                        <input placeholder="ถึงวันที่" class="form-control" type="select" onfocus="(this.type = 'date')" name="to_date" id="to_date">
                    </div>
                    &emsp;
                    <button class="btn btn-info btn-rounded " type="submit">Search</button>
                </form>

            </div>
                <hr>
                    

            <!-- ตารางโชว์ ผลการค้นหาล่าสุด -->

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">

                            <tr align="center">
                                <th scope="col" style="color: white">บันทึกล่าสุด</th>
                                <th scope="col" style="color: white">วันที่</th>
                                <th scope="col" style="color: white">บัญชี</th>
                                <th scope="col" style="color: white">ประเภท</th>
                                <th scope="col" style="color: white">ธนาคาร</th>
                                <th scope="col" style="color: white">ชื่อลูกค้า</th>
                                <th scope="col" style="color: white">หมวดหมู่</th>
                                <th scope="col" style="color: white">ข้อมูลสินค้า</th>
                                <th scope="col" style="color: white">หมายเหตุ</th>
                                <th scope="col" style="color: white">จำนวนเงิน</th>
                                <th scope="col-1" style="color: white"><i class="fas fa-edit"></i></th>
                                <th style="color: white"><i class="far fa-trash-alt"></i></th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <?php
                                $search_detail = '';
                                $search_wallet = '';
                                $search_status = '';
                                $search_customer = '';
                                $search_category = '';
                                $search_bank = '';
                                $search_create_date = '';
                                $search_to_date = '';
                                
                                if ($_GET) {
                                    require('func/search.php');
                                } else {
                                    require('sql/check_new_record.php');

                                    $result = $conn->query($sql_record);
                                    while ($row = $result->fetch_assoc()) {
                                ?>



                                        <td scope="col-1"><?= $row['record_update_date']; ?></td>
                                        <td><?= $row['record_create_date']; ?></td>

                                        <td><?= $row['wallet_name']; ?></td>

                                        <?php
                                        if ($row['status'] == 'IN') {
                                        ?>

                                            <th scope="row" class="text-success">รายรับ</th>

                                        <?php
                                        } else if ($row['status'] == 'OUT') {
                                        ?>

                                            <th scope="row" class="text-danger">รายจ่าย</th>

                                        <?php
                                        }
                                        ?>

                                        <td><?= $row['bank_name']; ?></td>

                                        <?php
                                        if ($row['customer_name'] != NULL) {
                                        ?>

                                            <td><?= $row['customer_name']; ?></td>

                                        <?php
                                        } else if ($row['customer_name'] == NULL) {
                                        ?>

                                            <td><b>ไม่ระบุ</b></td>

                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($row['category_id'] != 0) {
                                            if ($row['category_id'] != 9) {
                                        ?>

                                                <td><?= $row['category_name']; ?></td>

                                            <?php
                                            } else if ($row['category_id'] == 9) {
                                            ?>
                                                <td><?= $row['order_name']; ?></td>

                                            <?php
                                            }
                                        } else if ($row['category_id'] == 0) {
                                            ?>

                                            <td><b>ไม่ระบุ</b></td>

                                        <?php
                                        }
                                        ?>

                                        <td><?= $row['record_detail']; ?></td>

                                        <td><?= $row['record_comment']; ?></td>

                                        <?php
                                        if ($row['income'] != 0) {
                                        ?>

                                            <td class="text-success"><?= $row['income']; ?></td>

                                        <?php
                                        } else if ($row['income'] == 0) {
                                        ?>

                                            <td class="text-danger"><?= $row['expense']; ?></td>

                                        <?php
                                        }
                                        ?>

                                        <td align="center">

                                        <form action="record_edit.php" method="GET">
                                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                            <input type="hidden" name="record_id" value="<?= $row['record_id']; ?>">
                                            <button type="submit" class="btn btn-warning" name="submit">แก้ไข<i class="fas fa-edit"></i></button>
                                        </form>
                                        </td>
                                        <td align="center">
                                            <a href="func/record_delete.php?record_id=<?= $row['record_id']; ?>" class="btn btn-danger editbtn" role="button " aria-disabled="true" onclick="return confirm('คุณต้องการจะลบบันทึกนี้ใช่หรือไม่?');">
                                                ลบ <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                            </tr>
                    <?php
                                    }
                                }
                    ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        
    
        <hr>
                    <div style="margin: 20px;">
                     <form action="report.php" method="get" class="row row-cols-lg g-1 align-items-center">
                        <input type="hidden" name="detail" value="<?= $search_detail; ?>">
                        <input type="hidden" name="customer" value="<?= $search_customer; ?>">
                        <input type="hidden" name="wallet" value="<?= $search_wallet; ?>">
                        <input type="hidden" name="status" value="<?= $search_status; ?>">
                        <input type="hidden" name="bank" value="<?= $search_bank; ?>">
                        <input type="hidden" name="category" value="<?= $search_category; ?>">
                        <input type="hidden" name="date" value="<?= $search_create_date; ?>">
                        <input type="hidden" name="to_date" value="<?= $search_to_date; ?>">
                        <button type="submit" class="btn btn-dark btn-rounded col-lg"> ส่งผลรายงานข้อมูลที่เลือก <i class="fas fa-file-alt"></i></button>
                    </form>
                    </div>
    
                    
        <hr>
        <br>
        
    </div>
    <?php
        require('controller/footer.php');
        ?>
</body>

</html>