<?
class DiscountVoucher {

	private $table = 'discountvouchers';
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

    public function getVoucherByID($vouchid){
        if(is_null($vouchid)) return false;
        $this->getConection();
        $query = "SELECT * FROM ".$this->table." WHERE vouchid = ?";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$vouchid]);
        return $stmt->fetch();
    }

    public function addVoucher($voucher,$creationdate,$finaldate,$vouchpercent){
        if( is_null($voucher) || is_null($finaldate) || is_null($creationdate) || is_null($vouchpercent)) return false;
        $this->getConection();
        $query = "INSERT INTO ".$this->table." (voucher,creationdate,finaldate,vouchpercent) VALUES (?,?,?,?);";
        $stmt = $this->conection->prepare($query);
        $stmt->execute([$voucher,$creationdate,$finaldate,$vouchpercent]);
        }

        public function deleteVoucher($vouchid){
            if(is_null($vouchid)) return false;
            $this->getConection();
            $query = "DELETE FROM ".$this->table." WHERE vouchid = ?;";
            $stmt = $this->conection->prepare($query);
            $stmt->execute([$vouchid]);
            }

            public function editVoucher($vouchid,$voucher,$creationdate,$finaldate,$vouchpercent){
                $this->getConection();
                if(!isset($vouchid)){
                $getvouchid = "SELECT vouchid from ".$this->table." where voucher = ?;";
                $stmt = $this->conection->prepare($getvouchid);
                $stmt->execute([$voucher]);
                $vouchid = $stmt->fetch();
                };
                if(is_null($vouchid)) return false;
                if(isset($vouchid) && !isset($prodname)){
                    $query ='SELECT voucher from '.$this->table.' where vouchid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$vouchid]);
                    $voucher = $stmt->fetch();
                };
if(isset($vouchid) && !isset($fullname)){
                    $query ='SELECT creationdate from '.$this->table.' where vouchid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$vouchid]);
                    $creationdate = $stmt->fetch();
                };
if(isset($vouchid) && !isset($proddesc)){
                    $query ='SELECT finaldate from '.$this->table.' where vouchid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$vouchid]);
                    $finaldate = $stmt->fetch();
                };
                if(isset($vouchid) && !isset($dateadded)){
                    $query ='SELECT vouchpercent from '.$this->table.' where vouchid = ?';
                    $stmt = $this->conection->prepare($query);
                    $stmt->execute([$vouchid]);
                    $vouchpercent = $stmt->fetch();
                };
                $query = "UPDATE ".$this->table." SET ,voucher = ?,creationdate = ?,finaldate = ?,vouchpercent = ? where vouchid = ?;";
                $stmt = $this->conection->prepare($query);
                $stmt->execute([$voucher,$creationdate,$finaldate,$vouchpercent,$vouchid]);
            }
	};
?>