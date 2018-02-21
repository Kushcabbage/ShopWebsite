<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Book page</title>
  <style>
  @import url("sitewide.css");
	div.basic{
		border:solid;
		background-color:#B575A5;
		padding:20px;
		display:block;
		margin:50px 100px;
		
	}
  
  body {
	  margin:0;
	background-color:#703C63;
  
  }

ul {
    list-style-type: none;
    margin: 0;
    padding: 15;
	padding-right:13;
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;
	align-self:center;
	
}

li {
   float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #BCBCBC;
}

.active {
    background-color: #703C63;
}
  
 .itemimg{
	 height:100%;
	
	 padding-right: 20px;
	 
 }
 .main_img{
	 
	 height:300px;
 }
  
  </style>
  
</head>
<body>



<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="Books.php">Books</a></li>
  <li><a href="cds.php">CDs</a></li>
  <li><a href="games.php">Games</a></li>
  <li><a href="dvds.php">DvDs</a></li>
  <li style="#float:right;"><a href="login.php">Login</a></li>
</ul>




<?php


	
	
	
	

	

$item_code = $_GET[ 'item' ];


# Connect to a database and access a table

$dbname = 'ah17451'; # Change to your username
$dbuser = 'ah17451';
$dbpass = 'obscure';
$dbhost = 'localhost';

$link = mysqli_connect( $dbhost, $dbuser, $dbpass )
or die( "Unable to Connect to '$dbhost'" );

mysqli_select_db( $link, $dbname )
or die("Could not open the db '$dbname'");

$test_query = "select * from inventory where item_code='$item_code'";
$result = mysqli_query( $link, $test_query );

while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) )
{
	$name = $row['item_name'];
	$author = $row['item_author'];
	$desc = $row['item_description'];
	$imgurl = 'img/'.$row['item_image_loc'];
	$price = $row['item_price'];
	
	$buyurl= "item.php?item=". $item_code;
}

mysqli_free_result( $result );
mysqli_close( $link );
?>

<div class="basic" style="margin-top:50px;text-align:center;">


<p><?php

	session_start(); 
	
	if ($_SESSION[ 'User' ]!=''){
		
		echo "<p >loggined in</p>";
		echo $_SESSION['User'];
		
		
		
		
	}


 echo $item_code; ?></p>
<h1 class="title"><?php echo $name?> </h1>
<p><img class="main_img" src="<?php echo $imgurl?>"></p>
<p><?php echo $author?> </p>
<br>
<p><?php echo $desc?> </p>


<h3 align-self="right" class="title" > 

<?php echo "<a href=Buy.php?item=$item_code>Buy for £";
echo $price ;
echo "</a>";
 ?>
 </h3>




</div>



</body>
</html>
