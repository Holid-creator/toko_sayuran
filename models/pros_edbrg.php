<?php
ob_start();
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/m_barang.php";

$conn = new Database($host, $user, $pass, $database);
$brg = new M_barang($conn);

$id_brg = $_POST['id_brg'];
$n_brg = $conn->con->real_escape_string($_POST['n_brg']);
$hrg_brg = $conn->con->real_escape_string($_POST['hrg_brg']);
$stok_brg = $conn->con->real_escape_string($_POST['stok_brg']);

$pict = $_FILES['img_brg']['name'];
$extensi = explode(".", $_FILES['img_brg']['name']);
$img_brg = "YL-" . round(microtime(true)) . "." . end($extensi);
$sumber = $_FILES['img_brg']['tmp_name'];

if ($pict == '') {
  $brg->edit("UPDATE tb_barang SET n_brg = '$n_brg', hrg_brg = '$hrg_brg', stok_brg = '$stok_brg' WHERE id_brg = '$id_brg'");
  echo "<script>alert('Data Berhasil Diubah'); window.location = '?page=barang'</script>";
} else {
  $img_st = $brg->tampil($id_brg)->fetch_object()->img_brg;
  unlink('../uploads/products/' . $img_st);

  $upload = move_uploaded_file($sumber, "../uploads/products/" . $img_brg);
  if ($upload) {
    $brg->edit("UPDATE tb_barang SET n_brg = '$n_brg', hrg_brg = '$hrg_brg', stok_brg = '$stok_brg', img_brg = '$img_brg' WHERE id_brg = '$id_brg'");
    echo "<script>alert('Data Berhasisl Diedit'); window.location = '?page=barang'</script>";
  } else {
    echo "<script>alert('Upload Gagal')</script>";
  }
}
