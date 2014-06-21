<!DOCTYPE html>
<html>
	<?php
		require_once("./classes/cakes.php");
		require_once("config.php");
		session_start();
		if($_SESSION['user'] != null) {
			echo "<script>window.location.assign('cake.php');</script>";
		}
	?>
	<head>
		<title>TEXTCAKE</title>
		<link href = "./css/style.css" rel = "stylesheet" type = "text/css" />
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
	</head>
	<body>
		<div id = "wrapper">
			<div id = "navbar">
				<div id = "logo"><img src = "img/logo.png"></div>
				<div id = "links">
					<a href = "#" class = "links">login</a>
					<!-- the dashes are weird but they work :) -->
					-----
					<a href = "./signup.php" class = "links">register</a>
				</div>
				<div id = "contents">
					<div id = "logreg">
						<p class = "welcoming"> login </p>
						<form id = "login" action = "<?php $_SERVER['PHP_SELF']; ?>" method = "POST">
							<label>Username</label>&nbsp;&nbsp;<input type = "text" name = "user" id = "lgnUser">
							<br />
							<label>Password</label>&nbsp;&nbsp;&nbsp;<input type = "password" name = "pass" id = "lgnPass">
							<br />
							<input type = "submit" name = "login" value = "Login">
						</form>
						<?php
							if(isset($_POST['login'])) {
								$username = mysqli_real_escape_string($con, $_POST['user']);
								$password = md5($_POST['pass']);
								if($username != null && $password != null) {
									$query = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$username."' AND `password` = '".$password."'");
									if(mysqli_num_rows($query) != 0) {
										$_SESSION['user'] = $username;
										echo "<script>window.location.assign('cake.php');</script>";
									} else {
										echo "<p class = \"ErrorMessage\">Incorrect username or password please try again</p>";
									}
								} else {
									echo "<p class = \"ErrorMessage\">Please specify a username and password</p>";
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
