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
<title>Customers</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<style>
    input[type="submit"] {
        background-color: green;
        color: white;
        font-size: 16px;
      }
    .container{
        margin-top: 100px;
      }
</style>
<body>
  <script>
  function buttonHovered() {
  var button = document.getElementById("myButton");
  button.classList.add("hovered");
}

function buttonNotHovered() {
  var button = document.getElementById("myButton");
  button.classList.remove("hovered");
}
</script>
<header>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
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
        <a class="nav-link" href="#">Customers</a>
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
<?php
require_once("database.php");
$phone = $_GET["phone"];
$customer = $databaseHandler -> getCustomer($phone);
?>
<div class="container">
<div class="row col-md-6 col-md-offset-3">
<div class="panel panel-primary">
<div class="panel-heading text-center">
<h4>Edit Customer Details</h4>
</div>
<div class="panel-body">
<form action="connect.php" method="post">
  <input type="hidden" name="request_type" value="edit_customers" />
  <input type="hidden" name="phone" value="<?php echo $customer->phone ?>" />
<div class="form-group">
<label for="customer_name">Customer Name</label>
<input
type="text"
class="form-control"
id="customer_name"
value="<?php echo $customer -> customerName ?>"
name="customer_name"/>
</div>
<div class="form-group">
<label for="phone">Phone Number</label>
<input
type="text"
class="form-control"
id="phone"
value="<?php echo $customer -> phone ?>"
name="phone"/>
</div>
<div class="form-group">
<label for="address">Address</label>
<input
type="text"
class="form-control"
id="text"
value="<?php echo $customer -> address ?>"
name="address"
/>
</div>
<div class="form-group">
<label for="email">Email</label>
<input
type="text"
class="form-control"
id="text"
value="<?php echo $customer -> email ?>"
name="email"
/>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="Confirm"/>
</form>
</div>
</div>
</div>
</div>
</body>
</html>