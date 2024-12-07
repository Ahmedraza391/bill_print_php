<?php 
    include("connection.php");
    $id =  $_POST["food_id"];
    $query = "SELECT * FROM tbl_foods WHERE id = $id";
    $res = mysqli_query($connection,$query);
    $fetch = mysqli_fetch_assoc($res);
    echo "$fetch[price]";
?>