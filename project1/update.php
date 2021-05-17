<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review Page</title>
</head>
<body bgcolor="grey">
	<h2> Enter your email to show up all the reviews posted by your account</h2>
	<form action="update.php" method="POST">
	<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
	<label for="email"><b>Email</b></label>
	<input type="text" placeholder="Ex: hdrinkwater@gmail.com" name="email" id="email" required>
	<?php if (isset($email_error)): ?>
		<span><div class="red"><?php echo $email_error; ?></div></span>
	<?php endif ?>
</div>
<button type="submit" class="registerbtn" name="submit">Submit</button>
</form>


<?php
      $host = 'localhost';
      $user = 'root';
      $pass = 'root';
      $db = 'register';
			if(isset($_POST['submit'])){
			$email = $_POST['email'];

      $db = mysqli_connect($host, $user, $pass, $db);
			$sql = "SELECT id, name, email, place, message FROM review WHERE email = '$email'";
      $res1 = mysqli_query($db, $sql);
      $x=1;
      $swearWords = array("asshole","buttface","asslicker","jerk","fuck","shitty","shit");
      $replacer = array("a**hole","b**tface","a**li***r","j**k","f**k","s****y","s**t");
      if (mysqli_num_rows($res1) > 0) {
				while($row1 = $res1->fetch_assoc()) {
          $message = $row1["message"];
          $filter = str_ireplace($swearWords,$replacer, $message);

					?>
					<table border="2">
					<tr>
        <td><?php echo $x;?></td>
        <td><?php	echo $row1['name'];?></td>
        <td><?php	echo $row1['place'];?></td>
				<td><?php	echo $filter;?></td>
				<td><a href="edit.php?id=<?php echo $row1['id'];?>">Edit</a></td>
				<td><a href="delete.php?id=<?php echo $row1['id']; ?>">Delete</a></td>
			</tr>
		<?php
    $x = $x + 1;
  }
	}
}?>
	</table>
  <p> If Done Editing and Updating your reviews. Click Below to go to your Profile Again.</p>
  <button type="submit" name="back"><a href="viewProfile.php">Back To Profile</a> </button>
</body> 
</html> 
