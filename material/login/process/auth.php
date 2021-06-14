<?php
    session_start();
    include '../../../assets/connection/connection_lo.php';
    $pass = md5($_POST['pass']);  
    $email = $_POST['email'];  

        $sql = $pdo->prepare("SELECT * FROM tb_account WHERE email=:a AND pass=:b");
        $sql->bindParam(':a', $email);
        $sql->bindParam(':b', $pass);
        $sql->execute(); 
        
        $data = $sql->fetch();

        // echo "<pre>";
        //     print_r($data);
        // echo "</pre>";

        if(!empty($data)){ 
            $_SESSION['pass'] = $data['pass']; 
            $_SESSION['email'] = $data['email']; 
            $_SESSION['role'] = $data['role']; 
            $_SESSION['id_account'] = $data['id_account']; 
            
            if($_SESSION['role'] == 'Admin'){
                header("location: ../../home/");
            }else{
                header("location: ../../home_user/");
            }
        }else{ 
            header("location: ../../login/?error=Login Failed");
        }
?>  

