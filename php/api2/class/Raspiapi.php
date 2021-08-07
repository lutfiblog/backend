<?php
class Raspiapi{   
    
    private $itemsTable = "raspiapi";      
    public $id;
    public $name;
    public $status;
    public $pesan;
    public $jumlah;   
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
			INSERT INTO ".$this->itemsTable."(`name`, `status`, `pesan`, `jumlah`, `created`)
			VALUES(?,?,?,?,?)");
		
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->status = htmlspecialchars(strip_tags($this->status));
		$this->pesan = htmlspecialchars(strip_tags($this->pesan));
		$this->jumlah = htmlspecialchars(strip_tags($this->jumlah));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$stmt->bind_param("sssis", $this->name, $this->status, $this->pesan, $this->jumlah, $this->created);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable." 
			SET name= ?, status = ?, pesan = ?, jumlah = ?, created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->status = htmlspecialchars(strip_tags($this->status));
		$this->pesan = htmlspecialchars(strip_tags($this->pesan));
		$this->jumlah = htmlspecialchars(strip_tags($this->jumlah));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("sssisi", $this->name, $this->status, $this->pesan, $this->jumlah, $this->created, $this->id);
		
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