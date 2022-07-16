<?php

$dbUser="root";
$dbPass="";
$dbName="wikan_db";
$dbHost="localhost";

$conn=mysqli_connect($dbHost,$dbUser,$dbPass) or die ("Server tidak ditemukan");
mysqli_select_db($conn,$dbName) or die ("database Tidak ditemukan");

$namaSitus=$_POST['txtNama'];
$deskripsiSitus=$_POST['txtDesk'];
$alamat=$_POST['txtAlamat'];
$telp=$_POST['txtTelp'];
$whatsapp=$_POST['txtWhatsapp'];
$email=$_POST['txtEmail'];
$lokasi=$_POST['txtLokasi'];

$data=[$namaSitus,$deskripsiSitus,$alamat,$telp,$whatsapp,$email,$lokasi];

$i = 0;

foreach($data as $da){
	$s = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_option WHERE nama = '$da[$i]'"));
	if(!$s){ 
		$sa = mysqli_query($conn,"INSERT INTO tb_option (nama, konten, status, created_at, updated_at) VALUES('$da[$i]', '$da','1',NOW(),NOW())"); 
	if($sa) $d = '1'; 
			}
	else { 
		$sa = mysqli_query($conn,"UPDATE tb_option SET konten = '$da' WHERE nama = '$da[$i]'"); 
		if($sa) $d = '1'; else $d = '2'.mysqli_error(); 
		}
	 $i++;
	
}
echo $d;
// echo $d;
// mengalihkan ke halaman index.ph

?>
