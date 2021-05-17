<!DOCTYPE html>
<?php include('process1.php') ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
<link rel="stylesheet" href="register.css">
</head>
<body>
<div id="container">
  <form action="login.php" method="POST">
    <div class="container">
      <h1>Login your account</h1>
      <p>Please fill in this form to login to your account.</p>
      <hr>
      <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >

      <label for="uname"><b>User Name</b></label>
      <input type="text" placeholder="Hannah11" name="uname" id="uname" required>
      <?php if (isset($name_error)): ?>
	  	 <span><?php echo $name_error; ?></span>
	    <?php endif ?>
     </div>


      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" required>


      <button type="submit" class="loginbtn" name="submit" onclick="session()">Login</button>
    </div>

    <div class="container signin">
     <form action="forgot.php">
     <a href="register.php">Don't Have An Account?</a>
     <button type="submit" name="forgot"> Forgot Password?</button>
    </div>
  </form>
</form>
</div>
</body>
</html>
