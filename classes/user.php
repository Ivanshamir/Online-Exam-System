<?php 
	include_once 'lib/Session.php';
	include '/../lib/Database.php';
	include '/../helpers/Format.php';
	
	class User{
		private $db;
		private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function userRegistration($name, $username, $password, $email){
			$name = $this->fm->validation($name);
			$username = $this->fm->validation($username);
			$password = $this->fm->validation($password);
			$email = $this->fm->validation($email);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			$email = mysqli_real_escape_string($this->db->link, $email);

			if ($name == "" || $username == "" || $password == "" || $email == "") {
				echo "<span class='error'>Field must not be empty</span>";
				exit();
			}elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				echo "<span class='error'>Invalid Email ! </span>";
				exit();
			}else{
				$emlquery = "SELECT * FROM tbl_user WHERE email='$email'";
				$emailcheck = $this->db->selectDb($emlquery);
				if ($emailcheck != false) {
					echo "<span class='error'>Email Already Exist ! </span>";
					exit();
				}else{
					$query = "INSERT INTO tbl_user(name,username,password,email) 
								VALUES('$name' ,'$username', '$password', '$email')";
					$result = $this->db->dbCreate($query);
					if ($result) {
						echo "<span class='success'>Registration Succcessfull ! </span>";
						exit();
					}else{
						echo "<span class='error'>Registration Unsuccessfull ! </span>";
						exit();
					}
				}
			}
		}

		public function userLogin($email, $password){
			$email = $this->fm->validation($email);
			$password = $this->fm->validation($password);

			$email = mysqli_real_escape_string($this->db->link, $email);
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			
			if ($email == "" || $password == "") {
				echo "empty";
				exit();
			}else{
				$query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
				$result = $this->db->selectDb($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					if($value['status'] == '1'){
						echo "disable";
						exit();
					}else{
						Session::init();
						Session::set("login", true);
						Session::set("userid", $value['userid']);
						Session::set("username", $value['username']);
						Session::set("name", $value['name']);
					}
				}else{
					echo "error";
					exit();
				}
			}
		}

		public function getUserDataById($userid){
			$query = "SELECT * FROM tbl_user WHERE userid='$userid'";
			$result = $this->db->selectDb($query);
			return $result;
		}

		public function getUserData(){
			$query = "SELECT * FROM tbl_user ORDER BY userid DESC";
			$result = $this->db->selectDb($query);
			return $result;
		}

		public function UserDisabled($userid){
			$query = "UPDATE tbl_user SET 
						status='1'
						WHERE userid='$userid'";
			$update_row = $this->db->dbUpdate($query);
			if ($update_row) {
				$msg = "<span class='success'>User Disabled</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Can not be Disabled</span>";
				return $msg;
			}
		}

		public function UserEnabled($userid){
			$query = "UPDATE tbl_user SET 
						status='0'
						WHERE userid='$userid'";
			$update_row = $this->db->dbUpdate($query);
			if ($update_row) {
				$msg = "<span class='success'>User Enabled</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Can not be Enabled</span>";
				return $msg;
			}
		}

		public function UserRemove($userid){
			$query = "DELETE FROM tbl_user WHERE userid='$userid'";
			$delusr = $this->db->deleteUser($query);
			if ($delusr) {
				$msg = "<span class='success'>User Deleted</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Can not be Deleted</span>";
				return $msg;
			}
		}


		public function userUpdateData($userid, $data){
			$name = $this->fm->validation($data['name']);
			$username = $this->fm->validation($data['username']);
			$email = $this->fm->validation($data['email']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email = mysqli_real_escape_string($this->db->link, $email);

			if ($name == "" || $username == "" || $email == "") {
				$msg = "<span class='error'>Field must not be empty</span>";
				return $msg;
				exit();
			}elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<span class='error'>Invalid Email ! </span>";
				return $msg;
				exit();
			}else{
				$query = "UPDATE tbl_user SET 
						name='$name',
						username='$username',
						email='$email'
						WHERE userid='$userid'";
				$update_row = $this->db->dbUpdate($query);
				if ($update_row) {
					$msg = "<span class='success'>User Updated</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>User Can not be Updated</span>";
					return $msg;
				}
			}

		}

	}
?>