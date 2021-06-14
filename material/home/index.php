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
    <title>Home Page</title>

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
                <li class="menu-active"><a href="#" class="menu-active">Data Siswa</a></li>
                <li><a href="../data_report/">Laporan</a></li>
                <li><a href="../add_user/">Tambah Siswa</a></li>
            </ul>

            <a href="../login/process/logout.php" class="btn-logout">Logout</a>
        </header>

        <main>
            <div class="header-title">
                <h1>Data Mahasiswa</h1>
            </div>

            <div class="main-content flex-space">
                <div class="place-80" align="center">
                    <table class="table table-striped">
                        <thead class="bg-green">
                            <tr>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">ID</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $query_biodata  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_account!=1");
                        while($row = mysqli_fetch_array($query_biodata)){ ?>
                            <tr>
                                <td><?=$row['name']?></td>
                                <td><?=$row['code_student']?></td>
                                <td><?=$row['class']?></td>
                                <td><?=$row['email']?></td>
                                <td><a href="?id=<?=$row['id_biodata']?>">Detail</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="place-20" align="center">
                    <?php if(isset($_GET['id'])){ ?>
                        <img src="../../assets/image/Man-Image.svg" alt="">
                        <?php $id_param = $_GET['id'];
                        $query_biodata_right  = mysqli_query($connect, "SELECT * FROM tb_biodata WHERE id_biodata=$id_param && id_account!=1");
                        while($row = mysqli_fetch_array($query_biodata_right)){ ?>  

                        <h1 class="name-siswa"><?=$row['name']?></h1>
                        <p class="title-siswa">Siswa</p>

                        <table class="biodata-right" style="margin: 0 5% 15% 5%;">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td><p>: <?=$row['code_student']?></p></td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td><p>: <?=$row['class']?></p></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><p>: <?=$row['email']?></p></td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td><p>: <?=$row['no_telp']?></p></td>
                                </tr>
                                <tr>
                                    <th >Address</th>
                                    <td><p>: <?=$row['address']?></p></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <a href="../add_saldo/?id=<?=$_GET['id']?>" class="btn-green">Tambah Saldo</a>
                    <?php }else{} ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>