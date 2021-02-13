<?php

require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/m_barang.php";

$conn = new Database($host, $user, $pass, $database);
$brg = new M_barang($conn);

$content = '
<style type="text/css">
.table { border-collapse: collapse; width: 100px;}
.table th { padding: 8px 5px; background-color: #f60; color: #fff;}
.table td { padding: 3px;}
img { width: 50px;}
</style>
';

$content .= '
<page>
  <div style="padding:4mm; border:1px solid;" align="center">
    <span style="font-size:25px;">Aplikasi Keren By Holid</span>
  </div>
  <div style="padding:20px 0 10px 0; font-size:15px">
    Laporan Data Barang
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>Nama Barang</th>
      <th>Harga barang</th>
      <th>Stok Barang</th>
      <th>Gambar Barang</th>
    </tr>';
$no = 1;
if (@$_GET['id'] != '') {
  $tampil = $brg->tampil(@$_GET['id']);
} else {
  if (@$_POST['cetak_barang']) {
    $tampil = $brg->tampil_tgl(@$_POST['tgl_first'], @$_POST['tgl_end']);
  } else {
    $tampil = $brg->tampil();
  }
}
while ($data = $tampil->fetch_object()) {
  $content .= '
<tr>
  <td align="center">' . $no++ . '</td>
  <td>' . $data->n_brg . '</td>
  <td align="right"><span align="left">Rp.</span>' . number_format($data->hrg_brg, 2, ',', '.') . '</td>
  <td align="center">' . $data->stok_brg . '</td>
  <td align="center">
    <img src="../uploads/products/' . $data->img_brg . '">
  </td>
</tr>';
}
$content .= '
  </table>
</page>
';

require_once('../assets/html2pdf/html2pdf.class.php');

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($content);
$html2pdf->output('Laporan Barang.pdf');
