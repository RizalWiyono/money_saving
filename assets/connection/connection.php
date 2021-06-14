<?php
$connect = mysqli_connect("localhost","root","","db_money");

if (mysqli_connect_errno())
{
    echo "Koneksi Error : " . mysqli_connect_error();
}

?>

