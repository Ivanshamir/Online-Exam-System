<?php 
	include '/inc/header.php';
	include '../classes/user.php';
	$usr = new User();
?>
<?php 
	if (isset($_GET['dsblid'])) {
		$dsblid = (int)$_GET['dsblid'];
		$userdsbl = $usr->UserDisabled($dsblid);
	}

	if (isset($_GET['enblid'])) {
		$enblid = (int)$_GET['enblid'];
		$userenbl = $usr->UserEnabled($enblid);
	}

	if (isset($_GET['rmvid'])) {
		$rmvid = (int)$_GET['rmvid'];
		$userrmv = $usr->UserRemove($rmvid);
	}
?>
<div class="main">
<h1>Admin Panel - Manage Users</h1>
<?php 
	if (isset($userdsbl)) {
		echo $userdsbl;
	}
	if (isset($userenbl)) {
		echo $userenbl;
	}
	if (isset($userrmv)) {
		echo $userrmv;
	}
?>
	<div class="usermng">
		<table class="tblone">
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
	<?php
		$userdat = $usr->getUserData();
		if ($userdat) {
			$i =0;
			while ($value = $userdat->fetch_assoc()) {
				$i++;
			
	 ?>
			<tr>
				<td><?php
					if ($value['status'] == '1') {
						echo "<span class='error'>".$i."</span>";
					}else{
						echo $i; 
					}
				 ?></td>
				<td><?php echo $value['name']; ?></td>
				<td><?php echo $value['username']; ?></td>
				<td><?php echo $value['email']; ?></td>
				<td>
				<?php if ($value['status'] == '0') { ?>
					<a onclick="return confirm('Are you sure to disable?')" href="?dsblid=<?php echo $value['userid']; ?>">Disable</a>
				<?php	}else{ ?>
					<a onclick="return confirm('Are you sure to enable?')" href="?enblid=<?php echo $value['userid']; ?>">Enable</a>
				<?php	} ?>				 
					 ||	<a onclick="return confirm('Are you sure to remove?')" href="?rmvid=<?php echo $value['userid']; ?>">Remove</a>
				</td>
			</tr>
	<?php } } ?>
		</table>
	</div>

	
</div>
<?php include 'inc/footer.php'; ?>