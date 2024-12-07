<?php
    include("connection.php");
    $name = $_POST['name'];
    $price = $_POST['price'];
    $query = "INSERT INTO tbl_foods (name,price)VALUES('$name','$price')";
    $result = mysqli_query($connection,$query);
?>