<?php
    session_start();
    //untuk logout  
    if(isset($_POST['logout'])){
        //untuk clear data
        session_unset();
        //untuk mengapus data
        session_destroy();
        // kembali ke header
        header('location: index.php');
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

    <h3>Selamat Datang "<?= $_SESSION['username']?>" </h3>

    <form action="dashboar.php" method="POST">
        <button type="sumbit" name="logout">Keluar</button>
    </form>

    <?php include 'layout/footer.html'?>
</body>
</html>