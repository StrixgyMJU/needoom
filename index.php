<!DOCTYPE html>
<html lang="en">

<head>

    <title>หน้าหลัก-Need Oom</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    
    require('sql/connect.php');
    session_start();
    if(isset($_SESSION["my_name"]["id"]) && $_SESSION["my_name"]["type"] == 1){
        header('location: admin.php');
        }
    require('controller/session.php');

    require('API/collum_chart.php');
    ?>
</head>

<body style="background-color:#f1f1f1; padding-bottom: 50px">
    <div class="container">
        <main>
            <div class="container-fluid">
                <!-- เว้นช่องข้างบน -->
                <div class="mt-4"></div>

                <div class="card mb-4">

                    <div class="card-header">

                        สรุปภาพรวมของบัญชีผู้ใช้ <i class="fa-solid fa-user"></i> : <?= $_SESSION["my_name"]["name"] ?>

                    </div>

                    <div class="card-body">
                        <?php

                        require('sql/sql_show_index.php');
                        $result_today = $conn->query($sql_today);
                        $row_today = $result_today->fetch_array(MYSQLI_ASSOC);
                        $income_today = $row_today['SUM(income)'];
                        $expense_today = $row_today['SUM(expense)'];

                        ?>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">รายรับวันนี้</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <?php

                                        if ($income_today != 0) {

                                            echo $income_today;
                                        } else {
                                            echo '0.00';
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">รายจ่ายวันนี้</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                        <?php

                                        if ($expense_today != 0) {

                                            echo $expense_today;
                                        } else {
                                            echo '0.00';
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">ยอดรวมทั้งหมดของแต่บะบัญชี </div>
                                    <?php
                                    $result_wallet = $conn->query($sql_wallet);
                                    while ($row_wallet = $result_wallet->fetch_assoc()) {
                                        $total = $row_wallet['SUM(income)'] - $row_wallet['SUM(expense)'];
                                    ?>

                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <?= 'บัญชี ' . $row_wallet['wallet_name'] . ' คงเหลือ ' .
                                                $total . ' บาท ' ?>
                                        </div>

                                    <?php

                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!--Div that will hold the pie chart-->
                        <div class="fw-bold">สรุปยอดทั้งหมดในปีนี้</div>
                        <?php
                        require('sql/sql_show_index.php');
                        $result = $conn->query($sql_collum);
                        $row = $result->fetch_assoc();
                        if($row['record_create_date'] != NULL){
                        ?>
                        <div id="columnchart_material" class="col-lg" style="width: 100%; height: 300px; "></div>
                    <?php
                    }else{
                        
                        echo '<br> '.' ยังไม่ได้บันทึกข้อมูล ' ;
                    }
                    ?>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <?php
    require('controller/footer.php');
    ?>

</body>

</html>