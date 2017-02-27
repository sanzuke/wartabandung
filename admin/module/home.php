<h3 style="margin:0;"> Selamat datang <i><?php echo $_SESSION['user_name'] ?></i>, dihalaman administrator </h3>
<fieldset style="float:left; width:500px;">
<legend><h3 style="margin:5px 0px 0px 0px;">Shortcut</h3></legend>
<div>
    <div id="tblShoutcut" onClick="window.location='<?php echo BASE_PATH_ADMIN ?>dashboard.php?page=post&op=add'"><img src="images/2.png" align="absmiddle"> Tambah Posting Baru</div>
    <div id="tblShoutcut" onClick="window.location='<?php echo BASE_PATH_ADMIN ?>dashboard.php?page=page&op=add'"><img src="images/2.png" align="absmiddle"> Tambah Halaman Baru</div>
</div>
</fieldset>

<fieldset style="float:left; width:300px;">
<legend><h3 style="margin:5px 0px 0px 0px;">Konten</h3></legend>
<?php
$ps=mysql_query("select * from post");
$r1=mysql_num_rows($ps);

#$pr=mysql_query("select * from produk");
#$r2=mysql_num_rows($pr);

$k=mysql_query("select * from komentar");
$r3=mysql_num_rows($k);
?>
<table width="100%">
<tr><td width="160">Jumlah Posting</td><td>: <i><?php echo $r1 ?></i></td></tr>
<!--<tr><td width="160">Jumlah Produk</td><td>: <i><?php echo $r2 ?></i></td></tr>-->
<tr><td width="160">Jumlah Komentar</td><td>: <i><?php echo $r3 ?></i></td></tr>
<tr><td width="160">Jumlah Komentar</td><td>: <i><?php echo $r3 ?></i></td></tr>
</table>
</fieldset>

<fieldset style="float:left; width:300px;">
<legend>Tampilkan kategori dihalaman depan</legend>
<?php
$q=mysql_query("select * from kategori where child='0'");
$i=1;
while($r=mysql_fetch_array($q)){
	if($r['home']=='1'){
		$pil='checked="check"';
	} else {
		$pil='';
	}
	?>
	<input type="checkbox" name="<?php echo $r[kategori] ?>" <?php echo $pil ?> onclick="saveMainMenuKategori('<?php echo $r[kategori] ?>')" /> <?php echo $r[kategori] ?> <br />
    <?php
}
?>
</fieldset>
<div style="clear:both;"></div>