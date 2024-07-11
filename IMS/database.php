<?php
class Product {
    public $id;
    public $name;
    public $quantity;
    public $unitPrice;
}
class Order {
    public $id;
    public $customer;
    public $quantity;
    public $totalAmount;
    public $productId;

    public $orderStatus;

    function getOrderStatusText(){
        if($this -> orderStatus == 0){
            return "Pending";
        }
        else{
            return "Completed";
        }
    }

}
class Customer {
    public $customerName;
    public $phone;
    public $address;
    public $email;
    public $id;
}
class DashboardReport{

    public $dailyOrders;
    public $weeklyOrders;

    public $monthlyOrders;

    public $totalCustomers;
}

class Admin{

    public $adminName;
    public $phone;
    public $address;
    public $email;
    public $username;

    public $password;
}
class DatabaseHandler {
    function getConnection() {
        //connect to sql
        $conn = new mysqli('localhost','root','12345678','ims');
        return $conn;
    }

    function login($email,$password) {
            // Create connection
            $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            $sql = "SELECT * FROM `login` where email = ? AND password = ?";

            $stmt = $conn->prepare($sql);
    
            if ($conn->error_list) {
                print("Errors occured <br />");
                print_r( $conn -> error_list);
                die();
            }

            $stmt->bind_param("ss",$email,$password);
    
            $stmt -> execute();
    
            if ($conn->error_list) {
                print("Errors occured <br />");
                print_r( $conn -> error_list);
                die();
            }
    
            $result = $stmt->get_result();

            $admin = null;
            if ($result -> num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $admin = new Admin();
                    $admin -> username = $row["email"];
                }
            }
            $conn->close();
    
