<?php
    include 'service/database.php';

    // inport
    session_start();

    // memberi pesan
    $login_message = "";

    if(isset($_SESSION['is_login'])){
        header("location: dashboar.php");
    }
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash('sha256', $password);

        // pilih semua filter dari tabel users dimana usernamenya didalam $
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";

        // tampungan data
        // untuk mengeksekusi query yang kita punya
        $result = $db->query($sql);
        // jika usernam dan pass ada didalam database kita akan melakukan 
        if($result->num_rows > 0){
            //mengeluarin data yang ada di database
            $data = $result->fetch_assoc();
            // echo "Data Username Adalah : " . $data['username'];
            // echo "Data Username Adalah : " . $data['password'];
            //sesion
            $_SESSION['username'] = $data['username'];
            // sesion udah login blm
            $_SESSION['is_login'] = true ;
            // untuk mengarahkan ke dashboar
            header('location: dashboar.php');
        }else{
            $login_message = "akun tidak ada";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'layout/header.html'?>
    <h3>Masuk AKUN</h3>
    <i><?= $login_message ?></i><hr>
    <form action="login.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="text" placeholder="password" name="password"/>
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>
    <?php include 'layout/footer.html'?>
</body>
</html>