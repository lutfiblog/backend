<?php
class Appsapi{   
    
    private $itemsTable = "appsapi";    
	private $itemsTable2 = "appsapi2";      
    public $id;
    public $kode;
    public $plastic_collector_id;
    public $total_plastic;
    public $total_point;
    public $status;   
    public $created; 
	public $modified; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE id = ? DESC");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function readOne(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable2." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable2);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(`kode`, `plastic_collector_id`, `total_plastic`, `total_point`,`status`, `created`)
			VALUES(?,?,?,?,?,?)");
		
		$this->kode = htmlspecialchars(strip_tags($this->kode));
		$this->plastic_collector_id = htmlspecialchars(strip_tags($this->plastic_collector_id));
		$this->total_plastic = htmlspecialchars(strip_tags($this->total_plastic));
		$this->total_plastic = htmlspecialchars(strip_tags($this->total_point));
		$this->status = htmlspecialchars(strip_tags($this->status));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$stmt->bind_param("ssssis", $this->kode, $this->plastic_collector_id, $this->total_plastic, $this->total_point, $this->status, $this->created);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable." 
			SET kode= ?, plastic_collector_id = ?, total_plastic = ?, total_point = ?,status = ?, created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->kode = htmlspecialchars(strip_tags($this->kode));
		$this->plastic_collector_id = htmlspecialchars(strip_tags($this->plastic_collector_id));
		$this->total_plastic = htmlspecialchars(strip_tags($this->total_plastic));
		$this->total_point = htmlspecialchars(strip_tags($this->total_point));
		$this->status = htmlspecialchars(strip_tags($this->status));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("sssisi", $this->kode, $this->plastic_collector_id, $this->total_plastic, $this->total_point,$this->status, $this->created, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	function update2(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable2." 
			SET kode= ?, plastic_collector_id = ?, total_plastic = ?, convert_plastic = ?, total_point = ?, status = ?, created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->kode = htmlspecialchars(strip_tags($this->kode));
		$this->plastic_collector_id = htmlspecialchars(strip_tags($this->plastic_collector_id));
		$this->total_plastic = htmlspecialchars(strip_tags($this->total_plastic));
		$this->convert_plastic = htmlspecialchars(strip_tags($this->convert_plastic));
		$this->total_point = htmlspecialchars(strip_tags($this->total_point));
		$this->status = htmlspecialchars(strip_tags($this->status));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("sssssisi", $this->kode, $this->plastic_collector_id, $this->total_plastic, $this->convert_plastic, $this->total_point, $this->status, $this->created, $this->id);
		
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