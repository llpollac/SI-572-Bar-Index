<?php

session_start();
if ( isset($_POST['logout']) ) {
		unset($_SESSION['login']);
		unset($_SESSION['id']);
		header( 'Location: home.php' ) ;
   		return;
}

if (isset($_POST['like']) && isset($_SESSION['login'])){
	$post_id=$_POST['post_id'];
	$s_id=$_SESSION['id'];
	$sql4="SELECT user_id FROM votes WHERE user_id='$s_id' AND post_id='$post_id'";
	$result2=mysql_query($sql4);
	$result3=mysql_fetch_assoc($result2);
	if ($result3==FALSE){
		$sql3="INSERT INTO votes (id ,post_id ,user_id ,up_down) VALUES (NULL , '$post_id'  ,  '$s_id',  0)";
		mysql_query($sql3);
		$sql1="SELECT up FROM content WHERE id='$post_id'";
		$result=mysql_query($sql1);
		$row=mysql_fetch_row($result);
		$curr_up=$row[0];
		$new_up=$curr_up+1;
		$sql2= "UPDATE  content SET  up='$new_up' WHERE  id ='$post_id'";
		mysql_query($sql2);
	}
	else{
		echo('<script type="text/javascript"> 
		alert("You already voted on this POTD"); 
		</script>');
	
	}
}

elseif(isset($_POST['like'])){
	echo('<script type="text/javascript"> 
		alert("You must be logged in to record your opinion."); 
		</script>');
}



if (isset($_POST['dislike'])&& isset($_SESSION['login'])){
	$post_id=$_POST['post_id'];
	$s_id=$_SESSION['id'];
	$sql4="SELECT user_id FROM votes WHERE user_id='$s_id' AND post_id='$post_id'";
	$result2=mysql_query($sql4);
	$result3=mysql_fetch_assoc($result2);
	if($result3==FALSE){
		$sql3="INSERT INTO votes (id ,post_id ,user_id ,up_down) VALUES (NULL , '$post_id'  ,  '$s_id',  1)";
		mysql_query($sql3);
		$sql1="SELECT down FROM content WHERE id='$post_id'";
		$result=mysql_query($sql1);
		$row=mysql_fetch_row($result);
		$curr_down=$row[0];
		$new_down=$curr_down+1;
		$sql2= "UPDATE  content SET  down='$new_down' WHERE  id ='$post_id'";
		mysql_query($sql2);
	}
	else{
		echo('<script type="text/javascript"> 
		alert("You already voted on this POTD")	</script>');
	
	}
	
}
elseif(isset($_POST['dislike'])){
	echo('<script type="text/javascript"> 
		alert("You must be logged in to record your opinion."); 
		</script>');
}

if (isset($_POST['favorite'])&& isset($_SESSION['login'])){
	$post_id=$_POST['post_id'];
	$sql4="INSERT INTO favorites (post_id, user_id) VALUES('$post_id', ".$_SESSION['id'].")";
	mysql_query($sql4);
}
elseif (isset($_POST['favorite'])){
	echo('<script type="text/javascript"> 
		alert("You must be logged in to add to favorites."); 
		</script>');
}

?>