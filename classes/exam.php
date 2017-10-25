<?php 
	include '/../lib/Database.php';
	include '/../helpers/Format.php';
	
	class Exam{
		private $db;
		private $fm;
		function __construct(){
			$this->db  = new Database();
			$this->fm  = new Format();
		}

		public function addQuestion($data){
			$quesno = $this->fm->validation($data['quesno']);
			$ques = $this->fm->validation($data['ques']);
			$ans1 = $this->fm->validation($data['ans1']);
			$ans2 = $this->fm->validation($data['ans2']);
			$ans3 = $this->fm->validation($data['ans3']);
			$ans4 = $this->fm->validation($data['ans4']);
			$rightans = $this->fm->validation($data['rightans']);

			$quesno = mysqli_real_escape_string($this->db->link, $quesno);
			$ques = mysqli_real_escape_string($this->db->link, $ques);
			$ans1 = mysqli_real_escape_string($this->db->link, $ans1);
			$ans2 = mysqli_real_escape_string($this->db->link, $ans2);
			$ans3 = mysqli_real_escape_string($this->db->link, $ans3);
			$ans4 = mysqli_real_escape_string($this->db->link, $ans4);
			$rightans = mysqli_real_escape_string($this->db->link, $rightans);

			$ansr = array();
			$ansr[1] = $ans1;
			$ansr[2] = $ans2;
			$ansr[3] = $ans3;
			$ansr[4] = $ans4;

			$query = "INSERT INTO tbl_ques(quesno,ques) VALUES('$quesno', '$ques')";
			$insert_row = $this->db->dbCreate($query);

			if ($insert_row) {
				foreach ($ansr as $key => $value) {
					if ($value != '') {
						if ($rightans == $key) {
						$rquery = "INSERT INTO tbl_ans(quesno,rightans,ans) VALUES('$quesno', '1' ,'$value')";
						}else{
							$rquery = "INSERT INTO tbl_ans(quesno,rightans,ans) VALUES('$quesno', '0' ,'$value')";
						}
						$insert_ans = $this->db->dbCreate($rquery);
						if ($insert_ans) {
							continue;
						}else{
							die("Error...");
						}
					}
					
				}

				$msg = "<span class='success'>Question Inserted Successfully</span>";
				return $msg;
			}


		}

		public function manageQuestions(){
			$query = "SELECT * FROM tbl_ques ORDER BY quesno ASC";
			$result = $this->db->selectDb($query);
			return $result;
		}
		
		public function deleteQuestions($rmvquesid){
			$tables = array("tbl_ques","tbl_ans");
			foreach ($tables as $table) {
				$deldata = "DELETE FROM  $table WHERE quesno='$rmvquesid'";
				$result = $this->db->deleteUser($deldata);
			}
			if ($result) {
				$msg = "<span class='success'>Question Removed Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='success'>Question Can not be removed.</span>";
				return $msg;
			}
		}

		public function getTotalRow(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this->db->selectDb($query);
			$totalrow = $result->num_rows;
			return $totalrow;
		}

		public function getFirstQuestion(){
			$query = "SELECT * FROM tbl_ques";
			$getdata = $this->db->selectDb($query);
			$result = $getdata->fetch_assoc();
			return $result;
		}

		public function getCrrntQuestion($qnumber){
			$query = "SELECT * FROM tbl_ques WHERE quesno='$qnumber'";
			$getdata = $this->db->selectDb($query);
			$result = $getdata->fetch_assoc();
			return $result;
		}

		public function getAnswer($qnumber){
			$query = "SELECT * FROM tbl_ans WHERE quesno='$qnumber' ORDER BY id";
			$getdata = $this->db->selectDb($query);
			return $getdata;
		}

	}


?>