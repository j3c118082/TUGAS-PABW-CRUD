<?php
require_once "config/database.php";

if (isset($_POST['simpan'])) {
	$nim = mysqli_real_escape_string($db, trim($_POST['nim']));
	$nama = mysqli_real_escape_string($db, trim($_POST['nama']));
	$jeniskelamin = $_POST['jeniskelamin'];
	$agama = $_POST['agama'];
	$for_query = '';  

	$nama_file = $_FILES['gambar']['name'];
	$ukuran_file = $_FILES['gambar']['size'];
	$tipe_file = $_FILES['gambar']['type'];
	$tmp_file = $_FILES['gambar']['tmp_name'];
	$path = "pic_galih/".$nama_file;

	if($tipe_file == "image/jpeg" || $tipe_file == "image/png")
		if($ukuran_file <= 2000000)
			move_uploaded_file($tmp_file, $path);
			
	if(!empty($_POST["olahraga"])){
		foreach($_POST["olahraga"] as $olahraga){
			$for_query .= $olahraga. ', ';
		}
		$for_query = substr($for_query, 0, -2);	
	}
	
	$query = mysqli_query($db, "INSERT INTO siswa (nim, nama, jeniskelamin, agama, olahraga, gambar) VALUES ('$nim', '$nama', '$jeniskelamin', '$agama', '$for_query', '$nama_file')");	
	if ($query) {
		header('location: index.php?alert=2');
	} else {
		header('location: index.php?alert=1');
	}
}
?>