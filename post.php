<?php
// https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
    class Post{

        private $conn;

        public $id;
        public $numero;
        public $rue;
        public $ville;
        public $code_postal;
        public $date_creation;

        public function __construct($conn){
            $this->conn = $conn;
        }
    
        //C
        public function create(){
            $query = "INSERT INTO post SET date_post = :date_post, contenue = :contenue";
            $stmt = $this->conn->prepare($query);

            $this->date_post = htmlspecialchars(strip_tags($this->date_post));
            $this->contenue = htmlspecialchars(strip_tags($this->contenue));
            


            $stmt->bindParam(":date_post", $this->date_post);
            $stmt->bindParam(":contenue", $this->contenue);

            if($stmt->execute()){
                return true;
            }
         
            return false;

        }
        //R
        public function read(){
            $query = "SELECT * FROM post order by date_post desc";
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->execute();
    
            return $stmt;
        }
        //U
        public function update(){

            $query = "UPDATE post SET date_post = :date_post, contenue = :contenuewhere id=?";
            $stmt = $this->conn->prepare($query);

            $this->date_post = htmlspecialchars(strip_tags($this->date_post));
            $this->contenue = htmlspecialchars(strip_tags($this->contenue));
			$this->id=htmlspecialchars(strip_tags($this->id));
            
            $stmt->bindParam(":date_post", $this->date_post);
            $stmt->bindParam(":contenue", $this->contenue);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
            }
         
            return false;
        }
        //D
        public function delete(){

            // delete query
            $query = "DELETE FROM post WHERE id = ?";
        
            // prepare query
            $stmt = $this->conn->prepare($query);
        
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind id of record to delete
            $stmt->bindParam(1, $this->id);
        
            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }

        function readOne(){
 
            // query to read single record
            $query = "SELECT * FROM post WHERE id = ?";

            // prepare query statement
            $stmt = $this->conn->prepare( $query );
         
            // bind id of product to be updated
            $stmt->bindParam(1, $this->id);
         
            // execute query
            $stmt->execute();
         
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
            // set values to object properties
            $this->date_post = $row['date_post'];
            $this->contenue = $row['contenue'];
        }
		
        
    }
?>