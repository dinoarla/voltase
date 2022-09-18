<script type="text/javascript">
  $(function() {
     
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263',      '#6AF9C4']
    });
    
    Highcharts.chart('stat', {
      data: {
        table: 'tabel_stat'
      },
      chart: {
        type: 'pie'
      },
      title: {
        text: 'Monitoring Data Inspeksi Per Jenis Bahaya'
      },
      subtitle: {
        text: 'UP3 Indramayu'
      },
      exporting: {
        enabled: false
      },
      credits: {
        enabled: false
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: true,
            color: '#000000',
            connectorColor: '#000000',
            formatter: function() {
              return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
            }
          }
        }
      },
      tooltip: {
        formatter: function() {
          return '<b>' + this.point.name + '</b><br/>' +
            this.point.y;
        }
      }
    });
  });
</script>

<script type="text/javascript">
  $(function() {
    
    Highcharts.setOptions({
     colors: ['#50B432','#DDDF00','#ED561B', ]
    });
    
    Highcharts.chart('stat_ulp', {
      data: {
        table: 'tabel_stat_ulp'
      },
      chart: {
        type: 'column'
      },
      title: {
        text: 'Monitoring Data Inspeksi Per Kategori'
      },
      subtitle: {
        text: 'Komposisi Per ULP'
      },
      yAxis: {
        allowDecimals: false,
        title: {
          text: 'Data Inspeksi'
        }
      },
      exporting: {
        enabled: false
      },
      credits: {
        enabled: false
      },
      tooltip: {
        formatter: function() {
          return '<b>' + this.series.name + '</b><br/>' +
            this.point.y;
        }
      }
    });
  });
</script>

<?php
if (!defined("INDEX")) header('location: index.php');

function buat_tombol_hijau($name, $icon, $link, $warna)
{
  global $mysqli;
  $query = $mysqli->query("select * from tbl_entry WHERE kategori = '1'");
  $jml_data = $query->num_rows;
  echo '<div class="col-md-4 col-xs-12"><a href="' . $link . '">
        <div class="panel panel-' . $warna . ' dashboard-panel">
          <div class="panel-heading">
            <i class="glyphicon glyphicon-' . $icon . '"></i>
            <span class="pull-right">' . $jml_data . '</span>         
          </div>
          <div class="panel-body">' . $name . '</div>
        </div>
      </a></div>';
}

function buat_tombol_kuning($name, $icon, $link, $warna)
{
  global $mysqli;
  $query = $mysqli->query("select * from tbl_entry WHERE kategori = '2'");
  $jml_data = $query->num_rows;
  echo '<div class="col-md-4 col-xs-12"><a href="' . $link . '">
        <div class="panel panel-' . $warna . ' dashboard-panel">
          <div class="panel-heading">
            <i class="glyphicon glyphicon-' . $icon . '"></i>
            <span class="pull-right">' . $jml_data . '</span>        
          </div>
          <div class="panel-body">' . $name . '</div>
        </div>
      </a></div>';
}

function buat_tombol_merah($name, $icon, $link, $warna)
{
  global $mysqli;
  $query = $mysqli->query("select * from tbl_entry WHERE kategori = '3'");
  $jml_data = $query->num_rows;
  echo '<div class="col-md-4 col-xs-12"><a href="' . $link . '">
        <div class="panel panel-' . $warna . ' dashboard-panel">
          <div class="panel-heading">
            <i class="glyphicon glyphicon-' . $icon . '"></i>
            <span class="pull-right">' . $jml_data . '</span>        
          </div>
          <div class="panel-body">' . $name . '</div>
        </div>
      </a></div>';
}
?>

<br>
<div class="col-md-12">
  <div class="row">
    <?php
    //Memanggil fungsi buat_tombol untuk membuat 4 tombol
    buat_tombol_hijau("total kategori hijau", "screenshot", "?content=inspeksi", "success");
    buat_tombol_kuning("total kategori kuning", "flash", "?content=inspeksi", "warning");
    buat_tombol_merah("total kategori merah", "send", "?content=inspeksi", "danger");
    ?>
  </div>
</div>

