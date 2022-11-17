<?
class IVA {

	private $table = 'ivas';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Connect_DB();
		$this->conection = $dbObj->conection;
	}
    
/*Get all IVAs*/
    public function getIVAs(){
        $this->getConection();
        $query = "SELECT * from".$this->table;
        $stmt = $this->conection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

/* Get IVA by ID */
    public function getIVAByID($ivaid){
        if(is_null($ivaid)) return false;
        $this->getConection();
        $query = "SELECT * FROM ".$this->table." WHERE ivaid = ?";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$ivaid]);
        return $stmt->fetch();
    }

/* Add new IVA */
    public function addIVA($ivatype,$ivaperc){
        if(is_null($ivatype) || is_null($ivaperc)) return false;
        $this->getConection();
        $query = "INSERT INTO ".$this->table." (ivatype,ivaperc) VALUES (?,?);";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$ivatype,$ivaperc]);
        }

/* Delete existing IVA */
        public function deleteIVA($ivaid){
            if(is_null($ivaid)) return false;
            $this->getConection();
            $query = "DELETE FROM ".$this->table." WHERE ivaid = ?;";
            $stmt = $this->conection->prepare($query);
            $stmt->execute([$ivaid]);
            }

/* Edit existing IVA */
            public function editIVA($ivaid,$ivatype,$ivaperc){
                $this->getConection();
                if(!isset($ivaid)){
                    $getivaid = "SELECT ivaid from ".$this->table." where ivatype = ?;";
                    $stmt = $this->conection->prepare($getivaid);
                    $stmt->execute([$ivatype]);
                    $ivaid = $stmt->fetch();
                }
                if(is_null($ivaid)) return false;
                if(isset($ivaid) && !isset($ivatype)){
                    $query ='SELECT ivatype from '.$this->table.' where ivaid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$ivaid]);
                    $ivatype = $stmt->fetch();
                }elseif(isset($ivaid) && !isset($prodname)){
                    $query ='SELECT ivaperc from '.$this->table.' where ivaid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$ivaid]);
                    $ivaperc = $stmt->fetch();
                }
                $query = "UPDATE ".$this->table." SET ivatype = ?,ivaperc = ?;";
                $stmt = $this->conection->prepare($query);
                $stmt->execute([$ivatype,$ivaperc]);
            }
	};
?>