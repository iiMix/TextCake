<!DOCTYPE html>
<html>
	<?php
		require_once("./classes/cakes.php");
		require_once("config.php");
		session_start();
		if($_SESSION['user'] == null) {
			echo "<script>window.location.assign('index.php');</script>";
		}
	?>
	<head>
		<title>TEXTCAKE</title>
		<link href = "./css/style.css" rel = "stylesheet" type = "text/css" />
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
		<?php
		?>
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
					while($row = mysqli_fetch_assoc($query)) {
					?>
						<div id = "sidebar">
							<?php echo "<p class = \"\">Welcome, ".$row['username']."</p>" ?>
							<img src = "<?php $row['Picture'] ?>">
						</div>
						<div id = "NewCake">
							<p class = "nck">New Cake</p>
							<form id = "newPaste" action = "<?php $_SERVER['PHP_SELF'] ?>" method = "POST">
								<label>Cake Name</label><input type = "text" name = "cakename" id = "paste">
								<br />
								<textarea rows = "25" cols = "100" name = "cake"></textarea>
								<br />
								<label>Syntax</label>
								<select name = "lang">
									<option>None</option>
									<option>php</option>
									<option>C#</option>
									<option>C++</option>
									<option>C</option>
									<option>Objective C</option>
									<option>Actionscript 3</option>
									<option>Actionscript 2</option>
									<option>Perl</option>
									<option>Pascal</option>
									<option>Python</option>
									<option>Haskal</option>
									<option>Java</option>
								</select>
								<br />
								<input type = "submit" name = "Submit">
							</form>
							<?php
							if(isset($_POST['Submit'])) {
								$obj = new cake();
								$cakeName = mysqli_real_escape_string($con, $_POST['cakename']);
								$cakeContent = mysqli_real_escape_string($con, $_POST['cake']);
								/* Extra escaping won't hurt */
								$syntax = mysqli_real_escape_string($con, $_POST['lang']);
								if($cakeName != null && $cakeContent != null && $syntax != null) {
									$query = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['user']."'");
									$id = null;
											$id = $row['ID'];
								}
								$create = $obj->newCake($con, $cakeName, $cakeContent, $id, $syntax);
								if($create)
								{
									echo "<script>windows.location.assign('cake.php');</script>";
								} else {
									echo "<script>alert('Error creating cake!');</script>";
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
