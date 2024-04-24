<?php

include 'connect.php';

session_start();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
	$password =$_POST['password'];

    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $query = mysqli_query($conn,$sql);

    if ($query->num_rows > 0) {
		$row = mysqli_fetch_assoc($query);
		$_SESSION['username'] = $row['username'];
		header("Location: admin.html");

        }
    else {
        echo  "<script>alert('Sorry you are not an admin!')</script>";
    };
}


?>









<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="login.css"> 
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="css/styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 
        <title>Admin Login Form<Form></Form></title>
    </head>
    <style>
        body{background-color:#fff;
        padding:20px}
        
    </style>
    <body>
      
        <div class="container"style="position: auto; background-color: #ff66c4; width: 750px;padding:40px">
        <div class="left">
            <h1 style="text-align:center">
            <span id="login" style="color:#fff; padding:30px">Admin Login</span>
        </h1>
            <hr>
        <form action="" method="POST" class="admin-email">
            <div class="form-floating">
            <input class="form-control" class="input-group" style="width: 400px;" type="email" placeholder="Email"  name="email" value = "<?php echo $email;?>" required>
            <label for="floatingSelectGrid">Email</label>
            </div>
            <br>
            <div class="form-floating">
            <input  class="form-control" class="input-group" style="width: 400px;" type="password" placeholder="Password" name="password" value = "<?php echo $_POST['password'];?>" required>
            <label for="floatingSelectGrid">password</label>
            </div>
            <br>
            <div class = "input-group">
            <button name="submit" class="btn btn-light btn-lg btn btn-outline-dark">Login</button>
            </div>
        </form>
            </div>
            <div class="right">
                <hr>
                <!-- <p class="login-register-text">Don't have an account? 
                <a class="btn btn-primary btn-lg" href="register.php">Create Account</a></p> -->
            </div>
        </div>
    </body>
</html>