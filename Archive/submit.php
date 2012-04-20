<?php   
require_once "db.php";
session_start();

require_once 'header.php';
 
 if (isset($_POST['story']) && isset($_POST['category'])){
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
<p><form method="post" >
Your story: <textarea rows="5" cols="30" name="story">Your Story Here</textarea><br />
Category: <select name="category">
<option name="happy">Happy</option>
<option name="funny">Funny</option>
<option name="inspirational">Inspirational</option>
<option name="random">Random</option>
</select>
<input type="submit" value="submit" /></p>
<h1> Add an Image <h1>
<input type="file" name="Photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/>
</form>
</div>
</div>
</div>
