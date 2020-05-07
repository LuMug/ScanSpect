<?php 
	session_start(); 
	$route = include('./../Configuration/config.php');
    $username = $password = "";

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	#Informazioni per la connessione.
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$database = "ScanSpect";
	$table = "people";
	$host = "localhost";
	#Connessione al Database.
	$mysqli = new mysqli($host, $username, $password, $database);
	$_SESSION['loggedin'] = false;
	if(!$mysqli->connect_errno){
		$sql = "SHOW GRANTS FOR '$username'@'$host'";
		if ($result = $mysqli->query($sql)) {
			$count = 1;
			$_SESSION['admin'] = true;
			while ($row = $result->fetch_assoc()) {
				if($count == 1 && $row["Grants for $username@$host"] != 'GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, RELOAD, SHUTDOWN, PROCESS, FILE, REFERENCES, INDEX, ALTER, SHOW DATABASES, SUPER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, REPLICATION SLAVE, REPLICATION CLIENT, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, CREATE USER, EVENT, TRIGGER, CREATE TABLESPACE, CREATE ROLE, DROP ROLE ON *.* TO `'.$username.'`@`'.$host.'` WITH GRANT OPTION'){
					$_SESSION['admin'] = false;
					break;
				}elseif($count == 2 && $row["Grants for $username@$host"] != 'GRANT APPLICATION_PASSWORD_ADMIN,AUDIT_ADMIN,BACKUP_ADMIN,BINLOG_ADMIN,BINLOG_ENCRYPTION_ADMIN,CLONE_ADMIN,CONNECTION_ADMIN,ENCRYPTION_KEY_ADMIN,GROUP_REPLICATION_ADMIN,INNODB_REDO_LOG_ARCHIVE,PERSIST_RO_VARIABLES_ADMIN,REPLICATION_APPLIER,REPLICATION_SLAVE_ADMIN,RESOURCE_GROUP_ADMIN,RESOURCE_GROUP_USER,ROLE_ADMIN,SERVICE_CONNECTION_ADMIN,SESSION_VARIABLES_ADMIN,SET_USER_ID,SHOW_ROUTINE,SYSTEM_USER,SYSTEM_VARIABLES_ADMIN,TABLE_ENCRYPTION_ADMIN,XA_RECOVER_ADMIN ON *.* TO `'.$username.'`@`'.$host.'` WITH GRANT OPTION'){
					$_SESSION['admin'] = false;
					echo $row["Grants for $username@$host"];
					echo "<br>";
					echo 'GRANT APPLICATION_PASSWORD_ADMIN,AUDIT_ADMIN,BACKUP_ADMIN,BINLOG_ADMIN,BINLOG_ENCRYPTION_ADMIN,CLONE_ADMIN,CONNECTION_ADMIN,ENCRYPTION_KEY_ADMIN,GROUP_REPLICATION_ADMIN,INNODB_REDO_LOG_ARCHIVE,PERSIST_RO_VARIABLES_ADMIN,REPLICATION_APPLIER,REPLICATION_SLAVE_ADMIN,RESOURCE_GROUP_ADMIN,RESOURCE_GROUP_USER,ROLE_ADMIN,SERVICE_CONNECTION_ADMIN,SESSION_VARIABLES_ADMIN,SET_USER_ID,SYSTEM_USER,SYSTEM_VARIABLES_ADMIN,TABLE_ENCRYPTION_ADMIN,XA_RECOVER_ADMIN ON *.* TO `'.$username.'`@`'.$host.'` WITH GRANT OPTION';
					break;
				}
				$count++;
			}
		}
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['database'] = $database;
		$_SESSION['table'] = $table;
		$_SESSION['host'] = $host;
        header("location: ".$route);
    }else{
?>
<!DOCTYPE html>
	<head>
		<style>
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

			.container {
				padding: 16px;
				text-align: center;
        	}
		</style>
	</head>
	<body>
	<form action="<?php echo $route?>Login/" method="post">
		<div class="container">
			<p><b>Login failed!</b><br><br>Check your username or password</p>
			<button type="submit">Back</button>
		</div>
	</form>
	</body>
<?php
	}
?>