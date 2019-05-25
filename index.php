<?php
/**
* Created by Serdar KARACA.
* User: serdarkaraca
* Date: 28/06/2017
* Time: 07:24
* Content: PDO Example, krc.db_functions example, Javascript, Jquery, Json Data
*/
include ("functions/krc.db_functions.php");
$DB = new DB_Class();
?>
 
 
 
<html>
<head>
<title>Serdar KARACA - JavaScript ile PDO Kullanımı Örnek Proje</title>
<style type="text/css">
body{margin: 0px;font-family:Tahoma,Verdana;background-color:darkorange;}
.container{width: 600px;height:auto;margin-top: 30px;margin-left: 50px;border:1px solid white; padding-left: 5px;}
.sonuc{width: 600px;height:25px;color: white;font-size: 16px;margin-top: 30px;}
</style>
 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/inputmask.js"></script>
 
<script type="text/javascript">
$(document).ready(function() {
//Kayıt ekleme için javascript fonksiyonu
document.getElementById("insert_sonuc").innerText = "";
$('#btn_Kaydet').click(function() {
//alert("test");
var isimsoyisim = $('#txt_isimsoyisim').val();
var yas = $('#txt_yas').val();
var telefon = $('#txt_telefon').val();
if (isimsoyisim != "" && yas != "") {
var json_data = {};
json_data.isimsoyisim = isimsoyisim;
json_data.yas = yas;
json_data.telefon = telefon;
$.ajax({
url: "Insert.php",
method: "post",
data: json_data,
success: function(response) {
if (response == "Success") {
document.getElementById("insert_sonuc").innerText = "";
document.getElementById("insert_sonuc").innerHTML += 'Kayıt Başarılı';
} else {
document.getElementById("insert_sonuc").innerText = "";
document.getElementById("insert_sonuc").innerHTML += 'Kayıt Başarısız, Lütfen Sistem Yöneticisi İle İletişime Geçiniz.';
}
 
console.log(response);
if (response.trim() == "Success")
console.log("Success");
else
console.log("Failed : " + response);
}
});
}
else
{
document.getElementById("insert_sonuc").innerText = "";
document.getElementById("insert_sonuc").innerHTML += 'Uyarı ! : İsim soyisim ve yaş kısmını boş bırakamazsınız.';
}
});
 
//Kayıt ekleme için javascript fonksiyonu
 
 
 
});
 
</script>
 
 
 
<script type="text/javascript">
$(document).ready(function() {
//Kayıt ekleme için javascript fonksiyonu
document.getElementById("update_sonuc").innerText = "";
$('#btn_Guncelle').click(function() {
//alert("test");
var uyeid1 = $('#txt_UyeID_1').val();
var yas1 = $('#txt_yas_1').val();
var telefon1 = $('#txt_telefon_1').val();
if (yas1 != "" && telefon1 != "") {
var json_data = {};
json_data.uyeid = uyeid1;
json_data.yas = yas1;
json_data.telefon = telefon1;
$.ajax({
url: "Update.php",
method: "post",
data: json_data,
success: function(response) {
if (response == "Success") {
document.getElementById("update_sonuc").innerText = "";
document.getElementById("update_sonuc").innerHTML += 'Güncelleme Başarılı';
} else {
document.getElementById("update_sonuc").innerText = "";
document.getElementById("update_sonuc").innerHTML += 'Güncelleme Başarısız, Lütfen Sistem Yöneticisi İle İletişime Geçiniz.';
}
 
console.log(response);
if (response.trim() == "Success")
console.log("Success");
else
console.log("Failed : " + response);
}
});
}
else
{
document.getElementById("update_sonuc").innerText = "";
document.getElementById("update_sonuc").innerHTML += 'Uyarı ! : Yaş ve Telefon Kısmını Boş Bırakamazsınız.';
}
});
 
//Kayıt ekleme için javascript fonksiyonu
 
 
 
});
 
</script>
 
 
 
</head>
<body>
 
 
 
<h2 style="text-align: center; margin-top: 30px;">JavaScript ile PDO Örnekleri --- serdarkaraca.com</h2>
 
<br>
 
<div class="container">
 
<h4>Insert - Kayıt Ekleme</h4>
 
<br>
 
<table>
<tr>
<td>İsim Soyisim :</td>
<td><input type="text" id="txt_isimsoyisim"></td>
</tr>
<tr>
<td>Yaş :</td>
<td><input type="text" id="txt_yas"></td>
</tr>
<tr>
<td>Telefon :</td>
<td><input type="text" id="txt_telefon" data-mask="9(999) 999 99 99"></td>
</tr>
<tr>
<td></td>
<td><input type="button" id="btn_Kaydet" value="Kaydet"></td>
</tr>
</table>
 
<div id="insert_sonuc" class="sonuc"></div>
 
</div>
 
 
 
<div class="container">
 
<h4>Select - Veritabanında ki kayıtları listeleme</h4>
<br>
 
