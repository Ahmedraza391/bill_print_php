<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Food /</title>
    <link rel="stylesheet" href="./css//style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="main container bg-body-secondary p-0 ">
        <div class="row m-0">
            <div class="col-md-12 p-0 merge">
                <div class="left">
                    <div class="image">
                        <img src="./image//burger-hamburger-cheeseburger_505751-3690.avif" alt="">
                    </div>
                </div>
                <div class="right">
                    <div class="form">
                        <h1 class="form_heading">Insert Food</h1>
                        <form id="form">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Food Name</span>
                                <input type="text" class="form-control" id="fname" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Food Price</span>
                                <input type="number" class="form-control" id="fprice" required>
                            </div>
                            <span id="massage" class="text-danger d-block mb-1"></span>
                            <button type="button" id="insert_btn" class="btn btn-outline-success ">Insert Food</button>
                            <a href="index.php" class="btn btn-outline-dark ">Main Menu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#insert_btn").on("click",function(){
                var food_name = $("#fname").val();
                var food_price = $("#fprice").val();
                if(food_name == "" || food_price == ""){
                    $("#massage").html("Please Insert Values First");
                }else{
                    $.ajax({
                        url : "insert_food_in.php",
                        type : "POST",
                        data:{
                            name : food_name,
                            price : food_price
                        },
                        success:function(data){
                            alert("food Inserted successfully");
                            $("#form").trigger("reset")
                        }
                    })  
                }
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>