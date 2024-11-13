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
        protected $SELECT_todo = "SELECT * FROM tm_producto";
        protected $SELECT_x_id = "SELECT * FROM tm_producto WHERE prod_id = ?";
        protected $SELECT_x_nom = "SELECT * FROM tm_producto WHERE prod_nom = ?";
        protected $INSERT_x_nom = "INSERT INTO tm_producto (prod_id, prod_nom, fech_crea, fech_modi, fech_elim, est) VALUES (NULL, ?, current_timestamp, NULL, NULL, 1);";
        protected $UPDATE_x_id = "UPDATE tm_producto SET prod_nom=?, fech_modi=current_timestamp WHERE prod_id = ?";

        protected $Q;

        public function get_producto(){
            $db= parent::conexion();
            //$sql=$this->SELECT_todo;//"SELECT * FROM tm_producto";  
            return $Q=ibase_query($db, $this->SELECT_todo);
        }


        public function get_producto_x_id($prod_id){
            $db= parent::conexion();
            //$sql="SELECT * FROM tm_producto WHERE prod_id = ?";
            $prepareQ = ibase_prepare($db, $this->SELECT_x_id);  
            return $Q=ibase_execute($prepareQ, $prod_id);// sustituye la ? del query por $prod_id
        }

        public function get_producto_x_nom($prod_nom){
            $db= parent::conexion();
            //$sql="SELECT * FROM tm_producto WHERE prod_id = ?";
            $prepareQ = ibase_prepare($db, $this->SELECT_x_nom);  
            return $Q=ibase_execute($prepareQ, $prod_nom);// sustituye la ? del query por $prod_id
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
            $conectar= parent::conexion();
            $sql="UPDATE tm_producto
                SET
                    est=0,
                    fech_elim=current_timestamp
                WHERE
                    prod_id = ?";
            $prepareQ = ibase_prepare($db, $sql);  
            ibase_execute($prepareQ, $prod_id);// sustituye la ? del query por $prod_id


            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prod_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
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


        public function cerrarConexion(){
            parent::desconectar();
            if($this->Q){
                ibase_free_result($this->Q); 
                ibase_free_query($this->Q);
            }	
        }


    }
?>
        