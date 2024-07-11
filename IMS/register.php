<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<style>
.container {
    max-width: 350px;
    margin: 0 auto; /* Center the container horizontally */
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
.panel-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
h4 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
</style>
<body>
<div class="container">
<img src="./img/logo.PNG" alt="IMS" height="220px" width="250px" class="centered-image">
<h4 style="color:navy">Registration Form</h4>
<div class="panel-body">
<form action="connect.php" method="post" class="centered-form">
<input type="hidden" name="request_type" value="add_admin" />
<div class="form-group">
<label for="name">Name</label>
<input
type="text"
class="form-control"
id="name"
name="name"
required
/>
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input
    type="text"
    class="form-control"
    id="email"
    name="email"
    required
  />
</div>
<div class="form-group">
<label for="text">Phone Number</label>
<input
type="text"
class="form-control"
id="phone"
name="phone"
required
/>
</div>
<div class="form-group">
<label for="address">Address</label>
<input
type="text"
class="form-control"
id="address"
name="address"
required
/>
<div class="form-group">
<label for="username">Username</label>
<input
type="text"
class="form-control"
id="username"
name="username"
required
/>
</div>
<div class="form-group">
<label for="password">Password</label>

<input
type="password"
class="form-control"
id="password"
name="password"
required
/>
</div>
</div>
<input type="submit" class="btn btn-primary" />
</form>
</div>
</body>
</html>