<?php 
    $route = include('./../Configuration/config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        input[type=text], input[type=password] {
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 15%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
            text-align: center;
        }

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
    </style>

</head>
<body>
<ul>
    <li><a class="active" href="<?php echo $route?>">Home</a></li>
    <li><a href="<?php echo $route?>About/">About</a></li>
</ul>
<center><h2>Login</h2></center>

<form action="<?php echo $route?>Login/checkLogin.php" method="post">
  <div class="imgcontainer">
    <img src="<?php echo $route?>/Login/img/adminLogin.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="username"><b>Username</b></label><br>
    <input type="text" placeholder="Enter Username" name="username" required><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
        
    <button type="submit">Login</button>
  </div>
</form>

</body>
</html>
