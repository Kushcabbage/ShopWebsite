<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Login page</title>
  <style>
  @import url("sitewide.css");
	div.login{
		border:solid;
		background-color:#B575A5;
		padding:20px;
		display:block;
		margin:0px 500px;
		height:20%;
		#display: inline-block
	}
.loginform{
	
	align:left;
}
  
  
  </style>
  
  <script>
function validateForm() {
    var user = document.forms["loginform"]["User"].value;
    
	if (isNaN(user)) {
        alert("User name must be a number");
        return false;
		
		
    }
	else{
		
		return true;
	}
}
</script>
  
</head>
<body>



<?php include ( "destroy_session.php"); ?>

<?php include ( "menu.php"); 
	$item =  $_GET['item'];
	include ( "sidemenu.php")
?>

<div class="title"></div>

<div style="padding:70px;text-align:center;">

	<h1 class="title">MANAGER LOGIN</h1>

   
</div>



<div class="login" style="text-align:center;float:center;text-align:center;">
<div style="center;">
	
	
	
	<form name="loginform" onsubmit="return validateForm()">
	<h1 >User</h1>
	<br>
	<input class="loginform" type="text" name="User" value="" required>
	<br>
	<h1 >Pass</h1>
	<input class="loginform" type="text" name="Pass" value="" required>
	<br>
	<input type="hidden" name="item" value="<?php echo $item;?>">
	 <input type="submit" value="Log on" style="margin-top:10px;">
    
	</form>
	
</div>


<?php



$item =  $_GET['item'];
#echo $item;


if ( isset( $_GET[ 'User' ] ) && isset( $_GET[ 'Pass' ] ) )
{
 $User = $_GET[ 'User' ];
 #echo $User;
 $Pass = $_GET[ 'Pass' ];
 $dbname = 'ah17451'; # Change to your username
 $dbuser = 'ah17451';
 $dbpass = 'obscure';
 $dbhost = 'localhost';
 $link = mysqli_connect( $dbhost, $dbuser, $dbpass )
 or die( "Unable to Connect to '$dbhost'" );
 mysqli_select_db( $link, $dbname )
 or die("Could not open the db '$dbname'");

 $Pass_query = "select * from customer where customer_number = '" .
 $User . "' and passwd = MD5( '" . $Pass . "' )";
 $result = mysqli_query( $link, $Pass_query );
 
if ( mysqli_num_rows( $result ) == 1 ) # Number of result rows
 {
	echo "success";
	
	$row_cnt = mysqli_fetch_array($result);
	$name = $row_cnt['firstname'];
	
 session_start();
 $_SESSION[ 'User' ] = $User;
 $_SESSION['item'] = $item;
 $_SESSION['name'] = $name;
 
 if ($item==''){
	
	header( 'Location: index.php' );
 
 }
 
 else{
	 
	 
	header( 'Location: buy.php?item='.$item );
 }
 
 
 exit();
 }
 else
 {


 
 $Pass_query = "select * from manager where manager_number = '" . $User . "' and passwd = MD5( '" . $Pass . "' )";
 $result = mysqli_query( $link, $Pass_query );
 
if ( mysqli_num_rows( $result ) == 1 ) # Number of result rows
 {
	echo "success as manager!!!";
	session_start();
	$_SESSION[ 'User' ] = $User;
	$_SESSION['name'] = "Manager";
	header( 'Location: index.php' );
 }
 
 else{
	 
	  echo '<p>Login failed. Please try again.</p>', "\n";
	 
 }
 
 
 
 
 
 }
}
?> 


</div>

<div class="title">

<img src="frogo.gif">
</div>





</body>
</html>
