<?php

include '../../../assets/connection/connection.php';

$name       = $_POST['name'];
$class      = $_POST['class'];
$email      = $_POST['email'];
$address    = $_POST['address'];
$telp       = $_POST['telp'];
$pass       = md5($_POST['pass']);

mysqli_query($connect, "INSERT INTO tb_account (id_account , email, pass, role) 
VALUES 
(NULL , '$email', '$pass', 'User')");

$query_biodata  = mysqli_query($connect, "SELECT * FROM tb_account WHERE email='$email'");
while($row = mysqli_fetch_array($query_biodata)){
    $id_account = $row['id_account'];

    mysqli_query($connect, "INSERT INTO tb_biodata (id_biodata , id_account, code_student, name, class, email, address, no_telp) 
    VALUES 
    (NULL , '$id_account', '$id_account', '$name', '$class', '$email', '$address', '$telp')");
}

header("location: ../../home/");    
