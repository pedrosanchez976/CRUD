<?php
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try{
                $dbusuario="SYSDBA";
                $dbpassword="hola";
                $dbHospitales = 'localhost/3050:D:/movialnorte/Televisores/DBs/hospitales.fdb';
                //$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=crud2","root","");
                $conectar = $this->dbh =ibase_connect($dbHospitales, $dbusuario, $dbpassword);	
                return $conectar;
            }catch(Exception $e){
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function set_names(){
			//return $this->dbh->query("SET NAMES 'utf8'");
        }

        public function desconectar(){
			
            if($this->dbh){
                ibase_close($this->dbh);
                //ibase_free_result($Q);
            }	
        }

    }
?>