// JavaScript Document
function showTime(){
 if (!document.layers&&!document.all&&!document.getElementById) return
 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()
 var hr=Digital.getDay()
 var bln=Digital.getMonth()
 var thn=Digital.getFullYear()
 switch(hr){
	 case 0: hari="Minggu"
	 break;
	 case 1: hari="Senin"
	 break;
	 case 2: hari="Selasa"
	 break;
	 case 3: hari="Rabu"
	 break;
	 case 4: hari="Kamis"
	 break;
	 case 5: hari="Jumat"
	 break;
	 case 6: hari="Sabtu"
	 break;
 }
  switch(bln){
	 case 0: bulan="Januari"
	 break;
	 case 1: bulan="Februari"
	 break;
	 case 2: bulan="Maret"
	 break;
	 case 3: bulan="April"
	 break;
	 case 4: bulan="Mei"
	 break;
	 case 5: bulan="Juni"
	 break;
	 case 6: bulan="Juli"
	 break;
	 case 7: bulan="Agustus"
	 break
	 case 8: bulan="September"
	 break;
	 case 9: bulan="Oktober"
	 break;
	 case 10: bulan="November"
	 break;
	 case 11: bulan="Desember"
	 break;
 }
 if (hours<10)
  hours="0"+hours
 if (minutes<=9)
  minutes="0"+minutes
 if (seconds<=9)
  seconds="0"+seconds

var myclock="<b>"+hari+", "+Digital.getDate()+" "+bulan+" "+thn+"</b> "+hours+":"+minutes+":"+seconds+" WIB"
if (document.layers){
  document.layers.liveclock.document.write(myclock)
  document.layers.liveclock.document.close()
}
else if (document.all)
  liveclock.innerHTML=myclock
else if (document.getElementById)
// document.getElementById("liveclock").innerHTML=myclock
  $("#liveclock").val(myclock);

  setTimeout("showTime()",1000)
}

// window.onload(showTime())
