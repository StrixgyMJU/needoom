<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORD-OOMDEE</title>

    <?php
    require('sql/connect.php');
    session_start();
    require('controller/session.php');
    if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
        header('location: admin.php');
        }
    $count = 0;
    ?>
</head>

<body class="body" style="background-color:#f1f1f1">
    <div class="container" style="padding-bottom: 50px;">
        <div class="card mb-4" style="margin: 20px;">
            <div class="card-header">
                <i class="fas fa-edit"></i>
                สรุปรายงาน
            </div>
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm" style="margin-top: 20px; margin-bottom: 30px;">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="color: white">เวลาที่บันทึก</th>
                                <th scope="col" style="color: white">ชื่อลูกค้า</th>
                                <th scope="col" style="color: white">หมวดหมู่</th>
                                <th scope="col" style="color: white">ข้อมูลสินค้า</th>
                                <th scope="col" style="color: white">หมายเหตุ</th>
                                <th scope="col" style="color: white">รายรับ</th>
                                <th scope="col" style="color: white">รายจ่าย</th>
                                <!-- <th scope="col" style="color: white"> </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php

                                if ($_GET) {

                                    require('func/report.php');
                                    $result = $conn->query($sql_report);
                                    while ($row = $result->fetch_assoc()) {
                                        $count++;
                                ?>
                                        <td><?= $row['record_create_date']; ?></td>

                                        <?php
                                        if ($row['customer_name'] != NULL) {
                                        ?>

                                            <td><?= $row['customer_name']; ?></td>

                                        <?php
                                        } else if ($row['customer_name'] == NULL) {
                                        ?>

                                            <td><b style="color: red;">ไม่ระบุ</b></td>

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

                                            <td><b style="color: red;">ไม่ได้ระบุ</b></td>

                                        <?php
                                        }
                                        ?>

                                        <td><?= $row['record_detail']; ?></td>

                                        <td><?= $row['record_comment']; ?></td>

                                        <?php
                                        if ($row['income'] != 0) {
                                        ?>

                                            <td class="text-success"><?= $row['income']; ?></td>
                                            <td class="text">0.00</td>
                                        <?php
                                        } else if ($row['income'] == 0) {
                                        ?>
                                            <td class="text">0.00</td>
                                            <td class="text-danger"><?= $row['expense']; ?></td>

                                        <?php
                                        }
                                        ?>
                            </tr>

                        <?php

                                    }


                        ?>

                        </tbody>

                        <tfoot>
                            <tr style="height:50px">
                                <td colspan="5"></td>
                                <?php
                                    $result = $conn->query($sql_total);
                                    $row = $result->fetch_array(MYSQLI_ASSOC);
                                    $income = $row['SUM(income)'];
                                    $expense = $row['SUM(expense)'];

                                    if ($row['status'] == 'IN' && $income > $expense) {

                                        $total = $income - $expense;
                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-success"><?= $total; ?></th>
                                <?php

                                    } else if ($row['status'] == 'IN' && $income < $expense) {

                                        $total = $expense - $income;

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-danger">- <?= $total; ?></th>

                                <?php

                                    } else if ($row['status'] == 'IN' && $income = $expense) {

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text">0</th>

                                <?php

                                    } else if ($row['status'] == 'OUT' && $income > $expense) {
                                        $total = $income - $expense;

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-success"><?= $total; ?></th>
                                <?php

                                    } else if ($row['status'] == 'OUT' && $income < $expense) {
                                        $total = $expense - $income;

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-danger">- <?= $total; ?></th>

                                <?php

                                    } else if ($row['status'] == 'OUT' && $income = $expense) {

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text">0</th>
                                <?php

                                    } else {

                                ?>

                                    <th scope="row" class="text">ยังไม่มีการบันทึกรายงานในวันนี้</th>

                                <?php

                                    }
                                }

                                // ถ้าไม่มีการส่งข้อมูลมาให้โชว์ของวันนี้

                                if ($count == 0) {
                                    require('func/report.php');
                                    $result = $conn->query($sql_new);
                                    while ($row = $result->fetch_assoc()) {

                                ?>

                                    <td><?= $row['record_create_date']; ?></td>

                                    <?php
                                        if ($row['customer_name'] != NULL) {
                                    ?>

                                        <td><?= $row['customer_name']; ?></td>

                                    <?php
                                        } else if ($row['customer_name'] == NULL) {
                                    ?>

                                        <td><b style="color: red;">ไม่ระบุ</b></td>

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

                                        <td><b style="color: red;">ไม่ได้ระบุ</b></td>

                                    <?php
                                        }
                                    ?>

                                    <td><?= $row['record_detail']; ?></td>

                                    <td><?= $row['record_comment']; ?></td>

                                    <?php
                                        if ($row['income'] != 0) {
                                    ?>

                                        <td class="text-success"><?= $row['income']; ?></td>
                                        <td class="text">0.00</td>
                                    <?php
                                        } else if ($row['income'] == 0) {
                                    ?>
                                        <td class="text">0.00</td>
                                        <td class="text-danger"><?= $row['expense']; ?></td>

                                    <?php
                                        }
                                    ?>
                            </tr>

                        <?php

                                    }


                        ?>

                        </tbody>

                        <tfoot>
                            <tr style="height:50px">
                                <td colspan="5"></td>
                                <?php
                                    $result = $conn->query($sql_today);
                                    $row = $result->fetch_array(MYSQLI_ASSOC);
                                    $income = $row['SUM(income)'];
                                    $expense = $row['SUM(expense)'];
                                    $count_new = 1;
                                    if ($row['status'] == 'IN' && $income > $expense) {

                                        $total = $income - $expense;
                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-success"><?= $total; ?></th>
                                <?php

                                    } else if ($row['status'] == 'IN' && $income < $expense) {

                                        $total = $expense - $income;

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-danger">- <?= $total; ?></th>

                                <?php

                                    } else if ($row['status'] == 'IN' && $income = $expense) {

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text">0</th>

                                <?php

                                    } else if ($row['status'] == 'OUT' && $income > $expense) {
                                        $total = $income - $expense;

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-success"><?= $total; ?></th>
                                <?php

                                    } else if ($row['status'] == 'OUT' && $income < $expense) {
                                        $total = $expense - $income;

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text-danger">- <?= $total; ?></th>

                                <?php

                                    } else if ($row['status'] == 'OUT' && $income = $expense) {

                                ?>
                                    <th scope="row" class="text-b">รวม</th>

                                    <th scope="row" class="text">0</th>
                                <?php

                                    } else {

                                ?>

                                    <th scope="row" class="text">ลองทำรายการใหม่อีกครั้ง</th>

                                <?php

                                    }

                                ?>

                            <?php
                                } 
                               
                            ?>
                            
                            </tr>
                        </tfoot>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <?php
    require('controller/footer.php');
    ?>
</body>

</html>