<?php
session_start();
//include file config.php
include('config.php');

//jika benar mendapatkan GET id dari URL
if(isset($_GET['id'])){
	//membuat variabel $id yang menyimpan nilai dari $_GET['id']
	$id = $_GET['id'];

	//melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
	$cek = mysqli_query($dbcon, "SELECT * FROM member WHERE id='$id'") or die(mysqli_error($dbcon));

	//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
	if(mysqli_num_rows($cek) > 0){
		//query ke database DELETE untuk menghapus data dengan kondisi id=$id
		$del = mysqli_query($dbcon, "DELETE FROM member WHERE id='$id'") or die(mysqli_error($dbcon));
		if($del){
			$_SESSION['status'] = "Delete Successfully";
			header("Location: index.php?page=temp_data");
		}else{
			$_SESSION['status'] = "Not Delete.!";
			header("Location: index.php?page=temp_data");
		}
	}
}
