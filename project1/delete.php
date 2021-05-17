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
$id = $_GET['id'];

$sql = "DELETE FROM review WHERE id='$id'";

if (mysqli_query($db, $sql)) {
  header("location: update.php");
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($db);
?>
