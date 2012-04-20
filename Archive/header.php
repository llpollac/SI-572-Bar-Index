<?php 

echo('
<head>
<title>Point of the Day</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
</head>
<body id="top">
<div class="wrapper">
  <div id="header">
    <div id="logo">
      <h1><a href="home.php">P-O-T-D</a></h1>
      <p>Point of the Day</p>
    </div>
    <div id="topnav">
      <ul>
    	<li><a href="home.php" >Home</a></li>
    	<li><a href="about.php">About P-O-T-D</a></li>
        <li><a href="submit.php">Submit a P-O-T-D</a></li>');
        if (isset($_SESSION['login'])) {
     		echo("<li> <a href=fav.php>".$_SESSION['login']."</a></li>");
     		echo('<li><form method="post"><input type="submit" name="logout" value="Logout"></form></li>');
     	}
     	else{
     		echo('<li><a href="login.php" >Login/Sign Up</a></li>');
    
		}
echo('     	
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>');