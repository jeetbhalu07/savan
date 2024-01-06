<?php 

include("config.php");
if(isset($_GET['id'])){
 		$id=$_GET['id'];
 		$qry2="select * from login where id=$id";
 		$res2=mysqli_query($con,$qry2);
 		$user_data=mysqli_fetch_assoc($res2);
}
if(@$_POST['submit'])
{
	$name=$_POST['name'];
	$contact=$_POST['contact'];
	$username=$_POST['username'];
	$password=$_POST['password'];

	$image_name=rand(100,10000).$_FILES['image']['name'];
	$path=$_FILES['image']['tmp_name'];

	move_uploaded_file($path, "images/$image_name");

	$qry1="select * from login where username='$username' and password='$password'";
		$res1=mysqli_query($con,$qry1);
		$cnt=mysqli_num_rows($res1);

	if(@$_GET['id'])
	{
		echo $user_data['image'];
		$id=$_GET['id'];
		if($_FILES['image']['name']=="")
		{
			$image_name=$user_data['image'];
		}
		else
		{
				unlink($user_data['image']);
				move_uploaded_file($path, "images/$image_name");

			
		}
		// $id=$_GET['id'];

		$sql_update="update login set name='$name',contact='$contact',username='$username',password='$password',image='images/$image_name' where id=$id";
		$res=mysqli_query($con,$sql_update);
		header("location:dashboard.php");
	}
	else{
		if($cnt==0){

	$qry="insert into login values(null,'$name','$contact','$username','$password','images/$image_name')";
	$res=mysqli_query($con,$qry);
	if($res)
	{
		echo "inserted";
		header("location:index.php");
	}
	else{
		echo "Not inserted";
	}
}
else{
	echo "$username is already exist";
}

}


}
if(isset($_GET['id'])){
 		$id=$_GET['id'];
 		$qry2="select * from login where id=$id";
 		$res2=mysqli_query($con,$qry2);
 		$user_data=mysqli_fetch_assoc($res2);
 	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>new user</title>
</head>
<body>

		<center>
		<form method="post" enctype="multipart/form-data">
			<table border="2" width="500">
				<tr><th colspan="2"><h1 style="font-family:Cooper;">Add Admin</h1></th></tr>
				<tr><td>Enter Name</td><td ><input type="text" name="name" value="<?php echo @$user_data['name']; ?>"></td></tr>
				<tr><td>Enter Contact</td><td><input type="text" name="contact" value="<?php echo @$user_data['contact']; ?>"></td></tr>
				<tr><td>Enter Username</td><td><input type="text" name="username" value="<?php echo @$user_data['username']; ?>"></td></tr>
				<tr><td>Enter Password</td><td><input type="text" name="password"value="<?php echo @$user_data['password']; ?>"></td></tr>
				<tr><td>Enter Image</td><td><input type="file" name="image"><img src="<?php echo @$user_data['image']; ?>"width="100"></td></tr>


				<tr><td colspan="2" align="center"><input type="submit" name="submit"></td></tr>

			</table>
		</form>
				<!-- <h1><a href="new_user.php" style="font-family:Cooper; color: black;"  > New Admin</a><h1> -->

	</center>
</body>
</html>