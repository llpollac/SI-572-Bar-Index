<?php   
require_once "db.php";
session_start();

require_once "header.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
    if($_POST['password']!=$_POST['password1']){
    	echo('<script type="text/javascript"> 
		alert("Passwords do not match."); 
		</script>');
	}
    else{	
    	$username = mysql_real_escape_string($_POST['username']);
 		$password = mysql_real_escape_string(sha1($_POST['password']));
 		$email=mysql_real_escape_string(($_POST['email']));
 		$sql1="SELECT name FROM users WHERE name='$username'";
 		$result2=mysql_query($sql1);
		$result3=mysql_fetch_assoc($result2);
 		if ($result3==FALSE){
 			$sql="INSERT INTO  users (id, name, pword, Email) VALUES (NULL ,  '$username',  '$password',  '$email')";
			mysql_query($sql);
			$sql2 = "SELECT pword, id, name FROM users WHERE name='$username'";
 			$result = mysql_query($sql2);
 			$row = mysql_fetch_row($result);
 			$_SESSION['id'] = $row[1];
			$_SESSION['login'] = $row[2];
    		header( 'Location: home.php' ) ;
   			return;
		}
		else{
			echo('<script type="text/javascript"> 
			alert("Im Sorry this username is already taken."); 
			</script>');
		}
	}
}
echo('
<div class="wrapper">
  	<div id="container">
  		<div id="content">

<h1> Become a Member</h1>
<form method="post" >
Email: <input type="text" name="email"></input><br/>
Username: <input type="text" name="username"></input><br/>
Password: <input type="password" name="password"></input><br/>
Re-type Password: <input type="password" name="password1"></input>
<input type="submit" value="submit" />
</div></div></div>');

require_once "subnav.php";

?>