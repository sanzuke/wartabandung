<?php 
session_start();
require("../config.php");

if(! $_SESSION['user_name']){
	var_dump($_SESSION);

	echo("<div style='margin:50px; padding:20px; border:1px solid #e5e5e5; background-color:#ccc;'><h1>Maaf anda tidak bisa mengakses langsng halaman ini!</h1></div>");
	exit();
}

require("class/class-sanzuke.php");
//require("class/class-templates.php");
$mainClass=new sanzukeClass();
$mainClass->connectDB();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Administrator</title>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>js/app.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>ckeditor/config.js"></script>

<link rel="stylesheet" href="<?php echo BASE_PATH_ADMIN ?>css/styles.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH_ADMIN ?>css/custom-theme/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PATH ?>css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PATH ?>css/ddsmoothmenu-v.css" />
<script type="text/javascript" src="<?php echo BASE_PATH ?>js/ddsmoothmenu.js"></script>
<script type="text/javascript">
function saveMainMenuKategori(kat){
	$.ajax({
		type : "POST",
		url :"saveKat.php",
		data :"kat="+kat,
		success : function(data){
			
		}
	})
	return false;
}
$(document).ready(function(e) {	
	
	$("#preview").dialog({
		autoOpen: false,
		title:"Preview",
		width:"400",
		height:"400",
		modal: true
	})
	
	
});

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

     function openFileBrowser(id){
          fileBrowserlink = "/browser/index.php?editor=standalone&returnID=" + id;
          window.open(fileBrowserlink,'pdwfilebrowser', 'width=1000,height=650,scrollbars=no,toolbar=no,location=no');
     }
	 
	 function openMedia(){
          fileBrowserlink = "http://wartabandung.com/admin/browser/index.php?editor=standalone";
          window.open(fileBrowserlink,'pdwfilebrowser', 'width=1000,height=650,scrollbars=no,toolbar=no,location=no');
     }
</script>
</head>
<body style="margin:0;">
<div id="content">
	<div id="loged">Login sebagai : <strong><?php echo $_SESSION['user_name'] ?></strong> | <a href="logout.php">Logout</a> </div>
    <div id="namaWeb"><?php echo SITE_NAME ?> Admin</div>
    <div id="menu">
    <div id="smoothmenu1" class="ddsmoothmenu">
    	<ul>
        	<li><a href="<?php echo BASE_PATH_ADMIN ?>dashboard.php">Dashboard</a></li>
            <li><a href="#">Post</a>
            	<ul>
                	<li><a href="<?php echo BASE_PATH_ADMIN ?>dashboard.php?page=post&op=add">Tambah Post</a></li>
                    <li><a href="<?php echo BASE_PATH_ADMIN ?>dashboard.php?page=post&op=view">Lihat Post</a></li>
                </ul>
            </li>
            <!--<li><a href="javascript:void(0)" onClick="openMedia()">Media</a></li>-->
    		<li><a href="#">Kategori</a>
            	<ul>
                	<li><a href="dashboard.php?page=kategori&amp;op=add">Tambah Kategori</a></li>
                    <li><a href="dashboard.php?page=kategori">List Kategori</a></li>
                </ul>
            </li>
            <li><a href="dashboard.php?page=iklan">Iklan</a></li>
            <li><a href="dashboard.php?page=komentar">Komentar</a></li>
 	    <!-- <li><a href="#">Reservasi</a> 
 	    	<ul>
 	    		<li><a href="dashboard.php?page=reservasi&op=addHotel">Tambah Hotel</a></li>
 	    		<li><a href="dashboard.php?page=reservasi&op=list">List Reservasi</a></li>
 	    	</ul>
 	    <li>-->
            <li><a href="#">Setting</a>
            	<ul>
                	<li><a href="#">Profil Perusahaan</a>
                    	<ul>
                        	<li><a href="dashboard.php?page=page&op=edit&amp;id=8">Tentang Kami</a></li>
                            <li><a href="dashboard.php?page=page&op=edit&amp;id=9">Redaksi</a></li>
                            <li><a href="dashboard.php?page=page&op=edit&amp;id=10">Kontak Kami</a></li>
                            <li><a href="dashboard.php?page=page&op=edit&amp;id=11">Disclimer</a></li>
                        </ul>
                    </li>
                    <li><a href="dashboard.php?page=social-media">Social Media</a></li>
                    <li><a href="dashboard.php?page=gantipwd">Ganti Password</a></li>
                </ul>
            </li>
 	    <li><a href="#">Polling</a> 
 	    	<ul>
 	    		<li><a href="dashboard.php?page=polling">Tambah Polling</a></li>
 	    		<li><a href="dashboard.php?page=polling&op=list">Daftar Polling</a></li>
 	    	</ul>
 	    <li>
        </ul>
    </div>
    </div>
    
    <div id="isiKonten">
    	<?php
    	switch($_GET['page']){
			case "post": include("module/post.php");
			break;
			case "reservasi": include("module/reservasi.php");
			break;
			case "bukutamu": include("module/guestbook.php");
			break;
			case "komentar": include("module/komentar.php");
			break;
			case "gallery": include("module/gallery.php");
			break;
			case "kategori": include("module/kategori.php");
			break;
			case "iklan": include("module/iklan.php");
			break;
			case "gantipwd" : include("module/changepassword.php");
			break;
			case "social-media" : include("module/social.php");
			break;
			case "reservasi": include("module/reservasi.php");
			break;
			case "page": include("module/page.php");
			break;
			case "polling": include("module/polling.php");
			break;
			default: include("module/home.php");
		}
		?>
    	<!--<input type="text" name="text" size="31"><input type="button" name="tbl" value="tombol">
    	<div id="msgBox">dadadadadadadada</div>-->
    </div>
    <div id="loged"><a href="logout.php">Logout</a> </div>
    <div style="clear:both"></div>
</div>
<div style="margin:0 auto; width:1006px; text-align:right; font-size:10px; font-family:Verdana, Geneva, sans-serif;">Powered by <a href="http://sanzuke.com/" target="_blank" >Sanzuke Dev</a></div>
</body>
</html>