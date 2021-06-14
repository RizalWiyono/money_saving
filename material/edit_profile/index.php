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
                    <p>Administrator</p>
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
                    <a class="sub-menu-active" href="#">Edit Profile</a>
                    <a href="../history/?id=<?=$_GET['id']?>">History</a>
                </div>
                <?php $param = $_GET['id'];
                $query_biodata  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_biodata=$param");
                while($row = mysqli_fetch_array($query_biodata)){ ?>
                <strong><?=$row['name']?></strong>
                <?php } ?>
            </div>

            <div class="main-content">
                <div class="main-report flex-space">
                    <form action="process/update_data.php" method="POST" style="width: 100%;">
                    <?php $query_biodata  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_biodata='$param'");
                    while($row = mysqli_fetch_array($query_biodata)){ ?>
                        <div class="width-90">
                            <p>Nama Siswa :</p>
                            <input type="text" name="name" class="form-data" value="<?=$row['name']?>">
                            <input type="text" name="id_biodata" value="<?=$_GET['id']?>" readonly style="display: none;">
                        </div>

                        <div class="width-90 mt-3">
                            <p>ID :</p>
                            <input type="text" class="form-data"  value="ID-<?=$row['code_student']?>" readonly>
                            <input type="text" name="id" class="form-data"  value="<?=$row['id_biodata']?>" readonly style="display: none;">
                        </div>

                        <div class="width-90 mt-3">
                            <p>Kelas :</p>
                            <input type="text" name="class" class="form-data" value="<?=$row['class']?>">
                        </div>

                        <div class="width-90 mt-3">
                            <p>Email :</p>
                            <input type="text" name="email" class="form-data" value="<?=$row['email']?>">
                        </div>

                        <div class="width-90 mt-3">
                            <p>Alamat :</p>
                            <input type="text" name="address" class="form-data" value="<?=$row['address']?>">
                        </div>

                        <div class="width-90 mt-3">
                            <p>No Telepon :</p>
                            <input type="text" name="telp" class="form-data" value="<?=$row['no_telp']?>">
                        </div>

                        <?php } ?>
                        <input type="submit" value="Simpan" class="btn-green mt-5" style="padding: 0.5% 2%; border: 0;">
                    </form>
                    <img src="../../assets/image/Image1.svg" alt="" style="position: fixed; bottom: -20%; right: -15%; z-index: -1;">
                </div>
                
            </div>
        </main>
    </div>
</body>
</html>