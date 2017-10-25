<?php
 include 'inc/header.php';
 Session::checkSession();
 include 'classes/user.php';
 $usr = new User();
 $userid = Session::get("userid");
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$updtdata = $usr->userUpdateData($userid, $_POST);
	}
?>
<style>
.tbl {border: 1px solid #ddd;margin: 0 auto;padding: 30px 53px 50px;width: 627px;}
</style>
<div class="main">
<h1>Welcome to user profile</h1>

	<form action="" method="post">


		<table class="tbl">  
  <?php 
	if (isset($updtdata)) {
		echo $updtdata;
	}
?>

<?php
	$usrdat = $usr->getUserDataById($userid);
	if ($usrdat) {
		while ( $result = $usrdat->fetch_assoc()) {
		
?> 
			 <tr>
			   <td>Name</td>
			   <td><input name="name" type="text" value="<?php echo $result['name']; ?>"></td>
			 </tr>
			  <tr>
			   <td>Username</td>
			   <td><input name="username" type="text" value="<?php echo $result['username']; ?>"></td>
			 </tr>
			  <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" value="<?php echo $result['email']; ?>"></td>
			 </tr>
			  <tr>
			  <td></td>
			   <td><input type="submit" value="Update">
			   </td>
			 </tr>
       </table>
  <?php }  } ?>

	</form>
	   

</div>
<?php include 'inc/footer.php'; ?>