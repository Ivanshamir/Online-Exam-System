<?php 
	include '/inc/header.php';
	include '../classes/exam.php';
	$exm = new Exam();
?>
<?php
	if (isset($_GET['rmvquesid'])) {
		$rmvquesid = (int)$_GET['rmvquesid'];
		$delque = $exm->deleteQuestions($rmvquesid);
	}
?>
<div class="main">
<h1>Admin Panel - Manage Questions</h1>
<?php 
	if (isset($delque)) {
		echo $delque;
	}
?>
	<div class="usermng">
		<table class="tblone">
			<tr>
				<th width="10%">No.</th>
				<th width="70%">Questions</th>
				<th width="20%">Action</th>
			</tr>
	<?php
		$mngque = $exm->manageQuestions();
		if ($mngque) {
			$i =0;
			while ($value = $mngque->fetch_assoc()) {
				$i++;
			
	 ?>
			<tr>
				<td><?php echo $i;	?></td>
				<td><?php echo $value['ques']; ?></td>
				<td>
				<a onclick="return confirm('Are you sure to remove?')" href="?rmvquesid=<?php echo $value['quesno']; ?>">Remove</a>
				</td>
			</tr>
	<?php } } ?>
		</table>
	</div>

	
</div>
<?php include 'inc/footer.php'; ?>