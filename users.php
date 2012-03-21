<?php
require_once('connect.php');
require_once('util.php');

head();	

$findUsers = "SELECT * FROM user ORDER BY firstname";
$result = mysql_query($findUsers) or die(mysql_error());
	
if (loginAdmin() == 1 && isset($_POST['userId'])){
	$sql="UPDATE user SET admin='1' WHERE id='".mysql_real_escape_string($_POST['userId'])."';";
	mysql_query($sql) or die(mysql_error());
	header('Location: users.php');
}
	
echo"<br />";
echo"<table>";
	echo '<tr>
			<td><b>Fornavn:</b></td>
			<td><b>Efternavn:</b></td>
			<td><b>Email:</b></td>
			<td><b>Admin:</b></td>';
			if(loginAdmin()){
				echo'<td><b>Gør til admin</b></td>';
			}
	echo'</tr>';
	while($row=mysql_fetch_array($result)){
		echo '<tr>
			<td>'.$row["firstname"].'</td>
			<td>'.$row["lastname"].'</td>
			<td>'.$row["email"].'</td>';
			if($row["admin"] == 1){
				echo'<td>ja</td>';
			} else{
				echo'<td>nej</td>';
			}
			if(loginAdmin()){
				?>
				<td>
				<?php
				if($row['admin'] != 1) {
				?>
					<form action="users.php" method="post">
						<input type="hidden" name="userId" value="<?php echo $row['id']; ?>"/>
						<input type="submit" value="Gør til admin"/>
					</form>
				<? } ?>
				</td>
				<?php
			}	
		echo'</tr>';
	}
echo"</table>";
foot();
?>
