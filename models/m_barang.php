<?php
class M_barang
{
  private $mysqli;

  function __construct($con)
  {
    $this->mysqli = $con;
  }

  public function tampil($id = null)
  {
    $db = $this->mysqli->con;
    $sql = "SELECT * FROM tb_barang";

    if ($id != null) {
      $sql .= " WHERE id_brg = $id";
    }
    $query = $db->query($sql) or die($db->error);
    return $query;
  }

  public function tampil_tgl($tgl1, $tgl2)
  {
    $db = $this->mysqli->con;
    $sql = "SELECT * FROM tb_barang WHERE tgl_publish BETWEEN '$tgl1' AND '$tgl2'";
    $query = $db->query($sql) or die($db->error);
    return $query;
  }

  public function tambah($n_brg, $hrg_brg, $stok_brg, $img_brg)
  {
    $db = $this->mysqli->con;
    $db->query("INSERT INTO tb_barang vALUES ('', '$n_brg', '$hrg_brg', '$stok_brg', '$img_brg', now())") or die($db->error);
  }

  public function edit($sql)
  {
    $db = $this->mysqli->con;
    $db->query($sql) or die($db->error);
  }

  public function delete($id)
  {
    $db = $this->mysqli->con;
    $db->query("DELETE FROM tb_barang WHERE id_brg = '$id'") or die($db->error);
  }

  function __destruct()
  {
    $db = $this->mysqli->con;
    $db->close();
  }
}