<table border="1">
<tr>
<th>Üye ID</th>
<th>İsim</th>
<th>Yaş</th>
<th>Telefon</th>
<th>Tarih Saat</th>
<th>İp Adres</th>
</tr>
 
 
 
<?php
 
 
 
$Query = $DB->select("*", "tbl_uyeler");
if($Query != null)
foreach ($Query as $Data)
{
?>
<tr>
<td><?PHP echo $Data["UyeID"] ?></td>
<td><?PHP echo $Data["IsimSoyisim"] ?></td>
<td><?PHP echo $Data["Yas"] ?></td>
<td><?PHP echo $Data["Telefon"] ?></td>
<td><?PHP echo $Data["KayitTarihi"] ?> - <?PHP echo $Data["KayitSaati"] ?></td>
<td><?PHP echo $Data["IpAddress"] ?></td>
</tr>
 
<?PHP
}
 
?>
 
</table>
 
</div>
 
 
 
<div class="container">
 
<h4>Select (Where) - Veritabanında ki kayıtları koşullu listeleme</h4>
 
<h5>Örnek olarak üye id'si 2 olanı listeliyorum.</h5>
 
 
 
<table border="1">
<tr>
<th>Üye ID</th>
<th>İsim</th>
<th>Yaş</th>
<th>Telefon</th>
<th>Tarih Saat</th>
<th>İp Adres</th>
</tr>
 
 
 
<?php
 
 
 
$Query = $DB->select("*", "tbl_uyeler","Where UyeID=2");
if($Query != null)
foreach ($Query as $Data)
{
?>
<tr>
<td><?PHP echo $Data["UyeID"] ?></td>
<td><?PHP echo $Data["IsimSoyisim"] ?></td>
<td><?PHP echo $Data["Yas"] ?></td>
<td><?PHP echo $Data["Telefon"] ?></td>
<td><?PHP echo $Data["KayitTarihi"] ?> - <?PHP echo $Data["KayitSaati"] ?></td>
<td><?PHP echo $Data["IpAddress"] ?></td>
</tr>
 
<?PHP
}
 
 
 
?>
 
 
 
</table>
 
</div>
 
 
 
<div class="container">
 
 
 
<?php
 
 
$Query = $DB->select("*", "tbl_uyeler","Where UyeID=2");
if($Query != null)
foreach ($Query as $Data)
{
$__uyeid = $Data["UyeID"];
$__isim = $Data["IsimSoyisim"];
$__telefon = $Data["Telefon"];
$__yas = $Data["Yas"];
}
 
 
 
?>
 
 
 
<h4>Update - Güncelleme</h4>
 
<table>
<tr>
<td>Üye ID :</td>
<td><input type="text" id="txt_UyeID_1" value="<?PHP echo $__uyeid ?>"></td>
</tr>
</table>
 
<table>
<tr>
<td>İsim Soyisim :</td>
<td><input type="text" id="txt_isimsoyisim_1" value="<?PHP echo $__isim ?>" disabled></td>
</tr>
<tr>
<td>Yaş :</td>
<td><input type="text" id="txt_yas_1" value="<?PHP echo $__yas ?>"></td>
</tr>
<tr>
<td>Telefon :</td>
<td><input type="text" id="txt_telefon_1" data-mask="9(999) 999 99 99" value="<?PHP echo $__telefon ?>"></td>
</tr>
<tr>
<td></td>
<td><input type="button" id="btn_Guncelle" value="Güncelle"></td>
</tr>
</table>
 
<div id="update_sonuc" class="sonuc"></div>
 
</div>
 
 
 
<div class="container">
 
<h4>Delete - Listelenen Verileri Silme İşlemi</h4>
<br>
 
<table border="1">
<tr>
<th>İşlem</th>
<th>Üye ID</th>
<th>İsim</th>
<th>Yaş</th>
<th>Telefon</th>
<th>Tarih Saat</th>
<th>İp Adres</th>
</tr>
 
 
 
<?php
 
 
 
$Query = $DB->select("*", "tbl_uyeler", "WHERE UyeID > 2");
if($Query != null)
foreach ($Query as $Data)
{
?>
<tr>
<td><a href="Delete.php?UyeID=<?PHP echo $Data["UyeID"] ?>"> Sil </a></td>
<td><?PHP echo $Data["UyeID"] ?></td>
<td><?PHP echo $Data["IsimSoyisim"] ?></td>
<td><?PHP echo $Data["Yas"] ?></td>
<td><?PHP echo $Data["Telefon"] ?></td>
<td><?PHP echo $Data["KayitTarihi"] ?> - <?PHP echo $Data["KayitSaati"] ?></td>
<td><?PHP echo $Data["IpAddress"] ?></td>
</tr>
 
<?PHP
}
 
 
 
?>
 
 
 
</table>
 
</div>
 
 
 
<br><br><br>
 
</body>
</html>
