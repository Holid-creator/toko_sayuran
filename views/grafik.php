<div class="row">
  <div class="col-lg-12">
    <h1><i class="fa fa-tachometer"></i> Grafik Barang <small>Toko Sayuran</small></h1>
    <ol class="breadcrumb">
      <li><a href="index.html"><i class="icon-dashboard"></i> Data Barang</a></li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div id="data_barang"></div>
  </div>
</div>

<?php
include "models/m_barang.php";
$brg = new M_barang($conn);
$tampil = $brg->tampil();
while ($data = $tampil->fetch_object()) {
  $n_brg[] = $data->n_brg;
  $stok_brg[] = intval($data->stok_brg);
}
?>

<script src="assets/highchart/js/highchart.js"></script>
<script src="assets/highchart/js/exporting.js"></script>
<script type="text/javascript">
  Highcharts.chart('data_barang', {
    chart: {
      type: 'area'
    },
    title: {
      text: 'Data Nama Dan Jumlah Stok Barang'
    },
    subtitle: {
      text: 'Source: www.holid.rf.gd'
    },
    xAxis: {
      categories: <?= json_encode($n_brg); ?>,
      tickmarkPlacement: 'on',
      title: {
        enabled: false
      }
    },
    yAxis: {
      title: {
        text: 'Jumlah Satuan'
      },
      labels: {
        formatter: function() {
          return this.value;
        }
      }
    },
    tooltip: {
      split: false,
      valueSuffix: ''
    },
    plotOptions: {
      area: {
        stacking: 'normal',
        lineColor: 'green',
        lineWidth: 2,
        marker: {
          lineWidth: 1,
          lineColor: 'red'
        }
      }
    },
    series: [{
      name: 'Jumlah Stok',
      data: <?= json_encode($stok_brg); ?>
    }]
  });
</script>