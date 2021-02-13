<?php
include "models/m_barang.php";
$brg = new M_barang($conn);

if (@$_GET['act'] == '') {
?>

  <div class="row">
    <div class="col-lg-12">
      <h1><i class="fa fa-tachometer"></i> Data Barang <small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="icon-dashboard"></i> Data Barang</a></li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="barang">
          <thead>
            <tr>
              <th width="30px" align="center">No</th>
              <th>Nama Barang</th>
              <th>Harga Barang</th>
              <th>Stok Barang</th>
              <th width="120px">Gambar Barang</th>
              <th>Tanggal Publis</th>
              <th width="225px" style="text-align: center;">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $tampil = $brg->tampil();
            while ($data = $tampil->fetch_object()) {
            ?>
              <tr>
                <td align="center"><?= $no++ . "."; ?></td>
                <td><?= $data->n_brg; ?></td>
                <td><?= $data->hrg_brg; ?></td>
                <td><?= $data->stok_brg; ?></td>
                <td align="center">
                  <img src="<?= 'uploads/products/' . $data->img_brg ?>" width="50px">
                </td>
                <td><?= tgl_indo($data->tgl_publish); ?></td>
                <td>
                  <a class="btn btn-info btn-sm" id="edit_brg" data-toggle="modal" data-target="#edit" data-id="<?= $data->id_brg ?>" data-nama="<?= $data->n_brg ?>" data-hrg="<?= $data->hrg_brg ?>" data-stok="<?= $data->stok_brg ?>" data-img="<?= $data->img_brg ?>"><i class="fa fa-edit"></i> Ubah</a>
                  <a onclick="return confirm('Yakin Hapus')" href="?page=barang&act=del&id=<?= $data->id_brg ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</a>
                  <a href="./report/cetak_barang.php?id=<?= $data->id_brg ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak PDF</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah data barang</a>
      <a href="report/ex_brg.php" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Export Ecxel</a>
      <a target="_blank" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cetak"><i class="fa fa-plus"></i> Cetak Pdf</a>
      <?php include "cetak_pdf.php" ?>

      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="n_brg" class="control-label">Nama Barang</label>
                  <input type="text" class="form-control" name="n_brg" id="n_brg" required autofocus>
                </div>
                <div class="form-group">
                  <label for="hrg_brg">Harga Barang</label>
                  <input type="number" class="form-control" name="hrg_brg" id="hrg_brg">
                </div>
                <div class="form-group">
                  <label for="stok_brg">Stock Barang</label>
                  <input type="number" class="form-control" name="stok_brg" id="stok_brg">
                </div>
                <div>
                  <label for="img_brg">Gambar Barang</label>
                  <input type="file" class="form-control" name="img_brg">
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-success" name="tambah">Simpan</button>
              </div>
            </form>
            <?php
            if (isset($_POST['tambah'])) {
              $n_brg = $conn->con->real_escape_string($_POST['n_brg']);
              $hrg_brg = $conn->con->real_escape_string($_POST['hrg_brg']);
              $stok_brg = $conn->con->real_escape_string($_POST['stok_brg']);
              $tgl_publish = $conn->con->real_escape_string($_POST['tgl_publish']);

              $extensi = explode(".", $_FILES['img_brg']['name']);
              $img_brg = "YL-" . round(microtime(true)) . "." . end($extensi);
              $sumber = $_FILES['img_brg']['tmp_name'];
              $upload = move_uploaded_file($sumber, "uploads/products/" . $img_brg);
              if ($upload) {
                $brg->tambah($n_brg, $hrg_brg, $stok_brg, $img_brg, $tgl_publish);
                echo "<script>alert('Data Berhasil Ditambahkan')</script>";
                header("location: ?page=barang");
              }
              echo "<script>alert('Upload Gagal')</script>";
            }
            ?>
          </div>
        </div>
      </div>

      <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Ubah Data Barang</h4>
            </div>
            <form id="form" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="n_brg" class="control-label">Nama Barang</label>
                  <input type="hidden" name="id_brg" id="id_brg">
                  <input type="text" class="form-control" name="n_brg" id="n_brg" autofocus>
                </div>
                <div class="form-group">
                  <label for="hrg_brg">Harga Barang</label>
                  <input type="number" class="form-control" name="hrg_brg" id="hrg_brg">
                </div>
                <div class="form-group">
                  <label for="stok_brg">Stock Barang</label>
                  <input type="number" class="form-control" name="stok_brg" id="stok_brg">
                </div>
                <div>
                  <label for="img_brg">Foto Barang</label>
                  <div style="margin-bottom: 10px;">
                    <img id="img_brg" width="100px">
                  </div>
                  <input type="file" class="form-control" name="img_brg" class="img-thumbnail">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="edit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script src="assets/js/jquery-1.10.2.js"></script>
      <script>
        $(document).ready(function() {
          $('#barang').DataTable({
            columnDefs: [{
              "searchable": false,
              "orderable": false,
              "targets": [0, 6]
            }],
            "order": [1, "asc"]
          });
        })
      </script>
      <script>
        $(document).on('click', '#edit_brg', function() {
          var idbrg = $(this).data('id');
          var nmbrg = $(this).data('nama');
          var hrgbrg = $(this).data('hrg');
          var stkbrg = $(this).data('stok');
          var imgbrg = $(this).data('img');

          $(".modal-body #id_brg").val(idbrg);
          $(".modal-body #n_brg").val(nmbrg);
          $(".modal-body #hrg_brg").val(hrgbrg);
          $(".modal-body #stok_brg").val(stkbrg);
          $(".modal-body #img_brg").attr("src", "uploads/products/" + imgbrg);
        })

        $(document).ready(function(e) {
          $('#form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
              url: 'models/pros_edbrg.php',
              type: 'post',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(msg) {
                $('.table').html(msg);
              }
            })
          })
        })
      </script>
    </div>
  </div>

<?php } else if (@$_GET['act'] == 'del') {
  $img_st = $brg->tampil($_GET['id'])->fetch_object()->img_brg;
  unlink("uploads/products/" . $img_st);

  $brg->delete($_GET['id']);
  echo "<script>alert('Data Berhasil Dihapus'); window.location = '?page=barang</script>";
} ?>