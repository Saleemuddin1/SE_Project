<html>
<head>
<title> Review For this page </title>
</head>
<body>
  <?php
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'register';
  $db = mysqli_connect($host, $user, $pass, $db);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
  $sql = "SELECT name, place, message FROM review";
  $res = mysqli_query($db, $sql);
  if (mysqli_num_rows($res) > 0) {
    while($row = $res->fetch_assoc()) {
      echo "Name: " .$row["name"].", "."Place Name: ".$row["place"].", "."Review: ".$row["message"]."<br>";
    }
  }else{
    echo "No reviews Yet";
  }
  mysqli_close($db);
?>

</body>
</html>
