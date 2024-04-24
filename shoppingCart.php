<?php
session_start();
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'products');


#Array of product details is made for every item to be added in cart
if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="shoppingCart.php"</script>';
            }
            else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="shoppingCart.php"</script>';
            }
        
        }
        else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    
}
#Items are removed from the cart after action
    
    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("The product has been removed from the cart!")</script>';
                    echo '<script>window.location="shoppingCart.php"</script>';
                }
            }
        }
    }
  


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Clothing Store | Ecommerce Website</title>
    
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <!-- <script src = "store.js"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </head>

</head>
<body>
<section id="title">
    <div class="container">
       <div class="navbar">
           
        <div class="logo">
          <img src="images/BrandImage2.png" width="45px">
         </div>
          <nav>
             <ul id="MenuItems">
                 <li><a href="shoppingCart.php">Home</a></li>
                   <li>
                    <a href="Accessories.html">Accessories</a>
                  </li> 
                  <li>
                    <a href="clothing.html">Women Wear</a>
                  </li> 
                    <li><a href="about.html">About us</a></li>
                       <li><a href = 'logout.php'>logout<a></li>
     
             </ul>
           </nav>
           <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
         </div>
         <div class="row">
           <div class="col-1">
             
           <img class="landingPageimg" src="images/logoDesign.png"  width="100%">
            
           </div>
           
         </div>
      </div>
    </section>
 <div class = "container" style = "width:65%">
     <br>
  <h2 class="featureTitle">Women-Wear</h2>

 <?php
#All the products are displayed from the database
            $query = "SELECT * FROM `tbl_product` order by id ASC";
            $queryfire = mysqli_query($con,$query);
            if(mysqli_num_rows($queryfire)>0){
                while($row = mysqli_fetch_array($queryfire)){
                    ?>
                    <div class = "col-md-3">
                        <br>
                    <form method = "post" action = "shoppingCart.php?action=add&id=<?php echo $row["id"]; ?>">
                    <div class="product">
                                <img src="<?php echo $row["image"]; ?>" class="img-responsive" style = 'width:100px height:40px'>
                                <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                                <h5 class="text-danger"> $<?php echo $row["price"]; ?></h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Add to Cart">
                            </div>
                        </form>
                </div>
                <?php
                }
            }
            ?>

        <div></div>
        <h3 class="title2" class = "cart">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>

            <?php
            #Items added to the  cart by the user
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>$ <?php echo $value["product_price"]; ?></td>
                            <td>$ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="shoppingCart.php?action=delete&id=<?php echo $value["product_id"]; ?>">
                                    <button class = "btn-danger ">Remove Item</button></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" style = 'align="right"'>Total</td>
                            <th class= "total" style = 'align="right"'>$ <?php echo number_format($total, 2); ?></th>
                            <td></td>
                        </tr>
                        
                        <?php
                    }
                ?>
            </table>
        </div>
        
            <?php
            #Details of the user are asked and stored in the database
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $paymode = $_POST['paymode'];

            if(!empty($_SESSION['cart'])){
                if(isset($_POST['Purchase'])){

                $query1 = "INSERT INTO `order_manager`(`Full_name`, `Phone_Number`, `Address`, `Pay_Mode`) VALUES ('$fullname','$phone','$address','$paymode')";
                $result = mysqli_query($con,$query1);

                #The values of cart are stored in the database
                if($result){
                    $order_id = mysqli_insert_id($con);
                    $query2  = "INSERT INTO `user_orders`(`order_id`, `item_name`, `item_quantity`, `item_price`) VALUES (?,?,?,?)";
                    $stmt = mysqli_prepare($con,$query2);
                    if($stmt)
                    {
                        mysqli_stmt_bind_param($stmt,'isii',$order_id,$item_name,$item_quantity,$item_price);
                        foreach($_SESSION['cart'] as $keys => $values)
                        {
                            $item_name = $values['item_name'];
                            $item_price = $values['product_price'];
                            $item_quantity = $values['item_quantity'];
                            mysqli_stmt_execute($stmt);

                        }
                        unset($_SESSION['cart']);
                        echo '<script>alert("Your bill has been generated!")</script>';
                       echo '<script>window.location="shoppingCart.php"</script>';
                    }

                }
        
                }
            }
        
                ?>
           
      
        <h1>CUSTOMER DETAILS</h1>
        <div class = "container">
         <form method = "POST" action = "shoppingCart.php">
            <div class = "form-group">
            <input type = "text"  class = "form-control" name = "fullname"  placeholder = "Full Name" required>
            </div>
            <br>
            <div class = "form-group">
            <input type = "text" class = "form-control" name = "phone"  placeholder = "Phone Number" required>
            </div>
            <br>
            <div class = "form-group">
            <input type = "text" class = "form-control" name = "address" placeholder = "Address" required>
            </div>
            <br>
            <div class = "form-group">
            <input class = "form-check-input" type = "radio" value = "COD" name = "paymode" placeholder = "Pay Mode" required>
            <label class = "form-check-label">
               Cash On Delivery
            </label>
            </div>
            <input type = "submit" name = "Purchase" class = "btn btn-primary" value = "Purchase">
        
            </form>
        </div>
    </div>
    
