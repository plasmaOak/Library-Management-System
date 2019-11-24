<!DOCTYPE html> 

<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>

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
                        <br>
			</ul>
		
</nav>

<?php // sqltest.php
  require_once 'sqllogin.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['type'])   &&
      isset($_POST['id'])    &&
      isset($_POST['email']) &&
	  isset($_POST['department']) &&
	  isset($_POST['name']) &&
      isset($_POST['password'])     &&
      isset($_POST['confirm_password']))
  {
    $type   = get_post($conn, 'type');
    $id    = parseInt(get_post($conn, 'id'));
    $email = get_post($conn, 'email');
    $department = get_post($conn, 'department');
    $name     = get_post($conn, 'name');
	$password = get_post($conn, 'password');
	$confirm_password = get_post($conn, 'confirm_password');
	if($password == $confirm_password){
		$hashed = password_hash($password, PASSWORD_DEFAULT);
		$query    = "INSERT INTO User (ID, Usertype, Name, Email, Department, Password) VALUES" .
			"('$id', '$type', '$name', '$email', '$department', '$hashed')";
		$result   = $conn->query($query);
	}

  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  
  <h2> Create Account </h2>
        <p class="formp">Please fill this form to create an account.</p>
        <form action="createaccount.php" method="post">
            <div>     
                 <label>User Type</label>
                 <br>
                 <input type="radio" name="type" value="student" id="student">
                 <label for="student"> User </label>
                 <input type="radio" name="type" value="teacher" id="teacher">
                 <label for="teacher"> Owner</label>
            </div>
			<div>
                 Name <input type="text" required name="name">
			</div>
            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>  		
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
            <p>Already have an account? <a href="../main/login.html">Login here</a>.</p>
        </form>
_END;
  
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>

<footer> © 2019 WonderToast. All rights reserved.  </h3>
 
</footer>
</div>

</body>
</html>
