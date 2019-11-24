<!DOCTYPE html> 

<html>
<head>
<title>WonderToast</title>
<link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="../../css/style.css" rel="stylesheet">
<link href="../../css/responsive_solution.css" rel="stylesheet" media="screen and (max-width: 960px)"> 
</head>

<body>

<div class="wrapper">

<header><h1>WonderToast</h1></header>
<nav>
			<ul>
                        <br></br>
			</ul>
		
</nav>

<h2> Owner Login </h2>

<p class="formp">Please fill in your credentials to login.</p>
        <form action="adminlogin.php" method="post">
            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
            <p>Don't have an account? <a href="createaccount.php">Sign up now</a>.</p>
        </form>

<?php // sqltest.php
  require_once 'sqllogin.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['email'])   &&
      isset($_POST['password']))
  {
    $email   = get_post($conn, 'email');
    $password    = get_post($conn, 'password');
    
    $query  = "SELECT Email, Password FROM User WHERE Email LIKE $email AND Password LIKE $password AND Usertype LIKE Admin";
    $result = $conn->query($query);
    header("location: ../admin/managebooks.php");
  }
  
  $result->close();
  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>


<footer><h3> © 2019 WonderToast. All rights reserved.  </h3>
 
</footer>
</div>

</body>
</html>
