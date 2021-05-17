<?php
if (isset($_POST['filename'])) {
$removeSpaces = str_replace(" ", "", $_POST['filename']);
$allFileNames = explode(",", $removeSpaces);
$countAllNames = count($allFileNames);
for ($i=0; $i < $countAllNames; $i++) { 
	if (file_exists("img_uploads/".$allFileNames[$i])== false) {
		header("Location: deletefile.php?deleteerror");
		exit();
	}
}
 for ($i=0; $i < $countAllNames; $i++) { 
 	# code...
 	$path = "img_uploads/".$allFileNames[$i];
 	 if (!unlink($path)) {
		echo "You have an error!";
		exit;
	}
	
 }

header("Location: deleteimg.php?deletesuccess");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action = "" method = 'POST'>
		<input type="text" name="filename" placeholder="Seperate each name with a comma (,)" style = "width: 300px">
		<button type = 'submit' name = 'submit'> Delete File </button>
	</form>
</body>
</html>




