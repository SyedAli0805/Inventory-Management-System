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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" >
    <title>Customer</title>
</head>
<style>

table {
  border-collapse: collapse;
  width: 100%;
  padding: 0; 
}

th, td {
  border: 1px solid black;
  padding: 10px;
}

th {
  text-align: center;
  font-family: Arial, sans-serif;
  font-size: 16px;
  text-align: center;
  width: 100px; 
  white-space: nowrap; 
  overflow: hidden; 
  text-overflow: ellipsis;
  background-color: cornflowerblue;
  color: #fff;
}

tr:nth-child(even) {
  background-color:whitesmoke;
}

td {
  text-align: center;
  font-family: Arial, sans-serif;
  font-size: 14px;
  text-align: center;
  width: 50%;
  font-size: 13px;
  width: 100px; 
  white-space: nowrap; 
  overflow: hidden; 
  text-overflow: ellipsis;
}

input[type="submit"] {
  background-color: green;
  color: white;
  font-size: 16px;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

input[type="text"] {
  background-color: #fff;
  color: #000;
  font-size: 16px;
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 5px;
}

.search-container {
  position: relative;
  display: inline-block;
}

.search-input {
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  width: 200px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.search-button {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  padding: 10px;
  background-color: #f1f1f1;
  border: none;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
}

.fa-search {
  color: #888888;
}

h1 {
  text-align: center;
  color: cornflowerblue;
}
</style>
<body>
<form action="customers.php" method="get"> </form>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name = "search_customer" id = "search_customer"
      placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style ="margin:20px">Search</button>
   </form>
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
     <h1> Customers List</h1>
     <br>
        <table class="table table-bordered table-hover">
          <tr>
            <th scope="col">Customer ID </th>
            <th scope="col">Customer Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Address</th>
            <th scope="col">Email</th>
            <th scope="col" colspan="2",align="center"> Operations </th>
          </tr>
        </thead>
        <tbody>
          <?php 
          require_once("database.php");
          if(isset($_GET["search_customer"])){
            $customers = $databaseHandler -> getCustomers($_GET["search_customer"]);
          }
          else {
          $customers = $databaseHandler -> getCustomers();
        }
          foreach ($customers as $customer) { ?>
            <tr>
              <td><?php echo $customer -> id ?></td>
              <td><?php echo $customer -> customerName ?></td>
              <td><?php echo $customer -> phone ?></td>
              <td><?php echo $customer -> address ?></td>
              <td><?php echo $customer -> email ?></td>
              <td><br><a href="edit_customers.php?phone=<?php echo $customer -> phone ?>">
              <img src = "./img/edit.svg" height = "20px" alt = "Edit" />
              </a><br>
              </td>
              <td><br><a href="connect.php?request_type=delete_customer&id=<?php echo $customer -> id ?>"
                onclick="return confirm('Are you sure to delete product?');">
                <img src = "./img/trash.svg" height = "20px" alt = "Delete" />
                </a><br>
              </td>
            </tr>
        <?php } ?>

        </tbody>
      </table>
</body>
</html>