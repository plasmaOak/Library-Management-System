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
			<li><a href="manageprofile.php">Manage Profile</a></li>
			<li><a href="managebooks.php">Manage Books</a></li>
                        <br></br>
			</ul>
		
</nav>

<?php // sqltest.php
  require_once '../login/sqllogin.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
  if (isset($_POST['author'])   &&
      isset($_POST['title'])    &&
      isset($_POST['category']) &&
      isset($_POST['year'])     &&
      isset($_POST['isbn']))
  {
    $author   = get_post($conn, 'author');
    $title    = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year     = get_post($conn, 'year');
    $isbn     = get_post($conn, 'isbn');
    $copies   = get_post($conn, 'copies');
    $format   = get_post($conn, 'format');
    $pages    = get_post($conn, 'pages');
    $condition = get_post($conn, 'condition');
    $cover = "<img src='http://covers.openlibrary.org/b/isbn/".$isbn."-M.jpg'/>"
    $query    = "INSERT INTO Book VALUES" .
      "('$isbn', '$title', '$author', '$category', '$format', '$year', '$copies', '$copies', '$pages', '$condition', '$cover')";
    $result   = $conn->query($query);

  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="addbook.php" method="post"><pre>
    Author <input type="text" required name="author">
     Title <input type="text" required name="title">
  Category <input type="text" required name="category">
      Year <input type="text" required name="year">
      ISBN <input type="text"  required name="isbn">
      Copies <input type="text" required name="copies">
      Format <select required name="format">
             <option>Ebook</option>
             <option>Paperback</option>
             <option>Hardcover</option> </select> 
      Pages <input type="text" name="pages"> 
      Book Condition <input type="text" name="condition">
           <input type="submit" value="Add Book">
  </pre></form>
_END;
  
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
