<?php
require_once('database.php');
$requestType = "";
if(isset($_POST["request_type"])){
    $requestType = $_POST["request_type"];
} else if(isset($_GET["request_type"])) {
    $requestType = $_GET["request_type"];
}
if($requestType == "add_product") {
    $product = new Product();
    $product -> name = $_POST["product_name"];
    $product -> quantity = $_POST["quantity"];
    $product -> unitPrice = $_POST["unit_price"];

    $databaseHandler -> insertProduct($product);

    header("Location: products.php");
}
else if($requestType == "add_admin"){
    $admin = new Admin();
    $admin -> adminName = $_POST["name"];
    $admin -> email = $_POST["email"];
    $admin -> phone = $_POST["phone"];
    $admin -> address = $_POST["address"];
    $admin -> username = $_POST["username"];
    $admin -> password = $_POST["password"];

    $databaseHandler -> insertAdmin($admin);

    header("Location: login.php");

}
else if($requestType == "login"){
    $userName = $_POST["username"];
    $password = $_POST["password"];

    $admin = $databaseHandler -> login($userName,$password);
    if($admin != null){
        if(!isset($_SESSION)){ 
             session_start(); 
        }
        $_SESSION['login'] = 'success';
        header("Location: landing.php");
    }
    else{
        header("Location: login.php?username=$userName&error=true"); 
    }
}
else if($requestType == "edit_products"){
    $product = new Product();
    $product -> id = $_POST["id"];
    $product -> name = $_POST["product_name"];
    $product -> quantity = $_POST["quantity"];
    $product -> unitPrice = $_POST["unit_price"];

    $databaseHandler -> updateProduct($product);

    header("Location: products.php");
}
else if($requestType == "edit_customers"){
   $customer = new Customer();
   $customer -> id = $_POST["id"];
   $customer -> customerName = $_POST["customer_name"];
   $customer -> phone = $_POST["phone"];
   $customer -> address = $_POST["address"];
   $customer -> email = $_POST["email"];

   $databaseHandler -> insertOrUpdateCustomer($customer);

   header("Location: customers.php");
}
else if($requestType == "delete_product"){    
    $productId = $_GET["id"];
    try {
        $databaseHandler -> deleteProduct($productId);
        header("Location: products.php");
        //echo "Product deleted successfully.";
    } 
    catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            $error = "Cannot delete the product. It is associated with one or more orders.";
            header("Location: products.php?error=$error");
        } else {
            header("Location: products.php?error=".$e->getMessage());
        }
    } catch (Exception $e) {
        header("Location: products.php?error=".$e->getMessage());
    }    
}
else if($requestType == "delete_customer"){    
    $customerId = $_GET["id"];
    $databaseHandler -> deleteCustomer($customerId);

    header("Location: customers.php");
}
else if($requestType == "delete_order"){    
    $orderId = $_GET["id"];
    $databaseHandler -> deleteOrder($orderId);

    header("Location: customer_orders.php");
}
else if($requestType == "update_status"){    
    $orderId = $_GET["id"];
    $databaseHandler -> markAsComplete($orderId);

    header("Location: customer_orders.php");
}
else if($requestType == "add_order"){
    try {
    $order = new Order();
    $order -> productId = $_POST["product_id"];
    $order -> quantity = $_POST["product_quantity"];

    $customer = new Customer();
    $customer -> customerName = $_POST["customer_name"];
    $customer -> phone = $_POST["phone_number"];
    $customer -> address = $_POST["sh_address"];
    $customer -> email = $_POST["email"];

    $order -> customer = $customer;

    $databaseHandler -> insertOrUpdateCustomer($customer);
 
    $databaseHandler -> insertOrder($order);

    header("Location: customer_orders.php");
    } catch (InvalidArgumentException $e) {?>
        <form id="resubmitForm" action="add_orders.php" method="post">
        <?php
            foreach ($_POST as $a => $b) {
                echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
            }
            echo '<input type="hidden" name="error" value="'.htmlentities($e->getMessage()).'">';
        ?>
        </form>
        <script type="text/javascript">
            document.getElementById('resubmitForm').submit();
        </script>
    <?php }
}
?>