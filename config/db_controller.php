<?
class Connect_DB {

	private $host;
	private $db;
	private $user;
	private $pass;
	public $conection;

	public function __construct() {		

		$this->host = constant('DB_HOST');
		$this->db = constant('DB');
		$this->user = constant('DB_USER');
		$this->pass = constant('DB_PASS');

        $conection = new mysqli($this->host,$this->user,$this->pass,$this->db);

        if($conection->connect_error){
            exit();
        }
    }
}

?>