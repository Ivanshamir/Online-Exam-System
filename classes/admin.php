<?php 
	include '/../lib/Session.php';
	include '/../lib/Database.php';
	include '/../helpers/Format.php';

	class Admin{
		private $db;
		private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAdminData($data){
			$adminuser = $this->fm->validation($data['adminuser']);
			$adminpass = $this->fm->validation($data['adminpass']);
			$adminuser = mysqli_real_escape_string($this->db->link, $adminuser);
			$adminpass = mysqli_real_escape_string($this->db->link, md5($adminpass));

			$query = "SELECT * FROM tbl_admin WHERE adminuser='$adminuser' AND adminpass='$adminpass'";
			$result = $this->db->selectDb($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::init();
				Session::set("login", true);
				Session::set("adminuser", $value['adminuser']);
				Session::set("adminid", $value['adminid']);
				header("Location:index.php");
			}else{
				$msg = "<span class='error'>Username and Password can not match</span>";
				return $msg;
			}
		}
	}


?>