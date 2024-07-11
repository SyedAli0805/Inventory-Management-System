<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto; /* Center the container horizontally */
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 350px;
            padding: 12px;
            border: none;
            border-bottom: 2px solid #ddd;
            background-color:gainsboro;
            color: #333;
            transition: border-bottom-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-bottom-color: #8bc34a;
        }

        input[type="submit"] {
            width: 350px;
            padding: 12px;
            background-color:royalblue;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #7cb342;
        }

        .login-form {
            text-align: center;
            margin-top: 30px;
        }

        .login-form a {
            color: #555;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }
        .centered-form {
           display: flex;
           flex-direction: column;
           align-items: center;
        }

        .centered-image {
          display: block;
          margin: 0 auto;
        }
        #ABC{
            color:darkgreen;
            text-align: center;
        }
        .rounded-input {
          border-radius: 20px;
        }
        .hover-link {
           text-decoration: none;
           color:#8bc34a
        }

        .hover-link:hover {
          font-weight: bold;
        text-decoration: none;
       }
    </style>
</head>
<body>
    <div class="container">
    <img src="./img/logo.PNG" alt="IMS" height="220px" width="250px" class="centered-image">
        <h2 style="color:royalblue">Welcome To IMS</h2>
        <p id='ABC'>Login To IMS</p>
        <form action="connect.php" method="POST" class="centered-form">
            <input type="hidden" name="request_type" value="login">
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error-message'>Invalid Username or Password</p>";
            }
            ?>
            <label for="username" style="text-align: left;"><b>Username:</b></label>
            <input type="text" class="rounded-input" name="username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>" required><br>

            <label for="password" style="text-align: left"><b>Password:</b></label>
            <input type="password" class="rounded-input" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
        <p class="login-form">Don't have an account? <a href="./register.php" class="hover-link">Register As Admin</a></p>
    </div>
</body>
</html>
