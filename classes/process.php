<?php 
	//include 'lib/Session.php';
	//Session::init();
	//include '/../lib/Database.php';
	//include '/../helpers/Format.php';
	class Process{
		private $db;
		private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getProcess($data){
			$slctdans = $this->fm->validation($data['ans']);
			$number = $this->fm->validation($data['number']);
			$slctdans = mysqli_real_escape_string($this->db->link, $slctdans);
			$number = mysqli_real_escape_string($this->db->link, $number);
			$next = $number+1;

			if (!isset($_SESSION['score'])) {
				$_SESSION['score'] = '0';
			}

			$rtans = $this->getRightAnswer($number);
			$totques = $this->getTotalQues();
			if ($rtans == $slctdans) {
				$_SESSION['score']++;
			}

			if ($totques == $number) {
				header("Location:final.php");
				exit();
			}else{
				header("Location:test.php?q=".$next);
			}
		}

		private function getRightAnswer($number){
			$query = "SELECT * FROM tbl_ans WHERE quesno='$number' AND rightans='1'";
			$getdata = $this->db->selectDb($query)->fetch_assoc();
			$result = $getdata['id'];
			return $result;
		}

		private function getTotalQues(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this->db->selectDb($query);
			$totalrow = $result->num_rows;
			return $totalrow;
		}

	}


?>