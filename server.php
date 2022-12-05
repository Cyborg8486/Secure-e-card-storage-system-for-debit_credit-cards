<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$user_id="";



// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'card_management');


if (isset($_POST['submit'])) {
  // receive all input values from the form
  $cardnumber= mysqli_real_escape_string($db, $_POST['cardnumber']);
  $cardholder= mysqli_real_escape_string($db, $_POST['cardholder']);
  $month= mysqli_real_escape_string($db, $_POST['month']);
  $year= mysqli_real_escape_string($db, $_POST['year']);
  $cvv= mysqli_real_escape_string($db, $_POST['cvv']);
  
  $add_card_query="INSERT INTO cards(ID, cardnumber, cardholder, month, year,cvv) VALUES (".$_SESSION['id'].", '$cardnumber','$cardholder','$month','$year','$cvv')";
  mysqli_query($db, $add_card_query);

  header('location: main_page.php');
}

function search_cards()
{
  
  $query = "SELECT cardnumber, cardholder FROM cards WHERE ID=".$_SESSION['id'];
  $results = mysqli_query($GLOBALS["db"], $query);
  
  return $results;
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { 
    array_push($errors, "Username is required"); 
  }
  if (empty($email)) { 
    array_push($errors, "Email is required"); 
  }
  if (empty($password_1)) { 
    array_push($errors, "Password is required"); 
  }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    //encrypt the password before saving in the database
  	$passwordfinal=hash("sha256", $password_1);
  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$passwordfinal')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	header('location: login.php');
  }
}

// ...

// LOGIN USER

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
    
        $password=hash("sha256", $password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);


        //Fetch UserId
        $id=mysqli_query($db, $query);
        $final_id= mysqli_fetch_assoc($id);
        $user_id= $final_id["id"];
        
        if (mysqli_num_rows($results) ==1) {
          $_SESSION['id']= $user_id;
          $_SESSION['username'] = $username;
           
          
          header('location: main_page.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
      
    }
  }
  ?>