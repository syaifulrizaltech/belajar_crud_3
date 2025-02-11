<?php
session_start();

// Inisialisasi array untuk menyimpan data
if (!isset($_SESSION['data'])) {
  $_SESSION['data'] = array();
}

// Fungsi untuk menampilkan data
function tampilkanData() {
  if (count($_SESSION['data']) == 0) {
    echo "Tidak ada data.";
  } else {
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Umur</th><th>Aksi</th></tr>";
    foreach ($_SESSION['data'] as $key => $value) {
      echo "<tr>";
      echo "<td>" . $value['nama'] . "</td>";
      echo "<td>" . $value['umur'] . "</td>";
      echo "<td><a href='?action=edit&id=" . $key . "'>Edit</a> | <a href='?action=delete&id=" . $key . "'>Hapus</a></td>";
      echo "</tr>";
    }
    echo "</table>";
  }
}

// Fungsi untuk menambahkan data
function tambahData($nama, $umur) {
  $data = array('nama' => $nama, 'umur' => $umur);
  array_push($_SESSION['data'], $data);
}

// Fungsi untuk mengedit data
function editData($id, $nama, $umur) {
  $_SESSION['data'][$id]['nama'] = $nama;
  $_SESSION['data'][$id]['umur'] = $umur;
}

// Fungsi untuk menghapus data
function hapusData($id) {
  unset($_SESSION['data'][$id]);
  // Reset key array agar berurutan kembali
  $_SESSION['data'] = array_values($_SESSION['data']);
}

// Proses aksi CRUD
if (isset($_GET['action'])) {
  $action = $_GET['action'];

  if ($action == "tambah") {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    tambahData($nama, $umur);
    header("Location: ?"); // Redirect untuk refresh halaman
    exit();
  } elseif ($action == "edit") {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    editData($id, $nama, $umur);
    header("Location: ?"); // Redirect untuk refresh halaman
    exit();
  } elseif ($action == "delete") {
    $id = $_GET['id'];
    hapusData($id);
    header("Location: ?"); // Redirect untuk refresh halaman
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>CRUD Sederhana Tanpa Database</title>
</head>
<body>
  <h1>Data</h1>

  <?php tampilkanData(); ?>

  <h2>Tambah Data</h2>
  <form method="post" action="?action=tambah">
    Nama: <input type="text" name="nama" required><br>
    Umur: <input type="number" name="umur" required><br>
    <input type="submit" value="Tambah">
  </form>

  <?php
  if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $id = $_GET['id'];
    $data = $_SESSION['data'][$id];
    ?>
    <h2>Edit Data</h2>
    <form method="post" action="?action=edit&id=<?php echo $id; ?>">
      Nama: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required><br>
      Umur: <input type="number" name="umur" value="<?php echo $data['umur']; ?>" required><br>
      <input type="submit" value="Simpan">
    </form>
    <?php
  }
  ?>

</body>
</html>