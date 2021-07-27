<?php 

    $dbcon = mysqli_connect("localhost","root","","crud_temp");
    if(mysqli_connect_errno()){
        echo "kkk". mysqli_connect_error();
    }
?>