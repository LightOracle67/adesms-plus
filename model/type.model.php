<?
class ProdType {

	private $table = 'typelist';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Connect_DB();
		$this->conection = $dbObj->conection;
	}
    
/*Get all IVAs*/
    public function getTypes(){
        $this->getConection();
        $query = "SELECT * from".$this->table;
        $stmt = $this->conection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

/* Get IVA by ID */
    public function getTypeById($typeid){
        if(is_null($typeid)) return false;
        $this->getConection();
        $query = "SELECT * FROM ".$this->table." WHERE typeid = ?";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$typeid]);
        return $stmt->fetch();
    }

/* Add new IVA */
    public function addType($typename){
        if( is_null($typename)) return false;
        $this->getConection();
        $query = "INSERT INTO ".$this->table." (typename) VALUES (?);";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$typename]);
        }

/* Delete existing IVA */
        public function delType($typeid){
            if(is_null($typeid)) return false;
            $this->getConection();
            $query = "DELETE FROM ".$this->table." WHERE typeid = ?;";
            $stmt = $this->conection->prepare($query);
            $stmt->execute([$typeid]);
            }

/* Edit existing IVA */
            public function editType($typename){
                $this->getConection();
if(!isset($typeid)){                $gettypeid = "SELECT typeid from ".$this->table." where typename = ?;";
                $stmt = $this->conection->prepare($gettypeid);
                $stmt->execute([$typename]);
                $typeid = $stmt->fetch();}
                if(is_null($typeid)) return false;
                if(isset($typeid) && !isset($typename)){
                    $query ='SELECT typename from '.$this->table.' where typeid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$typeid]);
                    $typename = $stmt->fetch();
                }
                $query = "UPDATE ".$this->table." SET typename = ? where typeid = ?;";
                $stmt = $this->conection->prepare($query);
                $stmt->execute([$typename,$typeid]);
            }
	};
?>
?>