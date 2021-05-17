<!DOCTYPE html>
<?php include('process.php') ?>
<!-- <?php include('pswValidator.php') ?> -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="register.css">
  <style>
    /* Style the submit button */
    input[type=submit] {
      background-color: #4CAF50;
      color: white;
    }

    /* The message box is shown when the user clicks on the password field */
    #message,
    #message2 {
      display: none;
      background: #f1f1f1;
      color: #000;
      position: relative;
      padding: 20px;
      margin-top: 10px;
    }

    #message,
    #message2 p {
      padding: 10px 35px;
      font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
      color: green;
    }

    .valid:before {
      position: relative;
      left: -35px;
      content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
      color: red;
    }

    .invalid:before {
      position: relative;
      left: -35px;
      content: "✖";
    }
  </style>
</head>

<body>
  <div id="container">
    <form action="register.php" method="POST">
      <div class="container">
        <h1>Create an Account</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <div <?php if (isset($name_error)) : ?> class="form_error" <?php endif ?>>

          <label for="uname"><b>User Name</b></label>
          <input type="text" placeholder="Hannah11" name="uname" id="uname" required>
          <?php if (isset($name_error)) : ?>
            <span><?php echo $name_error; ?></span>
          <?php endif ?>
        </div>

        <div <?php if (isset($email_error)) : ?> class="form_error" <?php endif ?>>
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Ex: hdrinkwater@gmail.com" name="email" id="email" required>
          <?php if (isset($email_error)) : ?>
            <span>
              <div class="red"><?php echo $email_error; ?></div>
            </span>
          <?php endif ?>
        </div>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <div id="message">
          <h3>Password must contain:</h3>
          <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
          <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
          <p id="number" class="invalid">A <b>number</b></p>
          <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
        <label for="psw-repeat"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="psw-repeat" id="psw-repeat" required>
        <div id="message2">
          <h3>Retype password matching?</h3>
          <p id="match" class="invalid"><b>Yes/No</b></p>

        </div>
        <hr>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn" name="submit" id="registration" style="display:none">Register</button>
      </div>

      <div class="container signin">
        <p>Already have an account? <a href="Login.php">Sign in</a>.</p>
      </div>
    </form>
  </div>
  <script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    var myInput2 = document.getElementById("psw-repeat");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
    }

    // MINE
    myInput2.onfocus = function() {
      document.getElementById("message2").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput2.onblur = function() {
      document.getElementById("message2").style.display = "none";
    }
    // MINE

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
      } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
      }

      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
      } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
      } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
      }

      // Validate length
      if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }

    }
    myInput2.onkeyup = function() {
      // Validate retype password missmatch
      if (document.getElementById("psw").value !== document.getElementById("psw-repeat").value) {
        match.classList.remove("valid");
        match.classList.add("invalid");

      } else {
        match.classList.remove("invalid");
        match.classList.add("valid");
        document.getElementById("registration").style.display = "block";
      }
    }
  </script>
</body>

</html>