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
<title>Order Page</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <style>
    input[type="submit"] {
        background-color: green;
        color: white;
        font-size: 16px;
      }
    select {
        border-radius: 5px;
        width: 100px;
        background-color:cadetblue;
        color:azure;
        font-size: 16px;
      }
      option {
        background-color:darkcyan;
        color:bisque;
      }

      option:hover {
        background-color:darkseagreen;
        color:coral;
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
<?php
require_once("database.php");
if(!isset($_POST["phone_number"])) {
  header("Location: proceed_order.php");
}
$phoneNumber = $_POST["phone_number"];
$customer = $databaseHandler -> getCustomer($phoneNumber);
?>
<div class="container">
<div class="row col-md-6 col-md-offset-3">
<div class="panel panel-primary">
<div class="panel-heading text-center">
<h4>Add Order Details</h4>
<div>
  <p1 style="color : green">
    <?php 
    if(!is_null($customer)){
     echo "Welcome ".$customer -> customerName;
    }
    else{
      echo "Welcome New Customer";
    }
    ?>
  </p1>
</div>
<?php 
if(isset($_POST["error"])) {?>
<div>
  <p1 style="color : red">
    <?php echo $_POST["error"];?>
  </p1>
</div>
<?php } ?>
</div>
<div class="panel-body">
<form action="connect.php" method="post">
<input type="hidden" name="request_type" value="add_order" />
<div class="form-group">
<label for="customer_name">Customer Name</label>
<input
type="text"
class="form-control"
id="customer_name"
value="<?php if (!is_null($customer)) echo $customer -> customerName ?>"
name="customer_name"
<?php if (is_null($customer)) ?> required
/>
</div>
<div class="form-group">
  <label for="phone_number">Phone Number</label>
  <input
  type="text"
  class="form-control"
  id="phone_number"
  value="<?php if (!is_null($customer)) echo $customer -> phone; else echo $phoneNumber ?>"
  name="phone_number"
  />
  </div>
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input
  type="text"
  class="form-control"
  id="email"
  value="<?php if (!is_null($customer)) echo $customer -> email ?>"
  name="email"
  <?php if (is_null($customer)) ?> required
  />
  </div>
<div class="form-group">
<label for="sh_address">Shipping Address</label>
<input
type="text"
class="form-control"
id="sh_address"
value="<?php if (!is_null($customer)) echo $customer -> address ?>"
name="sh_address"
<?php if (is_null($customer)) ?> required
/>
</div>
<div class="form-group">
    <label for="product_name">Product Name</label><br>
    <select class = "form-control" name="product_id">
      <option class = "form-control" value="none">Select Product</option>
      <?php 
      require_once("database.php");
      $products = $databaseHandler -> getProducts();
      foreach ($products as $product) { ?>
        <option 
        <?php if (isset($_POST["product_id"])) {
            echo $product -> id == $_POST['product_id'] ? 'selected' : '';
        } ?>
        value="<?php echo $product -> id ?>"><?php echo $product -> name?></option>
      <?php
      }?>
      </select>
    </div>
    <div class="form-group">
        <label for="product_quantity">Product Quantity</label>
        <input
        type="text"
        class="form-control"
        value="<?php echo isset($_POST['product_quantity']) ? $_POST['product_quantity'] : '' ?>"
        id="product_quantity"
        name="product_quantity"
        <?php if (is_null($customer)) ?> required
        />
        </div>

<input type="submit" class="btn btn-primary" name="Confirm"/>
</form>
</div>
</div>
</div>
</div>
</body>
</html>