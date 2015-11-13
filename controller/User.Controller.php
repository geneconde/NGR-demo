<?php
/**
 * UserFactory class
 * Created by: Raina Gamboa
*/

if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Error.class.php');
}

if(!class_exists('Utils')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.inc.php');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/User.class.php');

ini_set('track_errors', true);

class UserController {
	public function __construct() {}

	public function getAllUsers() {
		$users = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users");
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			array_push($users, $user);
		}
		
		return empty($users) ? null : $users;
	}

	public function getAllStudents($tid) {
		$where = array();
		$where['teacher_id'] = $tid;
		$users = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		return ($result);
	}
	
	public function loadUserType($type, $teacherid) {
		$where = array();
		$where['type'] = $type;
		$where['teacher_id'] = $teacherid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where,'*','last_name DESC');
		$db->disconnect();	
		return $result;
	}

	public function loadUserTypeOrderLname($type, $teacherid) {
		$where = array();
		$where['type'] = $type;
		$where['teacher_id'] = $teacherid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where,'*','if(last_name = "" or last_name is null,1,0),last_name');
		$db->disconnect();	
		return $result;
	}
	
	public function loadUser($username) {
		$where = array();
		$where['username'] = $username;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}
	}

	public function loadUserByID($userid) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}
	}

	public function updateUser($userid, $uname, $fname, $lname, $gender, $level) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['first_name'] = $fname;
		$data['last_name'] 	= $lname;
		$data['username']	= $uname;
		$data['gender']		= $gender;
		$data['grade_level']= $level;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updateUserFL($userid) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['is_first_login'] = 0;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updateUserDate($userid, $new_curr_date) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['cur_date'] = $new_curr_date;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updatePassword($userid, $newpassword, $type=0){
		$where = array();
		$where['user_ID'] = $userid;
		
		if($type != 2){
			$newpassword = UserController::hashPassword($newpassword);
		}
		$data = array();
		$data['password'] = $newpassword;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updateUserType($datec, $newtype){
		$where = array();
		$where['expire_date'] = $datec;
		// $where['demo_id'] = $demo;
		
		$data = array();
		$data['type'] = $newtype;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}
	
	public function updateUserPassword($userid, $password){
		$where = array();
		$where['user_ID'] = $userid;
		
		$password = UserController::hashPassword($password);
	
		$data = array();
		$data['password']           = $password;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function deleteUser($userid) {
		$where = array();
		$where['user_ID'] = $userid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("users", $where);
		$db->disconnect();
	}

	public function deleteUserDate($current_date) {
		$where = array();
		$where['expire_date'] = $current_date;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("users", $where);
		$db->disconnect();
	}

	public function registerUser($user) {
		$data = array();
		$data = $this->setData($user);
		
		$data['username'] = $user->getUsername();	
		$data['status'] = 'Active';	
		$data['role'] = 'Student';
				
		$db = new DB();
		$db->connect();
		$db->insert("users", $data);
		$db->disconnect();
	}
 
	public function loginUser($username, $password) {
		if ($user = $this->loadUser($username)) {
			$hashedpass = $password;
			
			if ($user->getPassword() == $hashedpass) {
				return $user;
			} else { 
				return Error::ERROR_WRONG_PASSWORD;
				header("Location: login.php?err=2");
			}
		} else {
			return Error::ERROR_WRONG_USERNAME;		
			header("Location: login.php?err=3");
		}
	}

	public function checkUser($userid, $password) {
		if ($user = $this->loadUserByID($userid)) {
			$hashedpass = $password;
			
			if ($user->getPassword() == $hashedpass) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function logoutUser() {
		$_SESSION = array();
		session_unset();
		session_destroy();
	}
	
	public function checkUserExists($username) {
		$where = array();
		$where['username'] = $username;
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);

		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function checkEmailExists($email) {
		$where = array();
		$where['email'] = $email;
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function checkNameExistsTeacher($username, $type) {
		$where = array();
		$where['username'] = $username;
		$where['type'] = $type;

		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function checkNameExistsStudent($username, $type) {
		$where = array();
		$where['username'] = $username;
		$where['type'] = $type;

		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function getUser($userid) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}	
	}

	public function getUserByUsername($username) {
		$where = array();
		$where['username'] = $username;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();

		return $result;
	}
	
	public function getStudents($userid, $Suser) {
		$where = array();
		$where['user_ID'] = $userid;
		$where['username'] = $Suser;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}	
	}
	
	private function setData($user) {
		$data = array();
		$data['password']			= Utils::toHash($user->getPassword());
		$data['username']			= $user->getUsername();
		$data['first_name'] 		= $user->getFirstname();
		$data['last_name'] 			= $user->getLastname();
		$data['user_ID'] 			= $user->getUserid();
		$data['gender']				= $user->getGender();
		$data['type']				= $user->getType();
		$data['grade_level']		= $user->getLevel();
		$data['teacher_id']			= $user->getTeacher();
		$data['demo_id']			= $user->getDemoid();
		$data['create_date']		= $user->getCreateDate();
		// $data['cur_date']			= $user->getCurrentDate();
		// $data['expire_date']		= $user->getExpireDate();
		$data['is_first_login']		= $user->getFirstLogin();
		return $data;
	}
	
	private function setUser($row) {
		$user = new User();
		$user->setUsername($row['username']);
		$user->setPassword($row['password']);
		$user->setFirstname($row['first_name']);
		$user->setLastname($row['last_name']);
		$user->setUserid($row['user_ID']);
		$user->setGender(strtolower($row['gender']));
		$user->setLevel(strtolower($row['grade_level']));
		$user->setType($row['type']);
		$user->setLevel($row['grade_level']);
		$user->setTeacher($row['teacher_id']);
		$user->setDemoid($row['demo_id']);
		$user->setCreateDate($row['create_date']);
		// $user->setCurrentDate($row['cur_date']);
		// $user->setExpireDate($row['expire_date']);
		$user->setFirstLogin($row['is_first_login']);
		return $user;
	}
	
	/* For generating accounts */
	public  function addUser($user) {
		$data = array();
		// $data2 = array();
		$data = $this->setUserValues($user);
		// $data2 = $this->setUserValues2($user);
		$db = new DB();
		$db->connect();
		$db->insert("users", $data);
		// $db->insert("users2", $data2);
		$lastid = $db->dblastinsertid();
		
		$db->disconnect();

		return $lastid;
	}

	public function hashPassword($password){
		$salt = sha1(md5($password));
		$password = md5($password.$salt);
		return $password;
	}
	
	private function setUserValues($values) {
		// $salt = sha1(md5($values['password']));
		// $password = md5($values['password'].$salt);
	
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $values['password'];
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['last_name'] 		= $values['last_name'];
		$data['gender'] 		= $values['gender'];
		$data['grade_level'] 	= $values['grade_level'];
		$data['teacher_id'] 	= $values['teacher_id'];
		$data['demo_id'] 		= $values['demo_id'];
		$data['create_date'] 	= date('Y-m-d G:i:s');
		//$data['cur_date'] 		= date('Y-m-d G:i:s');
		//$data['expire_date'] 	= date('Y-m-d G:i:s', strtotime("+30 days"));
		return $data;
	}
	
	// private function setUserValues2($values) {
	// 	$data = array();
	// 	$data['username']		= $values['username'];
	// 	$data['password']		= $values['password'];
	// 	$data['type'] 			= $values['type'];
	// 	$data['first_name'] 	= $values['first_name'];
	// 	$data['gender'] 		= $values['gender'];
	// 	$data['teacher_id'] 	= $values['teacher_id'];
	// 	$data['create_date'] 	= date('Y-m-d G:i:s');
	// 	$data['expire_date'] 	= date('Y-m-d G:i:s');
	// 	return $data;
	// }
}
?>
