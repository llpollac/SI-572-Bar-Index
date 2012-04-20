<head>
   <title>Create an Account</title>
   <link type="text/css" rel="stylesheet" href="potd.css">
 </head>
 <body>
 	<div id="header">
      <h1><a href="home.php" accesskey="1">Point of the Day</a></h1>
      <ul>
       <li><a href="popular.php?id='3'" >Popular</a></li>
        <li><a href="Funny.php?id='1'">Funny</a></li>
        <li><a href="Inspirational.php?id='2'" >Inspirational</a></li>
      </ul>
    </div>
 <?php
 
 require_once "db.php";
 session_start();
 if (isset($_POST['username']) && isset($_POST['pass1']) && isset($_POST['pass2'])){
 $username = mysql_real_escape_string($_POST['username']);
 $pass1 = mysql_real_escape_string($_POST['pass1']);
 $pass2 = mysql_real_escape_string($_POST['pass2']);
 
 if ($pass1 === $pass2){
 $sql = "INSERT INTO users (name, password) VALUES ('$username', '$pass1')";
 mysql_query($sql);
 $_SESSION['success'] = 'Thank you for registering';
header( 'Location: home.php');
return;
 }
 else{
 echo "Your password does not match.  Please enter it again.";
 }
 }
 
 
?>
<div class="wrapper">
  	<div id="container">
  		<div id="content">
<h1> Create an Account</h1>
<form method="post" >
Username <input type="text" name="username"></input><br />
Password: <input type="password" name="pass1"></input><br />
Verify Password <input type="password" name ="pass2"></input><br />
<input type="submit" value="submit" />
</div></div></div>
