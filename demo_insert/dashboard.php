<?php 
include("config.php");

if(@$_SESSION['admin']!=null)
{
	$id=$_SESSION['admin'];
	$qry1="select * from login where id=$id";
	$res1=mysqli_query($con,$qry1);
	$ar1=mysqli_fetch_assoc($res1);
}
else
{
	header("location:index.php");
}

$qry="select * from login";
$res=mysqli_query($con,$qry);

if(@$_GET['id'])
{
	$id=$_GET['id'];
	$qry1="delete from login where id=$id";
	$res1=mysqli_query($con,$qry1);
	unlink($_GET['image']);
   
	if($res1)
	{
		echo "ypur record is deleted";
		header("location:dashboard.php");
	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>dashboard</title>
</head>
<body>
	<?php 
	if(isset($ar1['name'])){ ?>
		 <h1>
		Welcome to <?php echo $ar1['name']; ?>
	</h1>
	<?php }else{ ?>
	
	
	<h1>
		Welcome to Dashboard
	</h1> 
<?php } ?>
	<h2><a href="logout.php">LOG OUT</a></h2>
	<center>
		<form>
			<table border="2" width="500">
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>CONTACT</th>
					<th>IMAGE</th>
					<th>ACTION</th>

				</tr>
				<?php 
					while ($arr=mysqli_fetch_assoc($res)) {?>
						<tr>
							<td><?php echo $arr['id']; ?></td>
							<td><?php echo $arr['name']; ?></td>
							<td><?php echo $arr['contact']; ?></td>
							<td><img src="<?php echo $arr['image'] ?>" width="100"></td>
							<td><?php if($arr['id']!=$_SESSION['admin']) {?>
								<a href="dashboard.php?id=<?php echo $arr['id'];?>&image=<?php echo $arr['image']; ?>">DELETE</a>

								<?php } ?>
								<a href="new_user.php?id=<?php echo $arr['id'];?>&image=<?php echo $arr['image']; ?>">update</a>
							</td>

						</tr>
						
					<?php }
				 ?>
			</table>
		</form>
	</center>

</body>
</html>