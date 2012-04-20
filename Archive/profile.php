<?php

session_start();
require_once "db.php";
require_once "actions.php";
require_once "header.php";


$user_name=$_SESSION['login'];    
echo('<div class="wrapper">
	<div id="breadcrumb">
    				<ul>
    				<h1>'.$user_name.'s Points of the Day </h1>
     			<li><a href="fav.php">Favorites</a></li>
      			<li>&#187;</li>
      			<li><a href="like.php">Likes</a></li>
     			<li>&#187;</li>
     			<li><a href="sub.php">Submitted</a></li>
    		</ul>
  		</div>
  		<div id="container">
  		<div id="content">
	<div id="comments">
    <ul class="commentlist">');
$user_id=$_SESSION['id'];      		
$result1 = mysql_query("SELECT  post_id FROM favorites WHERE user_id=$user_id");
while ( $row1 = mysql_fetch_row($result1) ) {
	$result = mysql_query("SELECT  body, cat_id, up, down, id, user_id, time_stamp FROM content WHERE id=".$row1[0]."");
	while($row=mysql_fetch_row($result)){
		$body=htmlentities($row[0]);
		$cat_tag=htmlentities($row[1]);
		$up_vote=htmlentities($row[2]);
		$down_vote=htmlentities($row[3]);
		$id=htmlentities($row[4]);
		$user_id=htmlentities($row[5]);
		if ($user_id==0){
			$user="Anonymous";
		}
		else{
			$result1=mysql_query("SELECT  name FROM users WHERE id=$user_id");
			$row1=mysql_fetch_row($result1);
			$user=htmlentities($row1[0]);
		}
		
		$time_stamp=htmlentities($row[6]);
		echo('
         	 <li class="comment_odd">
            	<p>'.$body.'</p>
            	<div class="author"><span class="wrote">Posted by:</span><span class="name"><a href="#">'.$user.'</a></span></div>
            <div class="submitdate"><a href="#">'.$time_stamp.'</a></div>
            <form method="post"> 
            	<input type="submit" value="Like" name="like">
            	<p>Like = '.$up_vote.'</p>
    			<input type="submit" value="Dislike" name="dislike" >
    			<p>Like = '.$down_vote.'</p>
				<input type="hidden" value="' . htmlentities($row[4]) .'" name="post_id">
   				 ');
         echo(' </li>');
	}
}
echo(' </ul>');
echo('<h1>Points of the Day that '.$user_name.' Likes</h1>
        		<ul class="commentlist">');
$user_id1=$_SESSION['id'];  
     		
$result2 = mysql_query("SELECT  post_id FROM votes WHERE user_id=$user_id1 AND up_down=0");
while ( $row3 = mysql_fetch_row($result2) ) {
	$result4 = mysql_query("SELECT  body, cat_id, up, down, id, user_id, time_stamp FROM content WHERE id=".$row3[0]."");
	while($row4=mysql_fetch_row($result4)){
		$body=htmlentities($row4[0]);
		$cat_tag=htmlentities($row4[1]);
		$up_vote=htmlentities($row4[2]);
		$down_vote=htmlentities($row4[3]);
		$id=htmlentities($row4[4]);
		$user_id=htmlentities($row4[5]);
		if ($user_id==0){
			$user="Anonymous";
		}
		else{
			$result6=mysql_query("SELECT  name FROM users WHERE id=$user_id");
			$row6=mysql_fetch_row($result6);
			$user=htmlentities($row6[0]);
		}
		
		$time_stamp=htmlentities($row4[6]);
		echo('
         	 <li class="comment_odd">
            	<p>'.$body.'</p>
            	<div class="author"><span class="wrote">Posted by:</span><span class="name"><a href="#">'.$user.'</a></span></div>
            <div class="submitdate"><a href="#">'.$time_stamp.'</a></div>
            <form method="post"> 
            	<input type="submit" value="Like" name="like">
            	<p>Like = '.$up_vote.'</p>
    			<input type="submit" value="Dislike" name="dislike" >
    			<p>Like = '.$down_vote.'</p>
				<input type="hidden" value="' . htmlentities($row4[4]) .'" name="post_id">
   				 ');
   				if (isset($_SESSION['login'])){
   					echo('<input type="submit" value="Add to Favorites" name="favorite"></form>');
            	}
                //This is the URL you want to shorten (Code using the Google shortened url api adapted from tutorial at http://www.vijayjoshi.org/2011/01/12/php-shorten-urls-using-google-url-shortener-api/)
$myUrl = "http://si572barindex.projects.si.umich.edu/Archive/s_post.php?p_id=".$id;

$longUrl = $myUrl;

$apiKey = 'AIzaSyBqderxgJmtSSZF-Cahj8jaFO8D1JreNRU';
//Get API key from : http://code.google.com/apis/console/
 
$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
$jsonData = json_encode($postData);
 
$curlObj = curl_init();
 
curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlObj, CURLOPT_HEADER, 0);
curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
curl_setopt($curlObj, CURLOPT_POST, 1);
curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
 
$response = curl_exec($curlObj);
 
//change the response json string to object
$json = json_decode($response);
 
curl_close($curlObj);
$tweeturl = $json->id;
 
                echo("    <a href='https://twitter.com/share' class='twitter-share-button' data-lang='en' data-url='$tweeturl' data-text='$body' data-hashtags='POTD' data-count='none'>Tweet</a>

    <script> 
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>");
         echo(' </li>');
	}
}
echo(' </ul></div></div>');


require_once "subnav.php";

		

?>
 </body>