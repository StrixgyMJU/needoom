<?php
if (isset($_GET['check'])) {
    $search_detail = $_GET['search_detail'];
    $search_customer = $_GET['customer'];
    $search_wallet = $_GET['wallet'];
    $search_status = $_GET['status'];
    $search_bank = $_GET['bank'];
    $search_category = $_GET['category'];
    $search_create_date = $_GET['date'];
    $search_to_date = $_GET['to_date'];
}

$case_detail = '';
$case_wallet = '';
$case_status = '';
$case_customer = '';
$case_category = '';
$case_bank = '';
$case_create_date = '';
$case_to_date = '';

if ($search_detail != NULL) {
    $case_detail = 'AND acc_record.record_detail LIKE "%' . $search_detail . '%"';
}

if ($search_customer != NULL) {
    $case_customer = 'AND acc_customer.customer_name LIKE "%' . $search_customer . '%"';
}

if ($search_wallet != NULL) {
    $case_wallet = 'AND acc_wallet.wallet_id=' . $search_wallet;
}

if ($search_status != NULL) {
    $case_status = 'AND acc_record.status="' . $search_status . '"';
}

if ($search_category != NULL) {
    $case_category = 'AND acc_record.category_id=' . $search_category;
}
if ($search_bank != NULL) {
    $case_bank = 'AND acc_record.bank_id=' . $search_bank;
}
if ($search_create_date != NULL) {
    $case_create_date = 'AND acc_record.record_create_date >="' . $search_create_date . '"';
}
if ($search_to_date != NULL) {
    $case_to_date = 'AND acc_record.record_create_date <="' . $search_to_date . '"';
}

require('sql/sql_search.php');
$count = 0;
$result = $conn->query($sql_search);
while ($row = $result->fetch_assoc()) {
    $count++;

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

        <td><b style="color: red;">ไม่ระบุ</b></td>

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
if ($count == 0) {

    if ($_SESSION["my_name"]["type"] == 1) {
        $message = "ไม่ข้อมูลที่คุณกำลังค้นหา";
        echo "<script> alert('$message'); window.location='admin.php'; </script>";
    }

    $message = "ไม่ข้อมูลที่คุณกำลังค้นหา";
    echo "<script> alert('$message'); window.location='search.php'; </script>";
}
?>