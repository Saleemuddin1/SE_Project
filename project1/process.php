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
if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

  if (
    filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
  ) {
    echo "This email adress isn't valid!";
    exit(0);
  }
  if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw'];
  }

  $sql_u = "SELECT * FROM signup WHERE username='$username'";
  $sql_e = "SELECT * FROM signup WHERE email='$email'";
  $res_u = mysqli_query($db, $sql_u);
  $res_e = mysqli_query($db, $sql_e);

  if (mysqli_num_rows($res_u) > 0) {
    $name_error = "Sorry... username already taken";
  } else if (mysqli_num_rows($res_e) > 0) {
    $email_error = "Sorry... email already taken";
  } else {
    $sql = "INSERT INTO signup" . "(email, username, password) " . "VALUES" . "('$email','$username','$password')";
    // $sql = "INSERT INTO `signup`(`email`, `username`, `password`) VALUES ($email, $un, $pw)";
    if ($db->query($sql) === TRUE) {
      echo '<script>alert("New Record Created Successfully")</script>';
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
    }
  }
}

mysqli_close($db);