<!---Offer-->
<h2 class="featureTitle">What's New?</h2>
<div class="offer">
  
  <div class="container">
    
    <div class="row">
      <div class="col-2">
      
<img src="images/cosmetic.png" class="offer-img" width="400">
      </div>
      <div class="col-2">
       <img src="images/Available2.png" width="300">



      </div>
    </div>
  </div>
</div>
<!--Testimonial-->
<div class="testimonial">
  <div class="container">
    <h2 class="featureTitle">Reviews</h2>
    <div class="row">
      <div class="col-3">
        <i class="fas fa-quote-left" style="font-size: 34px;color: #ff66c4;"></i>
        
        
        <p>Lorem Ipsum is simply dummy text of the printing and
           typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when 
            an unknown printer took a galley of type and scrambled
             it to make a type specimen book. It has survived not only
           five centuries, but also the leap into electronic</p>
           <div class="rating"><i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="far fa-star" style="color: #ff66c4;"></i>
            <i class="far fa-star" style="color: #ff66c4;"></i>
           
          </div>
          <img src="images/user-1.png" alt="">
          <h3>Sara Jain</h3>
      </div>
      <div class="col-3">
        <i class="fas fa-quote-left" style="font-size: 34px;color: #ff66c4;"></i>
        
        
        <p>Lorem Ipsum is simply dummy text of the printing and
           typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when 
            an unknown printer took a galley of type and scrambled
             it to make a type specimen book. It has survived not only
           five centuries, but also the leap into electronic</p>
           <div class="rating"><i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
           
          </div>
          <img src="images/user-2.png" alt="">
          <h3>Anmol Akthar</h3>
      </div>
      <div class="col-3">
        <i class="fas fa-quote-left" style="font-size: 34px;color: #ff66c4;"></i>
        
        
        <p>Lorem Ipsum is simply dummy text of the printing and
           typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when 
            an unknown printer took a galley of type and scrambled
             it to make a type specimen book. It has survived not only
           five centuries, but also the leap into electronic</p>
           <div class="rating"><i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="fas fa-star" style="color: #ff66c4;"></i>
            <i class="far fa-star" style="color: #ff66c4;"></i>
            
          </div>
          <img src="images/user-3.png" alt="">
          <h3>Nirmala Desai</h3>
      </div>
    </div>
  </div>
</div>
<!---Brands-->
<div class="brands">
  <div class="container">
    <div class="row">
      <div class="col-5">
        <img src="images/logo-godrej.png">
      </div>

      <div class="col-5">
        <img src="images/logo-coca-cola.png">
      </div>

      <div class="col-5">
        <img src="images/logo-oppo.png">
      </div>

      <div class="col-5">
        <img src="images/logo-paypal.png" >
      </div>

      <div class="col-5">
        <img src="images/logo-philips.png" >
      </div>
    </div>
  </div>
</div>
<!---Footer-->
<section id="Contact">
<div class="footer">

<div class="row">
  <div class="footer-col-1">
    <h3>Download our app</h3>
   
    <div class="app-logo">
      <img src="images/play-store.png" alt="">
      <img src="images/app-store.png" alt="">
    </div>
  </div>

  <div class="footer-col-2">
    <img src="images/brandImage2.png" alt="">
   
  </div>

  <div class="footer-col-3">
    <h3>Useful Links</h3>
    <ul>
      <li>Coupons</li>
      <li>Blog Post</li>
      <li>Return Policy</li>
      <li>Join Affiliate</li>
    </ul>
  </div>

  <div class="footer-col-4">
    <h3>Follow Us</h3>
    <ul>
      <li>Facebook</li>
      <li>Twitter</li>
      <li>Instagram</li>
      <li>Youtube</li>
    </ul>
  </div>
</div>
  <hr>
 
</div>
</section>
    <script src="script.js" async defer></script>
  </body>
</html>
  

        </body>
        </html>
        