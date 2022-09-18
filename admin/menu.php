<?php
if (!defined("INDEX")) header('location: index.php');
?>
<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="?content=dashboard">VOLTASE</a>
</div>

<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav visible-xs">
		<?php
		buat_menu("dashboard", "home", "Dashboard", array("admin","Manajemen","Sarpp","Ren","Kons","Survey"));
    	buat_menu("dil", "screenshot", "Data Induk Langganan", array("admin","Manajemen","Sarpp","Ren","Kons","Survey"));
    	buat_menu("sarpp", "bullhorn", "Proses SARPP", array("admin","Manajemen","Sarpp","Ren","Kons","Survey"));
    	buat_menu("ren", "flag", "Evaluasi Perencanaan", array("admin","Manajemen","Sarpp","Ren","Kons","Survey"));
    	buat_menu("kons", "th", "Monitoring Konstruksi", array("admin","Manajemen","Sarpp","Ren","Kons","Survey"));
    	buat_menu("mitra", "retweet", "Partnership", array("admin","Manajemen","Sarpp","Ren","Kons","Mitra","Survey"));
    	buat_menu("user", "user", "Data User", array("admin","Manajemen","Sarpp","Ren","Kons","Mitra","Survey"));
    	buat_menu("media", "picture", "Media", array("admin"));
    	buat_menu("backuprestore", "cog", "Backup dan Restore", array("admin"));
		?>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><a><i class="glyphicon glyphicon-user"></i> Halo, 
		<?php echo"$_SESSION[nama]";?> (Level: <?php echo"$_SESSION[leveluser]";?> )</a></li>	
		<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Keluar</a></li>	
	</ul>
</div>