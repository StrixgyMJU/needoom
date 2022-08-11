<?php
$servername = "localhost"; //ชื่อขึ้นต้นหน้าเว็บ
$username = "root"; // root คือค่าต้นของการเรียกชื่อ ตัว sql
$password = ""; //ถ้าไม่มีก็ว่างไว้
$account = "needoom_beta"; // เรียกฐานข้อมูลใน sql


// Create connection
$conn = new mysqli($servername, $username, $password, $account);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}









?>
