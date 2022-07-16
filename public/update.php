<?php

$dbUser="root";
$dbPass="";
$dbName="wikan_db";
$dbHost="localhost";

$conn=mysqli_connect($dbHost,$dbUser,$dbPass) or die ("Server tidak ditemukan");
mysqli_select_db($conn,$dbName) or die ("database Tidak ditemukan");

$data = $_POST['dt'];
$nm = $_POST['nm'];
$i = 0;

foreach($data as $da){
	$s = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_option WHERE nama = '$nm[$i]'"));
	if(!$s){ 
		$sa = mysqli_query($conn,"INSERT INTO tb_option (nama, konten, status, created_at, updated_at) VALUES('$nm[$i]', '$da','1',NOW(),NOW())"); 
	if($sa) $d = '1'; 
			}
	else { 
		$sa = mysqli_query($conn,"UPDATE tb_option SET konten = '$da' WHERE nama = '$nm[$i]'"); 
		if($sa) $d = '1'; else $d = '2'.mysqli_error(); 
		}
	 $i++;
	
}
header("location:index.blade.php");
// echo $d;
// mengalihkan ke halaman index.ph

?>
