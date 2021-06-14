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
    <title>Edit Profile</title>

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Style Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    
</head>
<body style="overflow-x: hidden;">
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
                    <p>Siswa</p>
                </div>
            </div>

            <ul>
                <li><a href="../home/">Data Siswa</a></li>
                <li><a href="../data_report/">Laporan</a></li>
                <li><a href="../add_user/">Tambah Siswa</a></li>
            </ul>

            <a href="../login/process/logout.php" class="btn-logout">Logout</a>
        </header>

        <main>
            <div class="header-title flex-space">
                <div class="width-40">
                    <a href="../add_saldo/?id=<?=$_GET['id']?>">Tambah Saldo</a>
                    <a href="../withdraw/?id=<?=$_GET['id']?>">Pengeluaran</a>
                    <a href="../edit_profile/?id=<?=$_GET['id']?>">Edit Profile</a>
                    <a href="#" class="sub-menu-active" >History</a>
                </div>
                <?php $param = $_GET['id'];
                $query_biodata  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_biodata=$param");
                while($row = mysqli_fetch_array($query_biodata)){ 
                $name = $row['name']; ?>
                <strong><?=$row['name']?></strong>
                <?php } ?>
            </div>

            <div class="main-content">
                <div class="main-report flex-space">
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
                        <?php $query_history  = mysqli_query($connect, "select nominal_saldo as saldo, id_add_saldo AS id, date AS date_saldo, 'saldo' AS note from tb_add_saldo  WHERE id_biodata=$param
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
                    <img src="../../assets/image/Image1.svg" alt="" style="position: fixed; bottom: -20%; right: -15%; z-index: -1;">
                </div>
                
            </div>
        </main>
    </div>
</body>
</html>