<?php 

$sql_today = "SELECT SUM(income) ,  SUM(expense) , CURDATE() AS today ,status
FROM 
    acc_record

WHERE acc_record.user_id = ". $user_id ." 
AND acc_record.record_create_date = CURDATE()";

?>

<?php 

$sql_new = 'SELECT acc_record.*,
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

 WHERE acc_record.user_id = '. $user_id . '
    AND acc_record.record_create_date = CURDATE()
 GROUP BY acc_record.record_id
 ORDER BY acc_record.record_create_date DESC';

?>


<?php

$sql_allsum = "SELECT SUM(income) ,  SUM(expense) , CURDATE() AS today

FROM 
    acc_record

WHERE acc_record.user_id = ". $user_id ;

?>

<?php

$sql_wallet = "SELECT acc_wallet.wallet_name, SUM(income) , SUM(expense) 

FROM acc_record 

INNER JOIN acc_wallet 
ON acc_record.wallet_id = acc_wallet.wallet_id

 WHERE acc_record.user_id = " . $user_id . " GROUP BY acc_wallet.wallet_id " ;

?>

<?php

$sql_collum = "SELECT YEAR(record_create_date), record_create_date, SUM(income) , SUM(expense) 

FROM acc_record 

WHERE acc_record.user_id = " . $user_id . "

AND (record_create_date BETWEEN '2022-01-1' AND '2022-12-31') 

GROUP BY YEAR(record_create_date) ,MONTH(record_create_date)";

?>