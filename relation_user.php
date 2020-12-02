<?php
	class Relation_user{
		private $conn;

        public $id_user;
        public $id_ami;
        public $date_ajout;

        public function __construct($conn){
            $this->conn = $conn;
        }
		function add_friend(){
			$query =  "INSERT INTO relation_user (id_user, id_ami, date_ajout) VALUES ('".$this->id_user."','".$this->id_ami."','".$this->date_ajout."')";
			$this->id_user = htmlspecialchars(strip_tags($this->id_user));
			$this->id_ami = htmlspecialchars(strip_tags($this->id_ami));
			$this->date_ajout = htmlspecialchars(strip_tags($this->date_ajout));
			$stmt = $this->conn->prepare($query);
			if($stmt->execute()){
                return true;
            }
            return false;
		}
	}
?>