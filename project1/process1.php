<?php
session_start();
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
  $username = $_POST['uname'];
  $password = $_POST['psw'];

  $sql_u = "SELECT * FROM signup WHERE username='$username'and password='$password'";

  $res_u = mysqli_query($db, $sql_u);


  if (mysqli_num_rows($res_u) == 0) {
    $name_error = "Sorry... wrong email or password";
  } else{
    $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: viewProfile.php
      ');

    // ***********************************************************************************************/
     ?>
    <script>
    alert ("I am here");
      function session(){
      document.getElementById("signup").innerHTML = "Welcome "<?php $username  ?>;
      document.getElementById("login").innerHTML = "Logout";
      }
    </script>
     <?php
     //************************************************************************************************* */

    //echo " Login Successfull";
   }
  }


  mysqli_close($db);
?>
