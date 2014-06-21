<?php
class cake
{
	public function newCake($MySQL_Connection, $PasteName, $Contents, $userID, $Syntax) {
		if($MySQL_Connection) {
			if($PasteName != NULL && $Contents != NULL && strlen($PasteName) >= 3 && strlen($PasteName) <= 50) {
				$q = mysqli_query($MySQL_Connection, "INSERT INTO `Cakes` (`Name`, `contents`, `CakeDate`, `userID`, `syntax`) VALUES('".mysqli_real_escape_string($MySQL_Connection, $PasteName)."', '".mysqli_real_escape_string($MySQL_Connection, $Contents)."', '".date("Y-m-d")."', '".$userID."', '".mysqli_real_escape_string($MySQL_Connection, $Syntax)."')");
				if($q != false)
				{
					return true;
				} else {
					return false;
				}
			}
		}
	}
}
?>