<div class="col-md-6">
  <div class="card">
    <div id="stat"></div>
    <table class="table table-striped" id="tabel_stat" style="display: none;">
      <thead>
        <tr>
          <th>Unit</th>
          <th>Data Inspeksi</th>
        </tr>
      </thead>
      <?php
      global $mysqli;
      //Antena
      $query = $mysqli->query("select * from tbl_entry WHERE jenis_bahaya = 'Antena'");
      $jml_real_antena = $query->num_rows;

      //Bangunan
      $query = $mysqli->query("select * from tbl_entry WHERE jenis_bahaya = 'Bangunan'");
      $jml_real_bangunan = $query->num_rows;
      
      //Pohon
      $query = $mysqli->query("select * from tbl_entry WHERE jenis_bahaya = 'Pohon'");
      $jml_real_pohon = $query->num_rows;
      
      //Layangan
      $query = $mysqli->query("select * from tbl_entry WHERE jenis_bahaya = 'Layangan'");
      $jml_real_layangan = $query->num_rows;
      
      //Baliho
      $query = $mysqli->query("select * from tbl_entry WHERE jenis_bahaya = 'Baliho/Reklame'");
      $jml_real_baliho = $query->num_rows;
      
      //Lain-Lain
      $query = $mysqli->query("select * from tbl_entry WHERE jenis_bahaya = 'Lain-Lain'");
      $jml_real_lain = $query->num_rows;
      ?>
      <tbody>
        <tr>
          <th>Antena</th>
          <?php echo "<td>" . $jml_real_antena . "</td>"; ?>
        </tr>
        <tr>
          <th>Bangunan</th>
          <?php echo "<td>" . $jml_real_bangunan . "</td>"; ?>
        </tr>
        <tr>
          <th>Pohon</th>
          <?php echo "<td>" . $jml_real_pohon . "</td>"; ?>
        </tr>
        <tr>
          <th>Layangan</th>
          <?php echo "<td>" . $jml_real_layangan . "</td>"; ?>
        </tr>
        <tr>
          <th>Baliho / Reklame</th>
          <?php echo "<td>" . $jml_real_baliho . "</td>"; ?>
        </tr>
        <tr>
          <th>Lain - Lain</th>
          <?php echo "<td>" . $jml_real_lain . "</td>"; ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="col-md-6">
  <div class="card">
    <div id="stat_ulp"></div>
    <table class="table table-striped" id="tabel_stat_ulp" style="display: none;">
      <thead>
        <tr>
          <th>Unit</th>
          <th>Kategori Hijau</th>
          <th>Kategori Kuning</th>
          <th>Kategori Merah</th>
        </tr>
      </thead>
      <?php
      global $mysqli;
      //Hijau JTB
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'JATIBARANG' AND kategori = '1'");
      $jml_real_hijau_jtb = $query->num_rows;

      //Kuning JTB
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'JATIBARANG' AND kategori = '2'");
      $jml_real_kuning_jtb = $query->num_rows;
      
      //Merah JTB 
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'JATIBARANG' AND kategori = '3'");
      $jml_real_merah_jtb = $query->num_rows;
      
      //Hijau HRG
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'HAURGEULIS' AND kategori = '1'");
      $jml_real_hijau_hrg = $query->num_rows;

      //Kuning HRG
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'HAURGEULIS' AND kategori = '2'");
      $jml_real_kuning_hrg = $query->num_rows;
      
      //Merah HRG 
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'HAURGEULIS' AND kategori = '3'");
      $jml_real_merah_hrg = $query->num_rows;
      
      //Hijau IKO
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'INDRAMAYU' AND kategori = '1'");
      $jml_real_hijau_iko = $query->num_rows;

      //Kuning IKO
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'INDRAMAYU' AND kategori = '2'");
      $jml_real_kuning_iko = $query->num_rows;
      
      //Merah IKO 
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'INDRAMAYU' AND kategori = '3'");
      $jml_real_merah_iko = $query->num_rows;
      
      //Hijau CKD
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'CIKEDUNG' AND kategori = '1'");
      $jml_real_hijau_ckd = $query->num_rows;

      //Kuning CKD
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'CIKEDUNG' AND kategori = '2'");
      $jml_real_kuning_ckd = $query->num_rows;
      
      //Merah CKD 
      $query = $mysqli->query("select * from tbl_entry WHERE ulp = 'CIKEDUNG' AND kategori = '3'");
      $jml_real_merah_ckd = $query->num_rows;
      ?>
      <tbody>
        <tr>
          <th>ULP Jatibarang</th>
          <?php echo "<td>" . $jml_real_hijau_jtb . "</td>"; ?>
          <?php echo "<td>" . $jml_real_kuning_jtb . "</td>"; ?>
          <?php echo "<td>" . $jml_real_merah_jtb . "</td>"; ?>
        </tr>
        <tr>
          <th>ULP Haurgeulis</th>
          <?php echo "<td>" . $jml_real_hijau_hrg . "</td>"; ?>
          <?php echo "<td>" . $jml_real_kuning_hrg . "</td>"; ?>
          <?php echo "<td>" . $jml_real_merah_hrg . "</td>"; ?>
        </tr>
        <tr>
          <th>ULP Indramayu Kota</th>
          <?php echo "<td>" . $jml_real_hijau_iko . "</td>"; ?>
          <?php echo "<td>" . $jml_real_kuning_iko . "</td>"; ?>
          <?php echo "<td>" . $jml_real_merah_iko . "</td>"; ?>
        </tr>
        <tr>
          <th>ULP Cikedung</th>
           <?php echo "<td>" . $jml_real_hijau_ckd . "</td>"; ?>
          <?php echo "<td>" . $jml_real_kuning_ckd . "</td>"; ?>
          <?php echo "<td>" . $jml_real_merah_ckd . "</td>"; ?>
        </tr>

      </tbody>
    </table>
  </div>
</div>



