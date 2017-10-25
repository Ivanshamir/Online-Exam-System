<?php 
	include '../classes/admin.php';
	include 'inc/loginheader.php';
	$admin = new Admin();
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$adminData = $admin->getAdminData($_POST);
	}
?>
<div class="main">
<h1>Admin Login</h1>
<div class="adminlogin">
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="adminuser" required="" /></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="adminpass" required="" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php 
						if (isset($adminData)) {
							echo $adminData;
						}
					?>
				</td>
			</tr>
		</table>
	</from>
</div>
</div>
<?php include 'inc/footer.php'; ?>