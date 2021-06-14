<?php

include '../../../assets/connection/connection.php';

$name       = $_POST['name'];
$id         = $_POST['id'];
$class      = $_POST['class'];
$email      = $_POST['email'];
$address    = $_POST['address'];
$telp       = $_POST['telp'];
$id_biodata = $_POST['id_biodata'];

mysqli_query($connect, "UPDATE tb_biodata SET name='$name', class='$class', email='$email', address='$address', no_telp='$telp' WHERE id_biodata='$id'");

header("location: ../?id=$id_biodata");    
