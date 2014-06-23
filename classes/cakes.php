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
	public function retrieveCake($MySQL, $cakeID) {
		if($MySQL) {
			if($cakeID != NULL) {
				$q = mysqli_query($MySQL, "SELECT * FROM `cakes` WHERE `ID` = '".$cakeID."'");
				if($q != false) {
					if(mysqli_num_rows($q) != 0) {
						while($row = mysqli_fetch_assoc($q)) {
							$result = "".$row['Name']."|".$row['contents']."|".$row['CakeDate']."|".$row['userID']."|".$row['syntax']."";
							return $result;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>
