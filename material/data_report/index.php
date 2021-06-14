<?php
    session_start();
    
    if(!isset($_SESSION['email']) ) {
        header('location: ../login/');
        exit;
    }else{
        if($_SESSION['role'] !== 'Admin'){
            header('location: ../login/');
        }else{}
    }

    include '../../assets/connection/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Page</title>

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Style Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="main-container">
        <header>
            <div class="identity">
                <img src="../../assets/image/Man-Image.svg" alt="">

                <div class="name-title-container">
                    <?php $id_account = $_SESSION['id_account'];
                    $query_biodata  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_account='$id_account'");
                    while($row = mysqli_fetch_array($query_biodata)){ ?>
                    <h1><?=$row['name'];?></h1>
                    <?php } ?>
                    <p>Administrator</p>
                </div>
            </div>

            <ul>
                <li><a href="../home/">Data Siswa</a></li>
                <li class="menu-active"><a href="#" class="menu-active">Laporan</a></li>
                <li><a href="../add_user/">Tambah Siswa</a></li>
            </ul>

            <a href="../login/process/logout.php" class="btn-logout">Logout</a>
        </header>

        <main>
            <div class="header-title">
                <h1>Laporan Hasil Tabungan Tahun 2021</h1>
            </div>

            <div class="main-content">
                <?php $id_account = $_SESSION['id_account'];
                $query_saldo  = mysqli_query($connect, "SELECT SUM(nominal_saldo) as Max_Saldo , DATE_FORMAT(date, '%m') as Month, DATE_FORMAT(date, '%M') as Month_Name FROM `tb_add_saldo` GROUP BY DATE_FORMAT(date, '%m')");
                while($row = mysqli_fetch_array($query_saldo)){ 
                    $param_month = $row['Month'];
                    $query_withdraw  = mysqli_query($connect, "SELECT SUM(nominal_saldo) as Min_Saldo FROM `tb_withdraw` WHERE month(date) = '$param_month'");
                    while($data = mysqli_fetch_array($query_withdraw)){ ?>

                <?php $month = $row['Month_Name'] ?>
                
                <div class="main-report">
                    <p>Bulan: <strong><?=$row['Month_Name']?></strong></p>

                    <div class="content-report flex-space">
                        <div class="place-report">
                            <strong>Total Tabungan Siswa</strong>
                            <h1 class="value-content">Rp.<?=$row['Max_Saldo']?></h1>
                        </div>
                        <div class="place-report">
                            <strong>Pengeluaran</strong>
                            <h1 class="value-content">Rp.<?=$data['Min_Saldo']?></h1>
                        </div>
                        <div class="place-report-green">
                            <strong>Sisa Tabungan</strong>
                            <h1 class="value-content">Rp.<?=$row['Max_Saldo']-$data['Min_Saldo']?></h1>
                        </div>
                    </div>
                </div>
                <?php } 
                } ?>
            </div>
        </main>
    </div>
</body>
</html>