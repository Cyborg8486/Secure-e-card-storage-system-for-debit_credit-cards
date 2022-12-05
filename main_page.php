<?php 
require_once("server.php");

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="main_page.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            
        </head>
        <body>
        <div class="header">
</div>
<div class="content">
            <!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
                  <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      
    	<h2 class="text-center">YOUR CARDS</h2>
            <hr>
            <div class="container d-flex flex-wrap align-items-center" id="main_card">

            <?php 
            $cards=search_cards();
            while ($card = mysqli_fetch_array($cards)){
              echo '<div class="m-4 card">
              <div class="card-body">
              <h8>Card Number:' .$card["cardnumber"].'</h8>
              <br>
              <h8>Card Holder Name:' .$card["cardholder"].'</h8>
              <p class="card-text"></p>
              <a href="#" class="btn btn-primary">Select Card</a>
            </div>
            </div>';
            }

          
            ?>

                </div>
                <div class="text-center">
                    <a href="Add_card.php" class="addcard-btn" role="button">ADD CARD</a>
                  </div>
                  <div class="text-center"><br><br>
                    <a href="main_page.php?logout=1" class="btn btn-danger" role="button">Log Out</a>
                  </div>
    	
    <?php endif ?>
            
        </body>
        
    </html>