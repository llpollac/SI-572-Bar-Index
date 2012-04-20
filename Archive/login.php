<?php   
session_start();
require_once "db.php";


require_once "header.php";


if (isset($_POST['username']) && isset($_POST['password'])){
 	$username = mysql_real_escape_string($_POST['username']);
 	$password = mysql_real_escape_string($_POST['password']);
	
 
 	$sql = "SELECT pword, id FROM users WHERE name='$username'";
 	$result = mysql_query($sql);
 	$row = mysql_fetch_row($result);
 	if ($result===false){
 		echo("not in DB");
 	}
 	elseif($_POST['password']=='' || $_POST['username']==''){
 		echo("<div class='wrapper'><div id='container'><div id='content'><h1>Incorrect User Name or Password</h1></div></div></div>");
 	}

 	elseif (sha1($_POST['password'])==$row[0]){
 		$_SESSION['login'] = $_POST['username'];
    	$_SESSION['id'] = $row[1];
    	header( 'Location: home.php' ) ;
   		return;
   	}
 
 	else{
 		echo("<div class='wrapper'><div id='container'><div id='content'><h1>Incorrect User Name or Password</h1></div></div></div>");
 	}
 }
 
echo('
<div class="wrapper">
  	<div id="container">
  		<div id="content">
<h1> Login</h1>
<form method="post" >
Username: <input type="text" name="username"></input><br/>
Password: <input type="password" name="password"></input>
<input type="submit" value="submit" />
<a href="newuser.php">New User</a>
</div></div></div>');

require_once "subnav.php";
?>