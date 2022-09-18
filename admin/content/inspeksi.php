<?php
if (!defined("INDEX")) header('location: ../index.php');
if ($_SESSION['leveluser'] != "admin") header('location: index.php');

$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=inspeksi";
$link_export = "../admin/content/export/export_inspeksi.php";
switch ($show) {

		//Menampilkan data
	default:
		echo '<h3 class="page-header"><b>Data Inspeksi (ULP)</b>
				<a href="' . $link_export . '" target="_blank" class="btn btn-success btn-sm pull-right top-button" style="margin-left:10px;">
					<i class="glyphicon glyphicon-list-alt"></i> Export Excel
				</a>
				<a href="' . $link . '&show=form" class="btn btn-primary btn-sm pull-right top-button">
					<i class="glyphicon glyphicon-plus-sign"></i> Tambah
				</a>
			</h3>';

		buka_tabel(array("Uraian", "ULP", "Potensi Bahaya", "Tindakan Preventif", "","", "Foto"));
		$no = 1;
		$query = $mysqli->query("SELECT * FROM tbl_entry ORDER BY id_entry DESC");
		while ($data = $query->fetch_array()) {
			$id = str_pad($data['id_entry'], 4, '0', STR_PAD_LEFT);
			$uraian  =
				'<p>' . $data['pny'] . '-'. $data['tiang'] .'
				<br><span class="badge">ID: K3L-' . $data['ulp'] . '-' . $id . '</span></p>
			<small class="text-muted">
				Alamat: <a target="_blank" href="https://www.google.com/maps/place/' . $data['lat'] . ',' . $data['lng'] . '">' . $data['alamat'] . '</a>
				<br><i style="font-size:10px;"> Tgl Pelaksanaan: ' . tgl_indonesia($data['tgl_pelaksanaan']) . '</i>,
				<br><i style="font-size:10px;"> Tgl Entry: ' . $data['tgl_entry'] . '</i>,
				<br><i style="font-size:10px;"> Tgl Edit: ' . $data['tgl_edit'] . '</i>
			</small>';

			$img = '<a target="_blank" href="../../media/source/'.$data['foto'].'"><img src="../media/thumbs/'.$data['foto'].'" title="Klik Untuk Memperbesar Foto"> </img></a>';

			if ($data['kategori'] == '1') $status = '<td style="background-color:#228B22; color:#FFFFFF;">Aman (Sudah sosialisasi dan potensi bahaya hilang)</td>';
			elseif ($data['kategori'] == '2') $status = '<td style="background-color:#FFFF00; color:#000000;">Eksisting (Aktivitas masyarakat masih berlangsung)</td>';
			else $status = '<td style="background-color: #ff0000; color:#FFFFFF;">Kejadian (Pernah Merenggut Korban Jiwa)</td>';

			isi_tabel($no, array($uraian, $data['ulp'], $data['potensi_bahaya'], $data['preventif'], $status, $img), $link, $data['id_entry']);
			$no++;
		}
		tutup_tabel();

		break;

		//Menampilkan form input dan edit data
	case "form":
		if (isset($_GET['id'])) {
			$query = $mysqli->query("SELECT * FROM tbl_entry WHERE id_entry='$_GET[id]'");
			$data = $query->fetch_array();
			$aksi = "Edit";
		} else {
			$data = array("id_entry" => "", "pny" => "", "tiang" => "", "alamat" => "", "lat" => "", "lng" => "", "ulp" => "", "jenis_bahaya" => "", "potensi_bahaya" => "", "foto" => "", "preventif" => "", "sudah_dilanjut" => "", "Kategori" => "", "ket" => "", "tgl_entry" => "", "tgl_edit" => "", "tgl_pelaksanaan" => "");
			$aksi = "Tambah";
		}

		echo '<h3 class="page-header"><b>' . $aksi . ' Data Inspeksi (ULP)</b> </h3>';

		buka_form($link, $data['id_entry'], strtolower($aksi));
        
        buat_datepicker("Tanggal Pelaksanaan", "tgl_pelaksanaan", $data['tgl_pelaksanaan']);
		buat_textbox("Penyulang", "pny", $data['pny']);
		buat_textbox("Tiang", "tiang", $data['tiang'], 2);
		buat_textbox("Alamat", "alamat", $data['alamat'], 7);
		$list = array();
		$list[] = array('val' => '0', 'cap' => '-- Pilih ULP --');
		$list[] = array('val' => 'JATIBARANG', 'cap' => 'ULP JATIBARANG');
		$list[] = array('val' => 'HAURGEULIS', 'cap' => 'ULP HAURGEULIS');
		$list[] = array('val' => 'INDRAMAYU KOTA', 'cap' => 'ULP INDRAMAYU KOTA');
		$list[] = array('val' => 'CIKEDUNG', 'cap' => 'ULP CIKEDUNG');

		buat_combobox("ULP", "ulp", $list, $data['ulp']);

		echo "<nav aria-label='breadcrumb' role='navigation'>
			<ol class='breadcrumb'>
			<b>Contoh Penulisan Latitude / Longitude (Format Decimal Degree)</b>
			<br>Latitude: -6.12345678
			<br>Longitude: 108.12345678
			</ol>
			</nav>";

		buat_textbox("Latitude", "lat", $data['lat']);
		buat_textbox("Longitude", "lng", $data['lng']);
		echo "<hr>";

		$list = array();
		$list[] = array('val' => '0', 'cap' => '-- Pilih Jenis Bahaya --');
		$list[] = array('val' => 'Antena', 'cap' => 'Antena');
		$list[] = array('val' => 'Bangunan', 'cap' => 'Bangunan');
		$list[] = array('val' => 'Pohon', 'cap' => 'Pohon');
		$list[] = array('val' => 'Layangan', 'cap' => 'Layangan');
		$list[] = array('val' => 'Baliho/Reklame', 'cap' => 'Baliho/Reklame');
		$list[] = array('val' => 'Lain-Lain', 'cap' => 'Lain-Lain');

		buat_combobox("Jenis Bahaya", "jenis_bahaya", $list, $data['jenis_bahaya']);
		buat_textbox("Potensi Bahaya", "potensi_bahaya", $data['potensi_bahaya']);

		$list = array();
		$list[] = array('val' => '0', 'cap' => '-- Pilih Status Tindak Lanjut --');
		$list[] = array('val' => '1', 'cap' => 'Sudah Ditindaklanjuti');
		$list[] = array('val' => '2', 'cap' => 'Belum Ditindaklanjuti');

		buat_combobox("Status Tindak Lanjut", "sudah_dilanjut", $list, $data['sudah_dilanjut'], 3);

		$list = array();
		$list[] = array('val' => '0', 'cap' => '-- Pilih Kategori --');
		$list[] = array('val' => '1', 'cap' => 'Hijau');
		$list[] = array('val' => '2', 'cap' => 'Kuning');
		$list[] = array('val' => '3', 'cap' => 'Merah');

		buat_combobox("Kategori Bahaya", "kategori", $list, $data['kategori'], 3);
		buat_imagepicker("Foto/Eviden", "foto", $data['foto']);
		buat_textbox("Tindakan Preventif", "preventif", $data['preventif'], 7);
		buat_textbox("Catatan", "ket", $data['ket'], 7);
		echo "<hr>";



		tutup_form($link);


		break;

		//Menyisipkan atau mengedit data di database
	case "action":
		if ($_POST['aksi'] == "tambah") {
			$mysqli->query("INSERT INTO tbl_entry SET
			    tgl_pelaksanaan     = '$_POST[tgl_pelaksanaan]',
				pny 	            = '$_POST[pny]',
				tiang 		        = '$_POST[tiang]',
				alamat 	            = '$_POST[alamat]',
				ulp 	        	= '$_POST[ulp]',
				lat 		        = '$_POST[lat]',
				lng	 		        = '$_POST[lng]',
				jenis_bahaya 		= '$_POST[jenis_bahaya]',
				potensi_bahaya	 	= '$_POST[potensi_bahaya]',
				foto	 			= '$_POST[foto]',
				preventif			= '$_POST[preventif]',
				sudah_dilanjut		= '$_POST[sudah_dilanjut]',
				kategori			= '$_POST[kategori]',
				ket					= '$_POST[ket]',
				tgl_entry			= now()				
			");
		} elseif ($_POST['aksi'] == "edit") {
			$mysqli->query("UPDATE tbl_entry SET
			    tgl_pelaksanaan     = '$_POST[tgl_pelaksanaan]',
				pny 	            = '$_POST[pny]',
				tiang 		        = '$_POST[tiang]',
				alamat 	            = '$_POST[alamat]',
				ulp 	        	= '$_POST[ulp]',
				lat 		        = '$_POST[lat]',
				lng	 		        = '$_POST[lng]',
				jenis_bahaya 		= '$_POST[jenis_bahaya]',
				potensi_bahaya	 	= '$_POST[potensi_bahaya]',
				foto	 			= '$_POST[foto]',
				preventif			= '$_POST[preventif]',
				sudah_dilanjut		= '$_POST[sudah_dilanjut]',
				kategori			= '$_POST[kategori]',
				ket					= '$_POST[ket]',
				tgl_edit			= now()	
			WHERE id_entry='$_POST[id]'");
		}
		header('location:' . $link);
		break;

		//Menghapus data di database
	case "delete":
		$mysqli->query("DELETE FROM tbl_entry WHERE id_entry='$_GET[id]'");
		header('location:' . $link);
		break;
}
