<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>User info</title>
    <style>
        button {
            background-color: #FF3232;
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
    </style>
</head>
<body>
    <div class="imgcontainer">
        <img src="../Login/img/adminLogin.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="username"><b>Username</b></label><br>
        <p name="username"><?php echo $_SESSION['username']?></p><br>

        <label for="type"><b>User type</b></label><br>
        <p name="type"><?php if($_SESSION['admin']){echo "Administrator";}else{echo "Normal";}?></p><br>

        <label for="host"><b>Host connected</b></label><br>
        <p name="host"><?php echo $_SESSION['host']?></p><br>

        <label for="database"><b>Database access</b></label><br>
        <p name="database"><?php echo $_SESSION['database']?></p><br>

        <label for="table"><b>Table access</b></label><br>
        <p name="table"><?php echo $_SESSION['table']?></p><br>

        <?php
        if(array_key_exists('buttonLogout', $_POST)) { 
            session_destroy();
            header("location: ../");
        }
        ?> 

        <form method="post"> 
            <button type="submit" name="buttonLogout">Logout</button>
        </form>
        
    </div>
</body>
</html>