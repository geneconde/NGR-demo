<?php
/**
 * UserFactory class
 * Created by: Raina Gamboa
*/

if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Error.class.php');
}

if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Error.class.php');
}

if(!class_exists('Utils')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.inc.trial.php');
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
	
	public function loadUserType($type, $teacherid) {
		$where = array();
		$where['type'] = $type;
		$where['teacher_id'] = $teacherid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where,'*','last_name ASC');
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

	public function updateUser($userid, $uname, $fname, $lname, $gender) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['first_name'] = $fname;
		$data['last_name'] 	= $lname;
		$data['username']	= $uname;
		$data['gender']		= $gender;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updatePassword($userid, $newpassword){
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['password'] = $newpassword;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}
	
	public function updateUserPassword($userid, $password){
		$where = array();
		$where['user_ID'] = $userid;
		
		$salt = sha1(md5($password));
		$password = md5($password.$salt);
	
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
			}
			else{ return Error::ERROR_WRONG_PASSWORD;
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
	
	private function setData($user) {
		$data = array();
		$data['password']			= Utils::toHash($user->getPassword());
		$data['username']			= $user->getUsername();
		$data['first_name'] 		= $user->getFirstname();
		$data['last_name'] 			= $user->getLastname();
		$data['user_ID'] 			= $user->getUserid();
		$data['gender']				= $user->getGender();
		$data['type']				= $user->getType();
		$data['teacher_id']			= $user->getTeacher();
		$data['create_date']		= $user->getCreateDate();
		$data['expire_date']		= $user->getExpireDate();
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
		$user->setType($row['type']);
		$user->setTeacher($row['teacher_id']);
		$user->setCreateDate($row['create_date']);
		$user->setExpireDate($row['expire_date']);
		return $user;
	}
	
	/* For generating accounts */
	public function addUser($user) {
		$data = array();
		$data2 = array();
		$data = $this->setUserValues($user);
		$data2 = $this->setUserValues2($user);
				
		$db = new DB();
		$db->connect();
		$db->insert("users", $data);
		$db->insert("users2", $data2);
		$db->disconnect();
	}
	
	private function setUserValues($values) {
		$salt = sha1(md5($values['password']));
		$password = md5($values['password'].$salt);
	
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $password;
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['gender'] 		= $values['gender'];
		$data['teacher_id'] 	= $values['teacher_id'];
		$data['create_date'] 	= date('Y-m-d G:i:s');
		$data['expire_date'] 	= date('Y-m-d G:i:s');
		return $data;
	}
	
	private function setUserValues2($values) {
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $values['password'];
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['gender'] 		= $values['gender'];
		$data['teacher_id'] 	= $values['teacher_id'];
		$data['create_date'] 	= date('Y-m-d G:i:s');
		$data['expire_date'] 	= date('Y-m-d G:i:s');
		return $data;
	}
}
?>

	require_once($_SERVER['DOCUMENT_ROOT'].'/demo/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/demo/model/db.inc.trial.php');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/demo/includes/UserTrial.class.php');

ini_set('track_errors', true);

class UserTrialController {
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
	
	public function loadUserType($type, $teacherid) {
		$where = array();
		$where['type'] = $type;
		$where['teacher_id'] = $teacherid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where,'*','last_name ASC');
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

	public function updateUser($userid, $uname, $fname, $lname, $gender) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['first_name'] = $fname;
		$data['last_name'] 	= $lname;
		$data['username']	= $uname;
		$data['gender']		= $gender;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updatePassword($userid, $newpassword){
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['password'] = $newpassword;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}
	
	public function updateUserPassword($userid, $password){
		$where = array();
		$where['user_ID'] = $userid;
		
		$salt = sha1(md5($password));
		$password = md5($password.$salt);
	
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
			}
			else{ return Error::ERROR_WRONG_PASSWORD;
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
	
	private function setData($user) {
		$data = array();
		$data['password']			= Utils::toHash($user->getPassword());
		$data['username']			= $user->getUsername();
		$data['first_name'] 		= $user->getFirstname();
		$data['last_name'] 			= $user->getLastname();
		$data['user_ID'] 			= $user->getUserid();
		$data['gender']				= $user->getGender();
		$data['type']				= $user->getType();
		$data['teacher_id']			= $user->getTeacher();
		return $data;
	}
	
	private function setUser($row) {
		$user = new UserTrial();
		$user->setUsername($row['username']);
		$user->setPassword($row['password']);
		$user->setFirstname($row['first_name']);
		$user->setLastname($row['last_name']);
		$user->setUserid($row['user_ID']);
		$user->setGender(strtolower($row['gender']));
		$user->setType($row['type']);
		$user->setTeacher($row['teacher_id']);
		$user->setDateCreated($row['date_created']);
		$user->setExpireDate($row['expire_date']);
		return $user;
	}

	//Generating Trial Users
	public function addUserTrial($user) {
		$data = array();
		$data2 = array();
		$data = $this->setTrialUserValues($user);
		$data2 = $this->setTrialUserValues2($user);
				
		$db = new DB();
		$db->connect();
		$db->insert("users", $data);
		$db->insert("users2", $data2);
		$db->disconnect();
	}
	
	private function setTrialUserValues($values) {
		$salt = sha1(md5($values['password']));
		$password = md5($values['password'].$salt);
	
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $password;
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['gender'] 		= $values['gender'];
		$data['teacher_id'] 	= 1;
		$data['date_created']	= date('Y-m-d G:i:s');
		$data['expire_date']	= date('Y-m-d G:i:s', strtotime("+15 days"));
		return $data;
	}
	
	private function setTrialUserValues2($values) {
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $values['password'];
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['gender'] 		= $values['gender'];
		$data['teacher_id'] 	= 1;
		$data['date_created']	= date('Y-m-d G:i:s');
		$data['expire_date']	= date('Y-m-d G:i:s', strtotime("+15 days"));
		return $data;
	}
}
?>
