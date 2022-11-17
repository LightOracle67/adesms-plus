<?
class Product {

	private $table = 'products';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Connect_DB();
		$this->conection = $dbObj->conection;
	}

    /*USER BY ID*/
    public function getProducts(){
        $this->getConection();
        $query = "SELECT * from".$this->table;
        $stmt = $this->conection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductByID($prodid){
        if(is_null($prodid)) return false;
        $this->getConection();
        $query = "SELECT * FROM ".$this->table." WHERE prodid = ?";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$prodid]);
        return $stmt->fetch();
    }

    public function addProduct($prodname,$fullname,$proddesc,$dateadded,$price,$class,$type,$image){
        if( is_null($prodname) || is_null($fullname) || is_null($proddesc) || is_null($dateadded) || is_null($price) || is_null($class) || is_null($type) || is_null($image)) return false;
        $this->getConection();
        $query = "INSERT INTO ".$this->table." (prodname,fullname,proddesc,dateadded,price,class,type,image) VALUES (?,?,?,?,?,?,?,?);";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$prodname,$fullname,$proddesc,$dateadded,$price,$class,$type,$image]);
        }

        public function deleteProduct($prodid){
            if(is_null($prodid)) return false;
            $this->getConection();
            $query = "DELETE FROM ".$this->table." WHERE prodid = ?;";
            $stmt = $this->conection->prepare($query);
            $stmt->execute([$prodid]);
            }

            public function editProduct($prodid,$prodname,$fullname,$proddesc,$dateadded,$price,$class,$type,$image){
                $this->getConection();
                if(!isset($prodid)){
                    $getprodid = "SELECT prodid from ".$this->table." where prodname = ?;";
                    $stmt = $this->conection->prepare($getprodid);
                    $stmt->execute([$prodname]);
                    $prodid = $stmt->fetch();
                }
                if(is_null($prodid)) return false;
                if(isset($prodid) && !isset($prodname)){
                    $query ='SELECT prodname from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $prodname = $stmt->fetch();
                };
if(isset($prodid) && !isset($fullname)){
                    $query ='SELECT fullname from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $fullname = $stmt->fetch();
                };
if(isset($prodid) && !isset($proddesc)){
                    $query ='SELECT proddesc from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $proddesc = $stmt->fetch();
                };
                if(isset($prodid) && !isset($dateadded)){
                    $query ='SELECT dateadded from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $dateadded = $stmt->fetch();
                };
                if(isset($prodid) && !isset($price)){
                    $query ='SELECT price from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $price = $stmt->fetch();
                };if(isset($prodid) && !isset($class)){
                    $query ='SELECT class from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $class = $stmt->fetch();
                };
                if(isset($prodid) && !isset($type)){
                    $query ='SELECT type from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $type = $stmt->fetch();
                };
                if(isset($prodid) && !isset($image)){
                    $query ='SELECT image from '.$this->table.' where prodid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$prodid]);
                    $image = $stmt->fetch();
                }
                $query = "UPDATE ".$this->table." SET ,prodname = ?,fullname = ?,proddesc = ?,dateadded = ?,price = ?,class = ?,type = ?,image = ? where prodid = ?;";
                $stmt = $this->conection->prepare($query);
                $stmt->execute([$prodname,$fullname,$proddesc,$dateadded,$price,$class,$type,$image,$prodid]);
            }
	};
?>