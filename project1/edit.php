<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'register';

$db = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM review where id='$id'";
$res= mysqli_query($db, $sql);
$row = $res->fetch_assoc();
if(isset($_POST['update']))
{
  $name = $_POST['name'];
  $place = $_POST['place'];
  $msg = $_POST['msg'];

  $sql_e = "UPDATE review SET name='$name', place='$place', message='$msg' WHERE id='$id'";
  $res_e = mysqli_query($db, $sql_e);
  if($res_e)
  {
    mysqli_close($db); // Close connection
        header("location:update.php");
        exit;
      }
  else{
    echo mysqli_error();
  }
}
?>

<h3> UPDATE DATA </h3>
<form method="POST">
  <input type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="Enter Full Name" Required>
  <input type="text" name="place" value="<?php echo $row['place'] ?>" placeholder="Enter Place" Required>
  <input type="text" name="msg" value="<?php echo $row['message'] ?>" placeholder="Enter Review" Required>
  <input type="submit" name="update" value="Update">
</form>
