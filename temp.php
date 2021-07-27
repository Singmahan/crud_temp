<?php
session_start();
//memasukkan file config.php
include('config.php');
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Data Student</font>
	</center>
	<hr>
	<a href="index.php?page=add_data_data"><button class="btn btn-primary right">+ add data</button></a>
	<div class="table-responsive">

		<?php
		if (isset($_SESSION['status']) && $_SESSION != '') {
		?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Hey! </strong> <?php echo $_SESSION['status']; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
			unset($_SESSION['status']);
		}
		?>
		<table class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>
					<th>NO.</th>

					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone</th>
					<th>edit</th>
					<th>delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
				$sql = mysqli_query($dbcon, "SELECT * FROM member ORDER BY id DESC") or die(mysqli_error($dbcon));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if (mysqli_num_rows($sql) > 0) {
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while ($row = mysqli_fetch_assoc($sql)) {
						//menampilkan data perulangan
						echo '
						<tr>
							<td>' . $no . '</td>
							
							<td>' . $row['fname'] . '</td>
							<td>' . $row['lname'] . '</td>
							<td>' . $row['phone'] . '</td>
							<td>
								<a href="index.php?page=edit_data&id=' . $row['id'] . '" class="btn btn-secondary btn-sm">Edit</a>
                            </td>
                            <td>
                            <a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Delete?\')">Delete</a>
                            </td>
						</tr>
						';
						$no++;
					}
					//jika query menghasilkan nilai 0
				} else {
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
</div>