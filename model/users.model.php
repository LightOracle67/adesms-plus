<?php
class User {

	private $table = 'users';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Connect_DB();
		$this->conection = $dbObj->conection;
	}

/*Get all users*/
    public function getUsers(){
        $this->getConection();
        $query = "SELECT * from".$this->table;
        $stmt = $this->conection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
/* Get User By ID*/
    public function getUserByID($userid){
        if(is_null($userid)) return false;
        $this->getConection();
        $query = "SELECT * FROM ".$this->table." WHERE userid = ?";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$userid]);
        return $stmt->execute([$userid]);
    }
/*Add User*/
    public function addUser($username,$realname,$password){
        if(is_null($username) || is_null($realname) || is_null($password)) return false;
        $this->getConection();
        $realpassword = hash('sha512',$password);
        $query = "INSERT INTO ".$this->table." (username,realname,password) VALUES (?,?,?);";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$username,$realname,$realpassword]);
        }

/* Delete existing user*/
        public function delUser($userid){
            if(is_null($userid)) return false;
            $this->getConection();
            $query = "DELETE FROM ".$this->table." WHERE userid = ?;";
            $stmt = $this->conection->prepare($query);
            $stmt->execute([$userid]);
            }
/* Edit Actual User */
            public function editActualUser($username,$realname,$password){
                $this->getConection();
                $getuserid = "SELECT userid from ".$this->table." where username = '".$_SESSION['name']."';";
                $stmt = $this->conection->prepare($getuserid);
                $stmt->execute($getuserid);
                $userid = $stmt->fetch();
                if(is_null($userid)) return false;
                if(isset($userid) && !isset($username)){
                    $query = 'SELECT username from '.$this->table.' where userid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$userid]);
                    $userid = $stmt->fetch();
                }
                if(isset($userid) && !isset($realname)){
                    $query = 'SELECT realname from '.$this->table.' where userid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$userid]);
                    $realname = $stmt->fetch();
                }
                if(isset($userid) && !isset($password)){
                    $query = 'SELECT password from '.$this->table.' where userid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$userid]);
                    $realpassword = $stmt->fetch();
                }else{
                    $realpassword = hash('sha512',$password);
                }
                $query = "UPDATE ".$this->table." SET username = ?, realname = ? ,password = ? where userid = ?;";
                $stmt = $this->conection->prepare($query);
                $stmt->execute([$username,$realname,$realpassword,$userid]);
            }
	};
?>