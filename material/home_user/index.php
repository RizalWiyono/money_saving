<?php
    session_start();
    
    if(!isset($_SESSION['email']) ) {
        header('location: ../login/');
        exit;
    }else{
        if($_SESSION['role'] !== 'User'){
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
    <title>Home Page</title>

    <!-- Icon -->
    <link rel="shortcut icon" href="../../assets/image/Flaticon.svg">

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
                <img style="width: 4vw;" src="../../assets/image/Man-Image.svg" alt="">

                <div class="name-title-container">
                    <?php $id_account = $_SESSION['id_account'];
                    $query_biodata  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_account='$id_account'");
                    while($row = mysqli_fetch_array($query_biodata)){ 
                    $name = $row['name'];?>
                    <h1 style="margin-top: 1vw;"><?=$row['name'];?></h1>
                    <?php } ?>
                    <p>Siswa</p>
                </div>
            </div>

            <ul>
                <li class="menu-active"><a href="#" class="menu-active">Saldo</a></li>
                <li><a href="../data_report_user/">Laporan</a></li>
                <li><a></a></li>
            </ul>

            <a href="../login/process/logout.php" class="btn-logout">Logout</a>
        </header>

        <main>
            <div class="header-title">
                <h1>Data Mahasiswa</h1>
            </div>

            <div class="main-content flex-space">
                <div class="place-80" align="center">
                    <h3 style="text-align: left; font-weight: 700; color: #000;">Riwayat Tabungan</h3>
                        <table class="table table-striped">
                            <thead class="bg-green">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Hari/Tanggal</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $param = $_SESSION['id_account'];
                            $query_history = mysqli_query($connect, "select nominal_saldo as saldo, id_add_saldo AS id, date AS date_saldo, 'saldo' AS note from tb_add_saldo  WHERE id_biodata=$param
                            union all
                            select nominal_saldo as withdraw, id_withdraw AS id, date AS date_saldo, 'withdraw' AS note from tb_withdraw  WHERE id_biodata=$param");
                            while($row = mysqli_fetch_array($query_history)){ ?>
                                <tr>
                                    <td><?=$name?></td>
                                    <td><?=$row['date_saldo']?></td>
                                    <td><?=$row['saldo']?></td>
                                    <td><?=$row['note']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                </div>

                <div class="place-20" align="center">
                    <p class="mt-3"><strong>Saldo Saat Ini</strong></p>
                    <?php $query_withdraw_param  = mysqli_query($connect, "SELECT SUM(nominal_saldo) as saldo FROM `tb_withdraw` WHERE id_biodata='$param'");
                    while($row = mysqli_fetch_array($query_withdraw_param)){ 
                        $min_saldo = $row['saldo'];

                        $query_saldo  = mysqli_query($connect, "SELECT SUM(nominal_saldo) as saldo FROM `tb_add_saldo` WHERE id_biodata='$param'");
                        while($data = mysqli_fetch_array($query_saldo)){ 
                            $total_saldo = $data['saldo']-$min_saldo;
                            echo "<h1 style='color: #2DE38E; font-weight: 700; font-size: 2vw;'>Rp. ".$total_saldo."</h1>";
                        } 
                    }?>

                    <p class="mt-5"><strong>Penarikan Saat Ini</strong></p>
                    <?php $query_withdraw  = mysqli_query($connect, "SELECT SUM(nominal_saldo) as saldo FROM `tb_withdraw` WHERE id_biodata='$param'");
                    while($row = mysqli_fetch_array($query_withdraw)){ 
                        echo "<h1 style='color: #2DE38E; font-weight: 700; font-size: 2vw;'>Rp. ".$row['saldo']."</h1>";
                    } ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>