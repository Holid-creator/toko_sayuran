<div id="cetak" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cetak PDF Data Barang</h4>
      </div>
      <div class="modal-body">
        <form action="report/cetak_barang.php" method="post" target="_blank">
          <table>
            <tr>
              <td>
                <div class="form-group">Dari Tanggal</div>
              </td>
              <td align="center" width="10%">
                <div class="form-group">:</div>
              </td>
              <td>
                <div class="form-group">
                  <input type="date" class="form-control" name="tgl_first" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="form-group">Sampai Tanggal</div>
              </td>
              <td align="center" width="10%">
                <div class="form-group">:</div>
              </td>
              <td>
                <div class="form-group">
                  <input type="date" class="form-control" name="tgl_end" required>
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td>
                <input type="submit" class="btn btn-success btn-sm" name="cetak_barang" value="cetak">
              </td>
            </tr>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <a href="report/cetak_barang.php" target="_blank" class="btn btn-success btn-sm">Cetak Semua Data</a>
      </div>
    </div>
  </div>
</div>