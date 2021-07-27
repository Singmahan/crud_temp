<?php 
    session_start();
    include('config.php'); 
?>

<center>
    <font size="6">Add Data</font>
</center>
<hr>
<?php
if (isset($_POST['submit'])) {

    $fname    = $_POST['fname'];
    $lname    = $_POST['lname'];
    $phone    = $_POST['phone'];

    $cek = mysqli_query($dbcon, "SELECT * FROM member WHERE id='$id'") or die(mysqli_error($dbcon));

    if (mysqli_num_rows($cek) == 0) {
        $sql = mysqli_query($dbcon, "INSERT INTO member(fname,lname,phone) VALUES('$fname','$lname','$phone')") or die(mysqli_error($dbcon));

        if ($sql) {
            $_SESSION['status'] = "Insert Successfully";
            header("Location: index.php?page=temp_data");
        } else {
            $_SESSION['status'] = "Not Insert.!";
            header("Location: index.php?page=temp_data");
        }
    } 
}
?>

<form action="add_data.php" method="post">
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">First Name</label>
        <div class="col-md-6 col-sm-6">
            <input type="text" name="fname" class="form-control" required>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Last Name</label>
        <div class="col-md-6 col-sm-6">
            <input type="text" name="lname" class="form-control" required>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Phone</label>
        <div class="col-md-6 col-sm-6">
            <input type="text" name="phone" class="form-control" required>
        </div>
    </div>
    <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <input type="submit" name="submit" class="btn btn-primary" value="add data">
        </div>
</form>
</div>