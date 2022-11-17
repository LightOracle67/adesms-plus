<?
class ProdClass {

	private $table = 'classlist';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Connect_DB();
		$this->conection = $dbObj->conection;
	}
    
/*Get all IVAs*/
    public function getClasses(){
        $this->getConection();
        $query = "SELECT * from".$this->table;
        $stmt = $this->conection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

/* Get IVA by ID */
    public function getClassByID($classid){
        if(is_null($classid)) return false;
        $this->getConection();
        $query = "SELECT * FROM ".$this->table." WHERE classid = ?";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$classid]);
        return $stmt->fetch();
    }

/* Add new IVA */
    public function addClass($ivatype,$ivaperc){
        if( is_null($ivatype) || is_null($ivaperc)) return false;
        $this->getConection();
        $query = "INSERT INTO ".$this->table." (ivatype,ivaperc) VALUES (?,?);";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$ivatype,$ivaperc]);
        }

/* Delete existing IVA */
        public function delClass($classid){
            if(is_null($classid)) return false;
            $this->getConection();
            $query = "DELETE FROM ".$this->table." WHERE classid = ?;";
            $stmt = $this->conection->prepare($query);
            $stmt->execute([$classid]);
            }

/* Edit existing IVA */
            public function editClass($classid,$ivatype,$ivaperc){
                $this->getConection();
                if(!isset($classid)){
                    $getclassid = "SELECT classid from ".$this->table." where ivatype = ?;";
                    $stmt = $this->conection->prepare($getclassid);
                    $stmt->execute([$ivatype]);
                    $classid = $stmt->fetch();
                }
                if(is_null($classid)) return false;
                if(isset($classid) && !isset($ivatype)){
                    $query ='SELECT ivatype from '.$this->table.' where classid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$classid]);
                    $ivatype = $stmt->fetch();
                }elseif(isset($classid) && !isset($prodname)){
                    $query ='SELECT ivaperc from '.$this->table.' where classid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$classid]);
                    $ivaperc = $stmt->fetch();
                }
                $query = "UPDATE ".$this->table." SET ivatype = ?,ivaperc = ? where classid = ?;";
                $stmt = $this->conection->prepare($query);
                $stmt->execute([$ivatype,$ivaperc,$classid]);
            }
	};
?>
?>