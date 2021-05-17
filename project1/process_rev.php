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
if(isset($_POST['submit'])) {

  $email = $_POST['email'];
  $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    echo "This email adress isn't valid!";
    exit(0);
}
$name = $_POST['name'];
$place = $_POST['place'];
$message = $_POST['message'];

$sql_e = "SELECT * FROM signup WHERE email='$email'";
$res_e = mysqli_query($db, $sql_e);
if (mysqli_num_rows($res_e) > 0) {
  $sql = "INSERT INTO review"."(name, email, place, message)". "VALUES"."('$name', '$email', '$place', '$message')";
  if ($db->query($sql) === TRUE) {
      echo "Review Posted Succesfully";
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
   }
 }
 else{
   echo "Email is not registered for the account";
 }
}
mysqli_close($db);
?>
