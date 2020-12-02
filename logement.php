<?php
// https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
    class Logement{

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
            $query = "INSERT INTO logement SET numero = :numero, rue = :rue, ville = :ville, code_postal = :code_postal, date_creation = :date_creation";
            $stmt = $this->conn->prepare($query);

            $this->numero = htmlspecialchars(strip_tags($this->numero));
            $this->rue = htmlspecialchars(strip_tags($this->rue));
            $this->ville = htmlspecialchars(strip_tags($this->ville));
            $this->code_postal = htmlspecialchars(strip_tags($this->code_postal));
            $this->date_creation = htmlspecialchars(strip_tags($this->date_creation));
            


            $stmt->bindParam(":numero", $this->numero);
            $stmt->bindParam(":rue", $this->rue);
            $stmt->bindParam(":ville", $this->ville);
            $stmt->bindParam(":code_postal", $this->code_postal);
            $stmt->bindParam(":date_creation", $this->date_creation);

            if($stmt->execute()){
                return true;
            }
         
            return false;

        }
        //R
        public function read(){
            $query = "SELECT * FROM logement";
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->execute();
    
            return $stmt;
        }
        //U
        public function update(){

            $query = "UPDATE logement SET numero = :numero, rue = :rue, ville = :ville, code_postal = :code_postal where id=?";
            $stmt = $this->conn->prepare($query);

            $this->numero = htmlspecialchars(strip_tags($this->numero));
            $this->rue = htmlspecialchars(strip_tags($this->rue));
            $this->ville = htmlspecialchars(strip_tags($this->ville));
            $this->code_postal = htmlspecialchars(strip_tags($this->code_postal));
			$this->id=htmlspecialchars(strip_tags($this->id));
            
            $stmt->bindParam(":numero", $this->numero);
            $stmt->bindParam(":rue", $this->rue);
            $stmt->bindParam(":ville", $this->ville);
            $stmt->bindParam(":code_postal", $this->code_postal);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
            }
         
            return false;
        }
        //D
        public function delete(){

            // delete query
            $query = "DELETE FROM logement WHERE id = ?";
        
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
            $query = "SELECT * FROM logement WHERE id = ?";

            // prepare query statement
            $stmt = $this->conn->prepare( $query );
         
            // bind id of product to be updated
            $stmt->bindParam(1, $this->id);
         
            // execute query
            $stmt->execute();
         
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
            // set values to object properties
            $this->firstname = $row['numero'];
            $this->lastname = $row['rue'];
            $this->email = $row['ville'];
            $this->password = $row['code_postal'];
            $this->date_creation = $row['date_creation'];
        }
		function get_logement_image(){
			$query = "select * from image i join logement_image li on i.id=li.idimage where li.idlogement = ?";
			$stmt = $this->conn->prepare( $query );
         
            // bind id of product to be updated
            $stmt->bindParam(1, $this->id);
			$stmt->execute();
			return $stmt;
		}
        
    }
?>