<!DOCTYPE html>
<?php include('process.php') ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Security Questions Form</title>
<link rel="stylesheet" href="register.css">
</head>
<body>
<div id="container">
  <form action="sec_que.php" method="POST">
    <div class="container">
      <h1>Security Questions</h1>
      <p>Please fill in this form to secure your account.</p>
      <label for="que1"><b>1. What place were you born in?</b></label>
      <input type="text" placeholder="New York" name="que1" id="que1" required>
      <label for="que2"><b>2. Name of first car you bought on your own? </b></label>
      <input type="text" placeholder="Ex: Honda " name="que2" id="que2" required>
      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
      <button type="submit" class="registerbtn" name="submit">Complete Registration</button>
    </div>
  </form>
</div>
</body>
</html>
