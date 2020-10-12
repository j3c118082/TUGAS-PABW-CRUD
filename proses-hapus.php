<?php
require_once "config/database.php";
if (isset($_GET['id'])) {
	$nim = $_GET['id'];
	$query = mysqli_query($db, "DELETE FROM siswa WHERE nim='$nim'");
	if ($query) {
		header('location: index.php?alert=4');
	} else {
		header('location: index.php?alert=1');
	}
}							
?>