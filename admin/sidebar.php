<ul class="nav">
	<?php
	if (!defined("INDEX")) header('location: index.php');

	buat_menu("dashboard", "home", "Dashboard", array("admin"));
	buat_menu("inspeksi", "flag", "Data Inspeksi", array("admin"));
	buat_menu("user", "user", "User Terdaftar", array("admin"));
	buat_menu("media", "picture", "Media", array("admin"));
	buat_menu("backuprestore", "cog", "Backup dan Restore", array("admin"));


	//buat_menu("entry", "pencil", "Entry Data", array("admin"));
	//buka_dropdown("flag", "Monitoring Gardu", array("admin"));
	//buat_submenu("report", "Laporan Pengukuran", array("admin"));
	//buat_submenu("graph", "Grafik Pembebanan", array("admin"));
	//buat_submenu("penyeimbangan", "Penyeimbangan Beban", array("admin"));
	//buat_submenu("kva", "Total kVA", array("admin"));
	//buat_submenu("trafo", "Data Trafo", array("admin"));
	//tutup_dropdown(array("admin"));

	//buka_dropdown("cog", "Pengaturan", array("admin"));
	//buat_submenu("gardu", "Data Gardu", array("admin"));
	//buat_submenu("backuprestore", "Backup dan Restore", array("admin"));
	//tutup_dropdown(array("admin"));
	?>
</ul>