<?php
class Session{
	 public static function init(){
	 	session_start();
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }

	  public static function checkadminSession(){
	 	self::init();
	 	if (self::get("login") == false) {
	 		self::destroy();
	 		header("Location:login.php");
	 	}
	 }

	 public static function checkadminLogin(){
	 	self::init();
	 	if (self::get("login") == true) {
	 		header("Location:index.php");
	 	}
	 }

	 public static function checkSession(){
	 	//self::init();
	 	if (self::get("login") == false) {
	 		self::destroy();
	 		header("Location:index.php");
	 	}
	 }

	 public static function checkLogin(){
	 	//self::init();
	 	if (self::get("login") == true) {
	 		header("Location:exam.php");
	 	}
	 }

	 public static function destroy(){
	 	session_destroy();
	 	session_unset();
	 }
}

?>