            return $admin;
    }
    function insertAdmin($admin) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("INSERT INTO login (login.name,email,phone,login.address,username,login.password) values(?, ?, ?, ?, ?, ?)");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("ssssss",$admin->adminName,$admin->email,$admin->phone,$admin->address,$admin->username
        ,$admin->password);
        $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }

    function insertProduct($product) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("INSERT INTO product (product_name,quantity,unit_price) values(?, ?, ?)");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("sii",$product -> name,$product -> quantity,$product -> unitPrice);
        $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }

    function insertOrder($order) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("INSERT INTO `order` (customer_id,product_id,product_quantity,total_amount) 
        values(?, ?, ?, ?)");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }
        $customer = $this -> getCustomer($order -> customer -> phone);
        $product = $this -> getProduct($order -> productId);
        if ($product -> quantity < $order -> quantity) {
            throw new InvalidArgumentException("Available quantity for ".$product -> name." is ".$product -> quantity);
        }
        $totalAmount = $product -> unitPrice * $order -> quantity;
            
        $stmt->bind_param("ssss",$customer -> id,$order -> productId,$order -> quantity, 
        $totalAmount);
        $stmt -> execute();

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }

    function insertOrUpdateCustomer($tempCustomer) {  
        $customer = $this -> getCustomer($tempCustomer -> phone);
        if(is_null($customer)){
            $customer = $tempCustomer;
            $conn = $this -> getConnection();
            $stmt = $conn->prepare("INSERT INTO customer (customer_name,phone,address,email) values(?, ?, ?, ?)");

            if ($conn->error_list) {
                print("Errors occured <br />");
                print_r( $conn -> error_list);
                die();
            }

            $stmt->bind_param("ssss",$customer -> customerName,$customer -> phone,$customer -> address,
            $customer -> email);
            $stmt -> execute();


            if ($conn->error_list) {
                print("Errors occured <br />");
                print_r( $conn -> error_list);
                die();
            }

            //close to sql
            $stmt -> close();
            $conn -> close();
        }
        else{
        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("UPDATE customer SET customer_name = ?,
        phone = ?,
        address = ?,
        email = ?
         WHERE c_id = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("sssss",$tempCustomer -> customerName,$tempCustomer -> phone,$tempCustomer -> address,
         $tempCustomer -> email, $customer -> id);
        $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();

        }
    }

    function getProduct($id) {
        // Create connection
        $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM product where id = $id";
        $result = $conn->query($sql);

        $product = null;
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $product = new Product();
                $product -> id = $row["id"];
                $product -> name = $row["product_name"];
                $product -> quantity = $row["quantity"];
                $product -> unitPrice = $row["unit_price"];

            }
        } 
        $conn->close();

        return $product;
    }

    function updateProduct($product) {        
        $conn = $this -> getConnection();

        $stmt = $conn->prepare("UPDATE product SET product_name = ?,
        quantity = ?,
        unit_price = ?
         WHERE id = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("siii",$product -> name,$product -> quantity,$product -> unitPrice, $product -> id);
        $stmt -> execute();

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }
    

    function deleteProduct($productId) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("s",$productId);
        echo $stmt -> execute();


        if ($conn->error_list) {
          if ($conn -> error_list[0] ["sqlstate"] == "23000"){
            throw new PDOException("Cannot delete the product. It is associated with one or more orders.");
          }
          throw new PDOException(json_encode($conn->error_list));
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }
    function deleteCustomer($customerId) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("DELETE FROM customer WHERE c_id = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("s",$customerId);
        echo $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }
    function deleteOrder($orderId) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("DELETE FROM `order` WHERE id = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("s",$orderId);
        echo $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }

    function markAsComplete($orderId) {        
        $conn = $this -> getConnection();
        $stmt = $conn->prepare("UPDATE `order` SET order_status = 1 WHERE id = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $stmt->bind_param("s",$orderId);
        echo $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        //close to sql
        $stmt -> close();
        $conn -> close();
    }

    function getProducts($searchQuery = null) {
        // Create connection
        $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM product";
        if($searchQuery != null){
         $sql = $sql." Where product.id = ? or  product.product_name like ?";   
        }
        $stmt = $conn->prepare($sql);

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }
        if($searchQuery != null){
        $wildCard = '%'.$searchQuery.'%';
        $stmt->bind_param("ss",$searchQuery,$wildCard);
        }

        $stmt -> execute();

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $result = $stmt->get_result();

        $products = array();
        if ($result -> num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $product = new Product();
                $product -> id = $row["id"];
                $product -> name = $row["product_name"];
                $product -> quantity = $row["quantity"];
                $product -> unitPrice = $row["unit_price"];

                $products[] = $product;
            }
        }
        $conn->close();

        return $products;
    }
    function getCustomers($searchQuery = null) {
        // Create connection
        $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM customer";
        if($searchQuery != null){
         $sql = $sql." Where customer.c_id = ? or  customer.customer_name like ?";   
        }
        $stmt = $conn->prepare($sql);

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }
        if($searchQuery != null){
        $wildCard = '%'.$searchQuery.'%';
        $stmt->bind_param("ss",$searchQuery,$wildCard);
        }

        $stmt -> execute();

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $result = $stmt->get_result();

        $customers = array();
        if ($result -> num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $customer = new Customer();
                $customer -> id = $row["c_id"];
                $customer -> customerName = $row["customer_name"];
                $customer -> phone = $row["phone"];
                $customer -> address = $row["address"];
                $customer -> email = $row["email"];

                $customers[] = $customer;
            }
        }
        $conn->close();

        return $customers;
    }
    function getCustomerOrders($searchQuery = null) {
        // Create connection
        $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `order` JOIN customer ON customer.c_id = order.customer_id";
        if($searchQuery != null){
         $sql = $sql." Where order.id = ? or  customer.customer_name like ? or 
         customer.phone = ? or customer.email = ?";   
        }
        $sql = $sql." order by order.order_date DESC";
        $stmt = $conn->prepare($sql);

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }
        if($searchQuery != null){
        $wildCard = '%'.$searchQuery.'%';
        $stmt->bind_param("ssss",$searchQuery,$wildCard,$searchQuery,$searchQuery);
        }

        $stmt -> execute();

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $result = $stmt->get_result();

        $orders = array();
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $customer = new Customer();
                $customer -> customerName = $row["customer_name"];
                $customer -> phone = $row["phone"];
                $customer -> address = $row["address"];
                $customer -> email = $row["email"];
                $order = new Order();
                $order -> id = $row["id"];
                $order -> quantity = $row["product_quantity"];
                $order -> totalAmount = $row["total_amount"];
                $order -> productId = $row["product_id"];
                $order -> orderStatus = $row["order_status"];
                $order -> customer = $customer;
                $orders[] = $order;
            }
        }
        $conn->close();

        return $orders;
    }
   

    function getCustomer($phoneNumber) {
        // Create connection
        $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

         $stmt = $conn->prepare("SELECT * FROM customer where phone  = ?");

        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }


        $stmt->bind_param("s",$phoneNumber);
        $stmt -> execute();


        if ($conn->error_list) {
            print("Errors occured <br />");
            print_r( $conn -> error_list);
            die();
        }

        $result = $stmt->get_result();
        $customer = null;
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $customer = new Customer();
                $customer -> id = $row["c_id"];
                $customer -> customerName = $row["customer_name"];
                $customer -> phone = $row["phone"];
                $customer -> address = $row["address"];
                $customer -> email = $row["email"];
            }
        }
        $conn->close();

        return $customer;
    }
    function getTopSellingProducts(){

             // Create connection
             $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

             // Check connection
             if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
             }
     
             $sql = "SELECT p.product_name, SUM(o.product_quantity) AS total_quantity FROM `order` o JOIN product p ON o.product_id = p.id where order_status = 1 GROUP BY o.product_id ORDER BY total_quantity DESC LIMIT 5;";
             $stmt = $conn->prepare($sql);
     
             if ($conn->error_list) {
                 print("Errors occured <br />");
                 print_r( $conn -> error_list);
                 die();
             }
     
             $stmt -> execute();
     
             if ($conn->error_list) {
                 print("Errors occured <br />");
                 print_r( $conn -> error_list);
                 die();
             }
     
             $result = $stmt->get_result();
     
             $products = array();
             if ($result -> num_rows > 0) {
             // output data of each row
                 while($row = $result->fetch_assoc()) {
                     $product = new Product();
                     $product -> name = $row["product_name"];
                     $product -> quantity = $row["total_quantity"];
     
                     $products[] = $product;
                 }
             }
             $conn->close();
     
             return $products;

    }

    function getDashboardReport(){

               // Create connection
               $conn = $this -> getConnection() or die('Error connecting to the SQL Server database.');

               // Check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }

               $dashboardResult = new DashboardReport();
       
               $sql = "SELECT COUNT(*) AS D FROM `order` where date(`order`.order_date) = CURRENT_DATE() AND order_status = 1";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $dashboardResult -> dailyOrders = $row["D"];

               $sql = "SELECT COUNT(*) AS W FROM `order` WHERE WEEK(`order`.order_date) = WEEK(NOW()) AND order_status = 1";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $dashboardResult -> weeklyOrders = $row["W"];

               $sql = "SELECT COUNT(*) AS M FROM `order` where MONTH(`order`.order_date) = MONTH(NOW()) AND order_status = 1";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $dashboardResult -> monthlyOrders = $row["M"];

               $sql = "SELECT COUNT(*) AS totalCustomers FROM `customer`";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $dashboardResult -> totalCustomers = $row["totalCustomers"];
               
               
                $conn->close();
       
               return $dashboardResult;

    }
}

$databaseHandler = new DatabaseHandler();
?>