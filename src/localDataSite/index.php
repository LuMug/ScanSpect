<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>ScanSpect<?php if($_SESSION['loggedin']){echo " ".$_SESSION['username'];}?></title>
	<style>
		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #333;
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

		li a:hover {
			background-color: #4CAF50;
		}
		#login {
			float: right;
		}
	</style>
</head>
<body>

<ul>
	<li><a class="active" href="">Home</a></li>
	<?php
		if($_SESSION['loggedin']){
	?>
	<li><a href="/Graphs/">Graphs</a></li>
	<?php
		}
	?>
	<?php
		if($_SESSION['admin']){
	?>
	<li><a href="/Administrator/">Data</a></li>
	<?php
		}
	?>
	<li><a href="#about">About</a></li>
	<?php 
		if(!$_SESSION['loggedin']){
	?>
	<li id="login"><a href="/Login/">Login</a></li>
	<?php
		}else{
	?>
	<li id="login"><a href="/User/"><?php if($_SESSION['admin'] == true){echo "Admin ";} echo $_SESSION['username'];?></a>
	<?php 
		}
	?>
</ul>
<?php if($_SESSION['loggedin']){ echo "<h1>Hi ".$_SESSION['username'];} ?>
</body>
</html>
