<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill Printer /</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container bg-body-secondary p-5 main">
    <div class="row m-0 px-3 bg-body-tertiary py-1 my-2 rounded-1 nav_row">
      <div class="col-md-12">
        <div class="nav d-flex align-items-center justify-content-between ">
          <div class="brand_name">
            <h3 class="m-0 fw-bolder ">Ahmed Foods...</h3>
          </div>
          <div class="btns ms-auto ">
            <a href="insert_food.php" class="btn btn-outline-primary btn-sm">Insert Food</a>
            <a href="update_food.php" class="btn btn-outline-primary btn-sm">Update Food</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row m-0 bg-white mb-2 p-2 d-md-none d-block">
      <div class="col-md-12">
        <h2 class="fw-bolder ">Ahmed Foods....</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tables">
          <table class="table text-center align-middle px-5 rounded upper_table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Fast Food</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Add</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <form>
                  <th>1</th>
                  <td>
                    <select class="form-select" name="food" id="food" required>
                      <option hidden value="">Select Food Item</option>
                      <?php
                      include("connection.php");
                      $res = mysqli_query($connection, "SELECT * FROM tbl_foods");
                      foreach ($res as $data) {
                        echo "<option id='$data[id]' attr='$data[name]' value='$data[id]'>$data[name]</option>";
                      }
                      ?>
                      <input type="hidden" id="name">
                    </select>
                  </td>
                  <td><input type="number" id="qty" placeholder="0" class="form-control" min="0"></td>
                  <td id="price">0</td>
                  <td><button class="btn btn-outline-primary" id="add_btn">Add</button></td>
                </form>
              </tr>
            </tbody>
          </table>
          <div class="message mb-2 ">
            <span id="message" class="text-danger fw-bolder "></span>
          </div>
          <table class="table text-center align-middle rounded ">
            <thead>
              <tr>
                <th scope="col">Food ID</th>
                <th scope="col">Food Name</th>
                <th scope="col">Food Price</th>
                <th scope="col">Food Qty</th>
                <th scope="col">Total Price</th>
                <th scope="col" id="remove_col">Remove</th>
              </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
          </table>
          <div class="row m-0">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <table class="table text-center align-middle px-1 rounded ">
                <thead>
                  <th>Sub Total Price </th>
                </thead>
                <tbody>
                  <tr>
                    <td id="s_t_price">0</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
          <div class="print_table">
            <button class="btn btn-danger print_btn">Print Bill</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6"></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.js"></script>
  <script>
    $(document).ready(function() {
      $("#food").on("change", function() {
        var food = $("#food").val();
        $.ajax({
          url: "fetch_price.php",
          type: "POST",
          data: {
            food_id: food
          },
          success: function(data) {
            $("#price").html(data);
          }
        })
      })
      var count = 1;
      $(document).on("click", "#add_btn", function(e) {
        e.preventDefault();
        var food = $("#food").val();
        var foodName = $("#food option:selected").attr("attr");
        var qty = parseInt($("#qty").val());
        var price = parseFloat($("#price").text());
        var t_price = price * qty;
        if ($("#food").val() == "") {
          $("#message").text("Please Select Food Item First");
        } else {
          $("#message").text("");
          $("form").trigger("reset");
          if (isNaN(qty) || qty <= 0) {
            $("#message").text("Minimum Qty should be 1 or More than 1");
          } else {
            $("#message").text("");
            var tbody = $("#tbody");
            var newRow = $("<tr><td>" + count + "</td><td>" + foodName + "</td><td>" + price + "</td><td>" + qty + "</td><td id='t_price'>" + t_price + "</td><td><button class='btn btn-danger remove_btn'>X</button></td></tr>");
            tbody.append(newRow);
            updateTotal();
          }
          count++;
        }
      });

      $(document).on("click", ".remove_btn", function(e) {
        $(this).closest("tr").remove();
        updateTotal();
      });

      function updateTotal() {
        var total = 0;
        $("#tbody tr #t_price").each(function() {
          var value = parseFloat($(this).text());
          total += value;
        });
        $("#s_t_price").text(total);
      }

      $(".print_btn").on("click", function() {
        print();
      })
    })
  </script>

</body>

</html>