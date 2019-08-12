<!DOCTYPE html> 

<html>
<head>
<title>Oak University Library</title>
<link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="../../css/style.css" rel="stylesheet">
<link href="../../css/responsive_solution.css" rel="stylesheet" media="screen and (max-width: 960px)"> 
</head>

<body>

<div class="wrapper">

<header><h1>Oak University Library</h1></header>
<nav>
			<ul>
			<li><a href="login.html">Login</a></li>
			<li><a href="browse.php">Browse</a></li>
			<li><a href="about.html">About Us</a></li>
			<button type="submit">Submit</button>
			<input type="search" placeholder="Search..">
                        <br></br>
			</ul>
		
</nav>

<?php // sqltest.php
  require_once '../login/sqllogin.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query  = "SELECT * FROM Book";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
    $row[10]
    <div id='info'>
    Author $row[2]
     Title $row[1]
  Category $row[3]
      Year $row[5]
      ISBN $row[0]
     </div>
  </pre>
_END;
  }
  
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>

<footer><h3>Hours of Operation: <br></br> Monday: <br></br> Tuesday: <br></br> Wednesday
 				<br></br> Thursday: <br></br> Friday: <br></br> </h3>
 
</footer>
</div>

</body>
</html>
