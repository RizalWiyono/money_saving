<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="main-container-login">
        <div class="left-section-login" align="right">
            <h1>Ayo Menabung</h1>
            <h2>Sekarang Juga!</h2>
            <p>Mudah, Aman, Sukses</p>
            <img src="../../assets/image/Image-Login.svg" alt="">
        </div>
        <div class="right-section-login">
            <form action="process/auth.php" method="POST" style="width: 100%;">
                <h1>Masuk</h1>

                <h2>Email</h2>
                <input type="email" name="email" class="form-login" required>

                <h2>Password</h2>
                <input type="password" name="pass" class="form-login" required> 

                <input type="submit" value="Masuk" class="btn-green">
            </form>

            <?php if(isset($_GET['error'])) {?>
                <p class="error-message">Email or Password Wrong! Please input again.</p>
            <?php }else{} ?>
        </div>
    </div>
</body>
</html>