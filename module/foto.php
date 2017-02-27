<ul id="photos">
	<?php
    $q=mysql_query("select * from post where kategori='foto' order by tgl desc limit 0,9");
    while($rFoto=mysql_fetch_array($q)){
	?>
    <li>
    	<span class="panel-overlay"><strong><?php echo $rFoto['judul'] ?></strong><br><?php echo substr(strip_tags($rFoto['isi']),0,190) ?></span>
    	<img src="upload/<?php echo $rFoto['photo'] ?>" />
    </li>
    <?php
	}
	?>
</ul>