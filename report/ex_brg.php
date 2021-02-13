<?php
ob_start();
require_once "../config/koneksi.php";
require_once "../models/database.php";
include "../models/m_barang.php";

$conn = new Database($host, $user, $pass, $database);
$brg = new M_barang($conn);

$filename = "Excel_barang - (" . date('d-m-Y') . ").xls";

header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1px">
  <tr>
    <th>No.</th>
    <th>Nama Barang</th>
    <th>Harga Barang</th>
    <th>Stok barang</th>
  </tr>
  <?php
  $no = 1;
  $tampil = $brg->tampil();
  while ($data = $tampil->fetch_object()) {
  ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $data->n_brg; ?></td>
      <td><?= $data->hrg_brg; ?></td>
      <td><?= $data->stok_brg; ?></td>
    </tr>
  <?php } ?>
</table>