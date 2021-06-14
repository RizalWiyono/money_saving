<?php

include '../../../assets/connection/connection.php';

$date       = $_POST['date'];
$saldo      = $_POST['saldo'];
$note       = $_POST['note'];
$id_biodata = $_POST['id_biodata'];

mysqli_query($connect, "INSERT INTO tb_withdraw (id_withdraw , id_biodata, date, nominal_saldo, note) 
VALUES 
(NULL , '$id_biodata', '$date', '$saldo', '$note')");

header("location: ../?id=$id_biodata");    
