<!DOCTYPE html>
<html>
	<?php
		require_once("./classes/cakes.php");
		require_once("config.php");
		session_start();
		if($_SESSION['user'] == null || $_COOKIE['user'] != null) {
			echo "<script>window.location.assign('index.php');</script>";
		}
		$obj = new cake();
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
					<a href = "#" class = "links">Home</a>
					<!-- the dashes are weird but they work :) -->
					-----
					<a href = "./myaccount.php">My Account</a>
				</div>
				<div id = "contents">
					<?php
					$query = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['user']."'");
					while($row = mysqli_fetch_assoc($query)) {
					?>
						<div id = "NewCake">
							<?php
								$CakeInfo = $obj->retrieveCake($con, $_GET['cake']);
								$Paste = explode("|", $CakeInfo);
							?>
							<p class = "nck"></p>
							<label><strong><?php echo $Paste[0]; ?></strong></label>
							<br />
							<label>Posted at: <strong><?php echo $Paste[2]; ?></strong></label>
							<br />
							<?php
							$getByLine = mysqli_query($con, "SELECT `Username` From `Users` WHERE `ID` = '".$Paste[3]."'");
							$by = null;
							while($row = mysqli_fetch_assoc($getByLine)) {
								$by = $row['Username'];
							}
							?>
							<label>By: <strong><?php echo $by; ?></strong></label><br />
							<div id = "textInCake">
								<p class = "paragraphInCake"><?php echo "<code>".htmlspecialchars(stripslashes($Paste[1]))."</code>"; ?></p>
							</div>
							<br />
							<label>Syntax: <strong><?php echo $Paste[4]; ?></strong></label>
							<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
