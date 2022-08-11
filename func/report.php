<?php
if($_GET){
$search_detail = $_GET['detail'];
$search_customer = $_GET['customer'];
$search_wallet = $_GET['wallet'];
$search_status = $_GET['status'];
$search_bank = $_GET['bank'];
$search_category = $_GET['category'];
$search_create_date = $_GET['date'];
$search_to_date = $_GET['to_date'];

$case_detail = '';
$case_wallet = '';
$case_status = '';
$case_customer = '';
$case_category = '';
$case_bank = '';
$case_create_date = '';
$case_to_date = '';

if ($search_detail != NULL) {
    $case_detail = 'AND acc_record.record_detail LIKE "' . $search_detail . '%"';
}

if ($search_customer != NULL) {
    $case_customer = 'AND acc_customer.customer_name LIKE "' . $search_customer . '%"';
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
    
    $sql_report = 'SELECT acc_record.*,
    acc_wallet.wallet_name,acc_customer.customer_name,
    acc_category.category_name,acc_category_order.order_name,
    acc_bank.bank_name
    FROM 
         acc_record
     
     LEFT JOIN
         acc_customer
     ON 
         acc_record.customer_id = acc_customer.customer_id
    
     INNER JOIN
         acc_wallet
     ON
     acc_record.wallet_id = acc_wallet.wallet_id
    
     LEFT JOIN
     acc_category
     ON
     acc_record.category_id = acc_category.category_id
    
     LEFT JOIN
     acc_category_order
     ON
     acc_record.order_id = acc_category_order.order_id
    
     INNER JOIN
     acc_bank
     ON
     acc_record.bank_id = acc_bank.bank_id
    
     WHERE acc_record.user_id = ' . $user_id . '
     ' . ' ' . $case_detail . '  ' .  $case_customer . '  
     ' . ' ' . $case_wallet . ' ' . $case_status . ' ' . $case_category . ' ' . $case_bank . ' 
     ' . ' ' . $case_create_date . ' ' . $case_to_date . ' 
    
     GROUP BY acc_record.record_id
     ORDER BY acc_record.record_create_date ASC';
require('sql/sql_total.php');
}

require('sql/sql_show_index.php');

?>