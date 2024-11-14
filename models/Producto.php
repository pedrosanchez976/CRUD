<?php
/*
CREATE TABLE tm_producto
(
    prod_id ENTERO,
    prod_nom CADENA100,
    est ENTERO,
    fech_crea FEHO,
    fech_modi FEHO,
    fech_elim FEHO
    
); */
    class Producto extends Conectar{
        //protected $SELECT_todo = "SELECT * FROM tm_producto";
        //private $SELECT_todo = "SELECT prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est FROM tm_producto";
       
        private $SELECT_todo = "SELECT prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est FROM tm_producto";
        private $SELECT_x_id = "SELECT prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est FROM tm_producto WHERE prod_id = ?";
        private $SELECT_x_nom = "SELECT prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est FROM tm_producto WHERE prod_nom = ?";
        private $INSERT_x_nom = "INSERT INTO tm_producto (prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, current_timestamp, NULL, NULL, 1);";
        private $UPDATE_x_id = "UPDATE tm_producto SET prod_nom=?, fech_modi=current_timestamp WHERE prod_id = ?";

        private $Q;

    
        
/*
CONVERTIR OBJETO A ARRAY
$array = (array)$object;
var_dump($array);*/

        public function get_producto(){
            //$db= parent::conexion();
            $db= $this->conexion();
            $Q=ibase_query($db, $this->SELECT_todo);//"SELECT * FROM tm_producto";
/* debug 
echo 'generarMetadataQuery'; 
$aux=parent::generarMetadataQuery($Q);
var_dump($aux);
echo json_encode($aux); //{"nCampos":3,"campos":["PROD_ID","PROD_NOM","FECH_CREA"],"tipos":["INTEGER","VARCHAR","TIMESTAMP"]}
*/
            return  parent::generarDataset($Q);// array de objetos o de arrays
            //$this->cerrarConexion(); NO PARECE NECESARIO
        }

        //get_object_vars(object $object): array   Obtiene las propiedades no estáticas accesibles del objeto dado por object según el ámbito.

        public function get_producto_x_id($prod_id){
            $db= parent::conexion();
            //$sql="SELECT * FROM tm_producto WHERE prod_id = ?";
            $prepareQ = ibase_prepare($db, $this->SELECT_x_id);  
            $Q=ibase_execute($prepareQ, $prod_id);// sustituye la ? del query por $prod_id
            return  $this->generarDataset($Q);// array de objetos o de arrays
        }

        public function get_producto_x_nom($prod_nom){
            $db= parent::conexion();
            //$sql="SELECT * FROM tm_producto WHERE prod_id = ?";
            $prepareQ = ibase_prepare($db, $this->SELECT_x_nom);  
            $Q=ibase_execute($prepareQ, $prod_nom);// sustituye la ? del query por $prod_id
            return  $this->generarDataset($Q);// array de objetos o de arrays
        }
        
        public function insert_producto($prod_nom){
            $db= parent::conexion();
            $prepareQ = ibase_prepare($db, $this->INSERT_x_nom);  
            return ibase_execute($prepareQ, $prod_nom);// sustituye la ? del query por $prod_id
            //return $this->get_producto_x_nom($prod_nom);
        }


        public function insert_producto_backup($prod_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_producto (prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }        


        public function update_producto($prod_id,$prod_nom){
            $db= parent::conexion();
            $prepareQ = ibase_prepare($db, $this->UPDATE_x_id);  
            return ibase_execute($prepareQ, $prod_nom, $prod_id);// sustituye la ? del query por $prod_id
            //return $resultado=$sql->fetchAll();
        }
        public function update_producto_backup($prod_id,$prod_nom){
            $conectar= parent::conexion();
            $sql="UPDATE tm_producto
                SET
                    prod_nom=?,
                    fech_modi=current_timestamp
                WHERE
                    prod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_nom);
            $sql->bindValue(2,$prod_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function delete_producto($prod_id){
            $db= parent::conexion();
            $sql="DELETE FROM tm_producto 
                WHERE prod_id = ?";
            $prepareQ = ibase_prepare($db, $sql);  
            return ibase_execute($prepareQ, $prod_id);// sustituye la ? del query por $prod_id
        }

        public function delete_producto_backup($prod_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_producto
                SET
                    est=0,
                    fech_elim=now()
                WHERE
                    prod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        private function cerrarConexion(){
            if($this->Q){
                ibase_free_result($this->Q); 
                ibase_free_query($this->Q);
            }	
            parent::desconectar();
        }


    }
?>
        