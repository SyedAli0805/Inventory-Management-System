<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if($_SESSION['login'] != 'success'){
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <style>
    input[type="submit"] {
        background-color: green;
        color: white;
        font-size: 16px;
      }
</style>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="./landing.php"><img src ="./img/logo.PNG" alt = "Logo" height = "50px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./landing.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./customer_orders.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./customers.php">Customers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./add_orders.php">Add Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./add_products.php">Add Product</a>
      </li>
      </ul>
   <button class="btn btn-outline-danger my-2 my-sm-0" id = "logoutButton">Logout</button>
      <script>
        // Using JavaScript
       document.getElementById("logoutButton").onclick = function() {
                window.location.href = "logout.php";
        };
    </script>
  </div>
</nav>
</header>
<div class="container">
<div class="row col-md-6 col-md-offset-3">
<div class="panel panel-primary">
<div class="panel-heading text-center">
<h4>Add Order Details</h4>
</div>
<div class="panel-body">
<form action="add_orders.php" method="post">
<input type="hidden" name="request_type" value="proceed_order"/>
<div class="form-group">
<label for="phone_number">Phone Number</label>
<input
type="number"
class="form-control"
id="phone_number"
name="phone_number"
required
/>
<br>
<input type="submit" class="btn btn-primary" name="Proceed"/>
</form>
</div>
</div>
</div>
</div>
</body>
</html>