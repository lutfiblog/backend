<?php
class Iotapi{   
    
    private $itemsTable = "iotapi";      
    public $id;
    public $mon1;
    public $mon2;
    public $kon1;
    public $kon2;   
    public $created; 
	public $modified; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(`mon1`, `mon2`, `kon1`, `kon2`, `created`)
			VALUES(?,?,?,?,?)");
		
		$this->mon1 = htmlspecialchars(strip_tags($this->mon1));
		$this->mon2 = htmlspecialchars(strip_tags($this->mon2));
		$this->kon1 = htmlspecialchars(strip_tags($this->kon1));
		$this->kon2 = htmlspecialchars(strip_tags($this->kon2));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$stmt->bind_param("sssis", $this->mon1, $this->kon2, $this->kon1, $this->kon2, $this->created);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable." 
			SET mon1= ?, mon2 = ?, kon1 = ?, kon2 = ?, created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->mon1 = htmlspecialchars(strip_tags($this->mon1));
		$this->mon2 = htmlspecialchars(strip_tags($this->mon2));
		$this->kon1 = htmlspecialchars(strip_tags($this->kon1));
		$this->kon2 = htmlspecialchars(strip_tags($this->kon2));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("sssisi", $this->mon1, $this->mon2, $this->kon1, $this->kon2, $this->created, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->itemsTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>