<?php
require("config.php");
require("class/mainclass.php");

$main = new MainClass();

$main->connectDB(); 


  Header("Content-Type: text/xml");
  echo '<?xml version="1.0" encoding="US-ASCII" ?>
  	<rss version="2.0">
        <channel>
        <title>wartabandung.com </title>
        <link>http://www.wartabandung.com/</link>
        <description>10 Berita dan Artikel terbaru</description>
        <language>id</language>
	<copyright>wartabandung.com 2012</copyright>
        <pubDate>'.Date("r").'</pubDate>
        <lastBuildDate>'.Date("r").'</lastBuildDate>
        <generator>wartabandung.com RSS Generator</generator>
	<image>
		<url>http://www.wartabandung.com/images/logo.png</url>
		<title>Warta Bandung</title>
		<link>http://www.wartabandung.com</link>
	</image>
        ';
$rc = mysql_query("select *,UNIX_TIMESTAMP(`tgl`) AS pubDate from `post` WHERE `jenis`='post' order by `tgl` desc limit 0,10 ");

while ($r = mysql_fetch_array($rc))
{
  $id = $r['id'];
  $kat=$r['kategori'];
  //$pubDate=$r['tgl'];
  $judul = htmlentities(strip_tags($r['judul']), ENT_QUOTES);
  $keterangan = htmlentities(substr(strip_tags($r['isi']),0,300), ENT_QUOTES);
  //$keterangan.= date('d-m-Y, H:i:m',strtotime($r[tgl]));
  $pubDate = strftime("%a, %d %b %Y %T %Z",strtotime($r['tgl']));
?>
  <item>
  <title><?php echo strip_tags($judul) ?></title>
  <link><?php echo "http://www.wartabandung.com?page=view&amp;id=$id" ?></link>
  <description>&lt;img src=&quot;http://www.wartabandung.com/upload/<?php echo $r[photo] ?>&quot; align=&quot;left&quot; hspace=&quot;7&quot; width=&quot;120&quot; &gt;<?php echo strip_tags($keterangan) ?></description>
  <pubDate><?php echo $pubDate ?></pubDate>
  </item>
<?php
}
echo "</channel></rss>";

?>
  