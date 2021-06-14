<?php

include '../../../assets/connection/connection.php';

$date       = $_POST['date'];
$saldo      = $_POST['saldo'];
$id_biodata = $_POST['id_biodata'];

mysqli_query($connect, "INSERT INTO tb_add_saldo (id_add_saldo , id_biodata, date, nominal_saldo) 
VALUES 
(NULL , '$id_biodata', '$date', '$saldo')");

header("location: ../?id=$id_biodata");    
