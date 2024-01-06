<?php 
include("config.php");
if(@$_SESSION['admin']!=null){
	header("location:dashboard.php");
}


if(isset($_POST['submit']))
{
	$user=$_POST['username'];
	$pass=$_POST['password'];

	$qry="select * from login where username='$user' and password='$pass'";
	$res=mysqli_query($con,$qry);
	$cnt=mysqli_num_rows($res);

	if($cnt==1)
	{
			$ar=mysqli_fetch_assoc($res);
			$id=$ar['id'];
		$_SESSION['admin']=$id;
		header("location:dashboard.php");
	}
	else
	{
		echo "invalid username and pass";
	}
 
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>index
	</title>
</head>
<body>
	<center>
		<form method="post">
			<table border="2" width="500">
				<tr><th colspan="2"><h1 style="font-family:Cooper;">LOGIN PAGE</h1></th></tr>
				<tr><td>Enter Username</td><td ><input type="text" name ="username"></td></tr>
				<tr><td>Enter Password</td><td><input type="text" name="password"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" name="submit"></td></tr>

			</table>
		</form>
				<h1><a href="new_user.php" style="font-family:Cooper; color: black;"  > New Admin</a><h1>

	</center>

</body>
</html>