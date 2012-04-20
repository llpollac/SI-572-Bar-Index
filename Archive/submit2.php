<?php   
require_once "db.php";
session_start();

require_once 'header.php';
 
 
if (isset($_POST['submit'])){
 	if($_FILES['Photo']['name']!=''){
 		$uploadDir = 'uploads/';
 		$fileName = $_FILES['Photo']['name'];
		$tmpName  = $_FILES['Photo']['tmp_name'];
		$fileSize = $_FILES['Photo']['size'];
		$fileType = $_FILES['Photo']['type'];
		$filePath = 'uploads/'.$fileName;
		$result = move_uploaded_file($tmpName, $filePath);
		if (!$result) {
			echo "Error uploading file";
				exit;
		}
		if(!get_magic_quotes_gpc()){
    		$fileName = addslashes($fileName);
			$filePath = addslashes($filePath);
		}
		$query = "INSERT INTO images ( Image ) VALUES ('$filePath')";
		mysql_query($query) or die('Error, query failed'); 
	}		
	$story = mysql_real_escape_string($_POST['story']);
 	$category = mysql_real_escape_string($_POST['category']);

	if ($category === "Happy"){
 		$cat_id = 1;
 	}
 	elseif($category === "Funny"){
 		$cat_id = 2;
 	}
 	elseif($category === "Inspirational"){
 		$cat_id = 3;
 	}
 		elseif($category === "Random"){
 		$cat_id = 4;
 	}
 	$s_id=$_SESSION['id'];
 	if(isset($_SESSION['login'])){
		$sql = "INSERT INTO content (body, cat_id, user_id, up, down) VALUES ('$story', '$cat_id', '$s_id', 0, 0)";
		mysql_query($sql);
		header( 'Location: home.php' ) ;
		return;
	}
	else{
		$sql = "INSERT INTO content (body, cat_id, user_id, up, down) VALUES ('$story', '$cat_id', 0, 0, 0)";
		mysql_query($sql);
		header( 'Location: home.php' ) ;
		return;
	}
	
} 
 
?>
<div class="wrapper">
  		<div id="container">
  		<div id="content">
<h1> Submit Your Own Point of the Day</h1>
<form name="Image" enctype="multipart/form-data"  method="POST" >
Your story: <textarea rows="5" cols="30" name="story">Your Story Here</textarea><br />
Category: <select name="category">
<option name="happy">Happy</option>
<option name="funny">Funny</option>
<option name="inspirational">Inspirational</option>
<option name="random">Random</option>
</select>
<h1> Add an Image <h1>
<input type="file" name="Photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/>
<input type="submit" value="submit" name='submit' />
</form>
</div>
</div>
</div>
