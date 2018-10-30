<!DOCTYPE html>
<!-- Mark Gould, Eagle ID: 900835664, 9-23-15, Assignment 3, WPD 11:00AM -->
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" media="print" href="printer.css" />
<link rel="stylesheet" media="screen" href="rest_styles.css">
<script src="rest_script.js"></script>
<style>

@font-face {
font-family: "futura";
src: url("./fonts/Futura Bold font.ttf");

}
		.hide {display: none;}
		</style>
<meta charset="utf-8">
<title>Login Page</title>
</head>
<body>

<header>
<img class="logo" src="./images/Logo.png" alt="Eagle Cast">
</header>
<?php
if (isset($_REQUEST['attempt']))
{
	$config['db']=array(
		'host'=>'localhost',
		'username'=>'root',
		'password'=>'student', 
		'dbname'=>'cookie'
		);
	$db = new PDO ('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'],
	$config['db']['username'],$config['db']['password']);
	$user=$_POST['user'];
	$password=($_POST['password']);
	$stm=$db->query("SELECT user
		FROM users
		WHERE user='$user'
		AND password='$password'");
	if ($stm->rowCount())
	{
		if(isset($_POST['checkbox']))
			{
			setcookie("user",$user,time()+3600);
			}
		session_start();
		$_SESSION['user'] = 'blah';
		header('location: index.html');
	}
	else
	{
		echo '<span style="color:white; display: block; font-size: 20px; text-align: center; font-family:futura;  ">Incorrect username/password </span>';
		displayForm();
	}

}
else
{
	displayForm();
}
function displayForm()
{
	$user="";
	if(isset($_COOKIE['user'])){
		$user=$_COOKIE['user'];
	}
	else
	{
	$user="";
	}





?>
<form method="post" action="login.php?attempt">
	<label for="user">Username</label><input type="text" name="user" value="<?php echo $user;?>" /><br>
	<label for="password">Password</label><input type="password" name="password" /> <br/>
	<input type="submit" /><br/>
	 <label for="remeber">Remember me</label><input type="checkbox" name="checkbox" ><br>
</form>
<?php } ?>
</body>
