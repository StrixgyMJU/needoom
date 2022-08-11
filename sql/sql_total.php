<?php
$sql_total = 'SELECT acc_record.*, SUM(income) ,  SUM(expense),
acc_customer.customer_name

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

 ORDER BY acc_record.record_create_date ASC';
?>