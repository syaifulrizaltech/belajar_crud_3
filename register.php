<?php
    include 'service/database.php';
    session_start();
    
    $register_message = "";

    if(isset($_SESSION['is_login'])){
        header('location: dashboar.php');
    }

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        // biar orang tidak tau paswod kita
        $hash_password = hash("sha256", $password);

        //ketika eror maka yang di munculkan catch
        try{
            $sql = "INSERT INTO users (username, password) VALUE ('$username', '$hash_password')";
            if($db->query($sql)){
                $register_message = "Daftar Akun Berhasil, Silahkan Login";
            }else{
                $register_message = "Daftar Akun Gagal, Coba Lagi";
            }
        }catch(mysqli_sql_exception){
            $register_message = "Akun sudah ada, silahkan gnati yang lain";
        }
        // selesai menjalankan query
        $db->close();

        // variable penampung 
        // artinya kita akan membaca data ke tabel users, dengan name(user,password) yang bernilai variable $
        // $sql = "INSERT INTO users (username, password) VALUE ('$username', '$password')";

        // eksekusi meberitahu bawa datanya berhasil 
        // if($db->query($sql)){
        //     $register_message = "Daftar Akun Berhasil, Silahkan Login";
        // }else{
        //     $register_message = "Daftar Akun Gagal, Coba Lagi";
        // }

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
    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i><hr>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="text" placeholder="password" name="password"/>
        <button type="sumbit" name="register">Daftar Sekarang</button>
    </form>
    <?php include 'layout/footer.html'?>
</body>
</html>