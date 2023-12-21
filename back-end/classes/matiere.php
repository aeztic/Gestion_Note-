<?php 
class Matiere {
        public $idMatiere;
        public $libelle;
        public $coef;

        public function __construct($libelle, $coef) {
            $this->libelle = $libelle;
            $this->coef = $coef;
            ;
        }

        public static function  selectAllMatieres($tableName,$conn){

            $sql = "SELECT idMat, libelle,coef  FROM $tableName ";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    $data=[];
                    while($row = mysqli_fetch_assoc($result)) {
                    
                        $data[]=$row;
                    }
                    return $data;
                }
            
            }

            
}
?>