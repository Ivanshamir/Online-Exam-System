<?php 
    include '/inc/header.php';
	include '../classes/exam.php';
	$exm = new Exam();
?>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$addque = $exm->addQuestion($_POST);
	}
?>

<style>
	.admin{width: 480px;color: #999;margin: 20px auto 0;padding: 10px;border: 1px solid #ddd;}
	input[type="number"] {
	  border: 1px solid #ddd;
	  margin-bottom: 10px;
	  padding: 5px;
	  width: 100px;
	}
</style>
<div class="main">
<h1>Admin Panel - Add Question</h1>
<?php
	if (isset($addque)) {
		echo $addque;
	}
?>
<?php
	$totl = $exm->getTotalRow();
	$num = $totl+1;
?>
	<div class="admin">
		<form action="" method="post">
			<table>
				<tr>
					<td>Question No</td>
					<td>:</td>
					<td>
						<input type="number" value="<?php if (isset($num)) { echo $num; } ?>" name="quesno">
					</td>
				</tr>
				<tr>
					<td>Question</td>
					<td>:</td>
					<td><input type="text" name="ques" placeholder="Enter Question..." required=""></td>
				</tr>
				<tr>
					<td>Choise One</td>
					<td>:</td>
					<td><input type="text" name="ans1" placeholder="Enter Choice One..." required=""></td>
				</tr>
				<tr>
					<td>Choise Two</td>
					<td>:</td>
					<td><input type="text" name="ans2" placeholder="Enter Choice Two..." required=""></td>
				</tr>
				<tr>
					<td>Choise Three</td>
					<td>:</td>
					<td><input type="text" name="ans3" placeholder="Enter Choice Three..." required=""></td>
				</tr>
				<tr>
					<td>Choise Four</td>
					<td>:</td>
					<td><input type="text" name="ans4" placeholder="Enter Choice Four..." required=""></td>
				</tr>
				<tr>
					<td>Correct No</td>
					<td>:</td>
					<td><input type="number" name="rightans" required=""></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="submit" name="submit" value="Add A Question">
					</td>
				</tr>
			</table>
		</form>
	</div>

	
</div>
<?php include 'inc/footer.php'; ?>