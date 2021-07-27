<?php
session_start();
include('config.php');
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data</font>
	</center>

	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
	if (isset($_GET['id'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$id = $_GET['id'];

		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($dbcon, "SELECT * FROM member WHERE id='$id'") or die(mysqli_error($dbcon));

		//jika hasil query = 0 maka muncul pesan error
		if (mysqli_num_rows($select) == 0) {
			echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
			exit();
			//jika hasil query > 0
		} else {
			//membuat variabel $data dan menyimpan data row dari query
			$row = mysqli_fetch_assoc($select);
		}
	}
	?>

	<?php
	//jika tombol simpan di tekan/klik
	if (isset($_POST['submit'])) {
		$fname	= $_POST['fname'];
		$lname	= $_POST['lname'];
		$phone	= $_POST['phone'];

		$sql = mysqli_query($dbcon, "UPDATE member SET fname='$fname', lname='$lname', phone='$phone' WHERE id='$id'") or die(mysqli_error($dbcon));

		if ($sql) {
			$_SESSION['status'] = "Update Successfully";
			header("Location: index.php?page=temp_data");
		} else {
			$_SESSION['status'] = "Not Update.!";
			header("Location: index.php?page=temp_data");
		}
	}
	?>

	<form action="edit.php?id=<?php echo $id; ?>" method="post">
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">First Name</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="fname" class="form-control" size="4" value="<?php echo $row['fname']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Last Name</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="lname" class="form-control" size="4" value="<?php echo $row['lname']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Phone</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="phone" class="form-control" size="4" value="<?php echo $row['phone']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<input type="submit" name="submit" class="btn btn-primary" value="Update Data">
				<a href="index.php?page=temp_data" class="btn btn-warning">data</a>
			</div>
		</div>
	</form>
</div>