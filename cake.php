<!DOCTYPE html>
<html>
	<?php
		error_reporting(0);
		require_once("./classes/cakes.php");
		require_once("config.php");
		session_start();
		if($_SESSION['user'] == null || $_COOKIE['user'] != null) {
			echo "<script>window.location.assign('index.php');</script>";
		}
	?>
	<head>
		<title>TEXTCAKE</title>
		<link href = "./css/style.css" rel = "stylesheet" type = "text/css" />
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
		<script>
		/* credits to http://sumtips.com/ */
		function insertTab(o, e)
		{		
			var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;
			if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey)
			{
				var oS = o.scrollTop;
				if (o.setSelectionRange)
				{
					var sS = o.selectionStart;	
					var sE = o.selectionEnd;
					o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
					o.setSelectionRange(sS + 1, sS + 1);
					o.focus();
				}
				else if (o.createTextRange)
				{
					document.selection.createRange().text = "\t";
					e.returnValue = false;
				}
				o.scrollTop = oS;
				if (e.preventDefault)
				{
					e.preventDefault();
				}
				return false;
			}
			return true;
		}
		</script>
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
					-----
					<a href = "?action=logout">Log Out</a>
				</div>
				<div id = "contents">
					<?php
					if($_GET['action'] == "logout")
					{
						unset($_SESSION['user']);
						echo "<script>window.location.assign('index.php');</script>";
					}
					$query = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['user']."'");
					while($row = mysqli_fetch_assoc($query)) {
					?>
						<div id = "NewCake">
							<p class = "nck">New Cake</p>
							<form id = "newPaste" action = "<?php $_SERVER['PHP_SELF'] ?>" method = "POST">
								<label>Cake Name</label><input type = "text" name = "cakename" id = "paste">
								<br />
								<textarea rows = "25" cols = "100" name = "cake" id = "cakeText" onkeydown = "insertTab(this, event);"></textarea>
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
									$id = $row['ID'];
								}
								$nameNotAllowed = @explode("<?php", $cakeName);
								$contentNotAllowed = @explode("<?php", $cakeName);
								$syntaxNotAllowed = @explode("<?php", $syntax);
								echo var_dump($nameNotAllowed);
								if($nameNotAllowed[0] == "" || $contentNotAllowed == "" || $syntaxNotAllowed[0] == "" ) {
									echo "<script>alert('Please type your syntax without <?php');</script>";
								}
								$create = $obj->newCake($con, $cakeName, $cakeContent, $id, $syntax);
								if($create)
								{
									$CID = mysqli_insert_id($con);
									echo "<script>window.location.assign('view.php?cake=".$CID."');</script>";
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
