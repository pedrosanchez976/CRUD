<?php
    class Conectar{
        protected $dbh;
        protected $dbusuario="SYSDBA";
        protected $dbpassword="hola";
        protected $serverFB = 'localhost/3050';
        protected $dbHospitales = 'localhost/3050:D:/movialnorte/Televisores/DBs/hospitales.fdb';

        protected function Conexion(){
            try{
                //$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=crud2","root","");
                $this->dbh =ibase_connect($this->dbHospitales, $this->dbusuario, $this->dbpassword);	
                return $this->dbh;
            }catch(Exception $e){
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        protected function set_names(){
			//return $this->dbh->query("SET NAMES 'utf8'");
        }

        protected function desconectar(){
			
            if($this->dbh){
                ibase_close($this->dbh);
                //ibase_free_result($Q);
                $this->dbh=null;
            }	
        }

        protected function generarDataset($Q){
            $dataSet=[];//=Array();  será un array de arrays o de objetos

            //while ($R = ibase_fetch_row   ($Q))   // ibase_fetch_row devuelve array indexado, solo los valores, no aparece nombre de los campos $R[0]  [[1,"producto1","2024-11-13 12:19:34"],[2,"producto2","2024-11-13 23:04:41"]]
			//while ($R = ibase_fetch_assoc ($Q))   // ibase_fetch_assoc devuelve array asociativo: con acceso no por indice sino propiedad cualificado, como un objeto...:  $R['PROD_NOM']     [{"PROD_ID":1,"PROD_NOM":"producto1","FECH_CREA":"2024-11-13 12:19:34"},{"PROD_ID":2,"PROD_NOM":"producto2","FECH_CREA":"2024-11-13 23:04:41"}]
			while ($R = ibase_fetch_object($Q))   // ibase_fetch_object devuelve objetos, (stdClass)...:  $R->PROD_NOM                                    [{"PROD_ID":1,"PROD_NOM":"producto1","FECH_CREA":"2024-11-13 12:19:34"},{"PROD_ID":2,"PROD_NOM":"producto2","FECH_CREA":"2024-11-13 23:04:41"}]
                $dataSet[]=$R;

            return $dataSet;// array de arrays o de objetos
        }    


        public function serverinfo(){
            $serverData=[];
            if (($service = ibase_service_attach($this->serverFB, $this->dbusuario, $this->dbpassword)) != FALSE)
            {
                // Successfully attached.
                // Output the info
                $serverData["version"]=         ibase_server_info($service, IBASE_SVC_SERVER_VERSION) ;
                $serverData["implementation"]=  ibase_server_info($service, IBASE_SVC_IMPLEMENTATION);
                //$serverData["users"]=   print_r(ibase_server_info($service, IBASE_SVC_GET_USERS), true);
                $serverData["users"]=           ibase_server_info($service, IBASE_SVC_GET_USERS);
                $serverData["directory"]=       ibase_server_info($service, IBASE_SVC_GET_ENV);
                $serverData["lockPath"]=        ibase_server_info($service, IBASE_SVC_GET_ENV_LOCK);
                $serverData["libPath"]=         ibase_server_info($service, IBASE_SVC_GET_ENV_MSG);
                $serverData["userdbPath"]=      ibase_server_info($service, IBASE_SVC_USER_DBPATH);
                $serverData["establishedConnections"]=ibase_server_info($service, IBASE_SVC_SVR_DB_INFO);

                // Detach from server (disconnect)
                ibase_service_detach($service);
        
            }
            return $serverData;
/*
$serverData----------------------------------
{"version":"WI-V2.1.7.18553 Firebird 2.1","implementation":"Firebird\/x86-64\/Windows NT","users":[{"user_name":"SYSDBA","first_name":"Sql","middle_name":"Server","last_name":"Administrator","user_id":0,"group_id":0}],"directory":"C:\\Program Files\\Firebird\\Firebird_2_1\\","lockPath":"C:\\Program Files\\Firebird\\Firebird_2_1\\","libPath":"C:\\Program Files\\Firebird\\Firebird_2_1\\","userdbPath":"C:\\Program Files\\Firebird\\Firebird_2_1\\security2.fdb","establishedConnections":{"attachments":1,"databases":1,"0":"D:\\MOVIALNORTE\\TELEVISORES\\DBS\\HOSPITALES.FDB"}}

array (size=8)
  'version' => string 'WI-V2.1.7.18553 Firebird 2.1' (length=28)
  'implementation' => string 'Firebird/x86-64/Windows NT' (length=26)
  'users' => 
    array (size=1)
      0 => 
        array (size=6)
          'user_name' => string 'SYSDBA' (length=6)
          'first_name' => string 'Sql' (length=3)
          'middle_name' => string 'Server' (length=6)
          'last_name' => string 'Administrator' (length=13)
          'user_id' => int 0
          'group_id' => int 0
  'directory' => string 'C:\Program Files\Firebird\Firebird_2_1\' (length=39)
  'lockPath' => string 'C:\Program Files\Firebird\Firebird_2_1\' (length=39)
  'libPath' => string 'C:\Program Files\Firebird\Firebird_2_1\' (length=39)
  'userdbPath' => string 'C:\Program Files\Firebird\Firebird_2_1\security2.fdb' (length=52)
  'establishedConnections' => 
    array (size=3)
      'attachments' => int 1
      'databases' => int 1
      0 => string 'D:\MOVIALNORTE\TELEVISORES\DBS\HOSPITALES.FDB' (length=45)


{"version":"WI-V2.1.7.18553 Firebird 2.1","implementation":"Firebird\/x86-64\/Windows NT","users":"Array\n(\n [0] => Array\n (\n [user_name] => SYSDBA\n [first_name] => Sql\n [middle_name] => Server\n [last_name] => Administrator\n [user_id] => 0\n [group_id] => 0\n )\n\n)\n","directory":"C:\\Program Files\\Firebird\\Firebird_2_1\\","lockPath":"C:\\Program Files\\Firebird\\Firebird_2_1\\","libPath":"C:\\Program Files\\Firebird\\Firebird_2_1\\","userdbPath":"C:\\Program Files\\Firebird\\Firebird_2_1\\security2.fdb","establishedConnections":"Array\n(\n [attachments] => 1\n [databases] => 1\n [0] => D:\\MOVIALNORTE\\TELEVISORES\\DBS\\HOSPITALES.FDB\n)\n"}
*/

        }//serverinfo()


        protected function generarMetadataQuery($Q){
            //$Q = ibase_query("SELECT * FROM tablename");
            $metadatos=[];
            $coln = ibase_num_fields($Q); //ibase_num_params
            $metadatos["nCampos"]=$coln;

        
            $col_info=[];
            $campos=[];
            $tipos=[];
            $alias=[];
            $relation=[];
            for ($i = 0; $i < $coln; $i++) {
                $col_info = ibase_field_info($Q, $i);//ibase_param_info  Return the number of parameters in a prepared query
                $campos[]=$col_info['name'];
                $tipos[]=$col_info['type'].":".$col_info['length']; // length en bytes
                $alias[]=$col_info['alias']; // si se ha accedido a un campo con un alias::  "SELECT fech_crea as fehoCreacion from ..."
                $relation[]=$col_info['relation']; // si es un join, nos dice la tabla de la que se extrajo información para este campo concreto
            }
            $metadatos["campos"]=$campos;
            $metadatos["tipos"]=$tipos;
            $metadatos["alias"]=$alias;
            $metadatos["relation"]=$relation;
            return $metadatos;
            //{"nCampos":3,"campos":["PROD_ID","PROD_NOM","FECH_CREA"],"tipos":["INTEGER:4","VARCHAR:100","TIMESTAMP:8"],"alias":["PROD_ID","PROD_NOM","FEHOCREACION"],"relation":["TM_PRODUCTO","TM_PRODUCTO","TM_PRODUCTO"]}
        }
    }
    /*

{
    "fehoGeneracion":"14/11/2024, 11:48:41:504",
    "fehoPeticion":"14/11/2024, 11:48:40:885",
    "user":"pedro",
    "descripcion":"respuesta SQL para user pedro",
    "hospital":"111-Cruces Bilbao-Bilbao",
    "sql":"select idHabitacion, IP from habitaciones",
    "exito":true,
    "nCampos":2,
    "nRegistros":695,
    "campos":["IDHABITACION","IP"],
    "tipos":["string:10","string:100"],
    "datos":[
        ["M08","192.168.1.31"],
        ["121-1","192.168.1.55"],
        ...
    ]
}







RESULTADO DE function generarDataset

---------------------------------------------
---------------ibase_fetch_row---------------    
    array (size=2)
  0 => 
    array (size=3)
      0 => int 1
      1 => string 'producto1' (length=9)
      2 => string '2024-11-13 12:19:34' (length=19)
  1 => 
    array (size=3)
      0 => int 2
      1 => string 'producto2' (length=9)
      2 => string '2024-11-13 23:04:41' (length=19)

json_encode::::::::::::::::::::::
[[1,"producto1","2024-11-13 12:19:34"],[2,"producto2","2024-11-13 23:04:41"]]


---------------------------------------------
--------------ibase_fetch_assoc--------------    
    array (size=2)
  0 => 
    array (size=3)   //array asociativo: accesible por nombre de la propiedad, en vez de indexacion
      'PROD_ID' => int 1
      'PROD_NOM' => string 'producto1' (length=9)
      'FECH_CREA' => string '2024-11-13 12:19:34' (length=19)
  1 => 
    array (size=3)
      'PROD_ID' => int 2
      'PROD_NOM' => string 'producto2' (length=9)
      'FECH_CREA' => string '2024-11-13 23:04:41' (length=19)

json_encode::::::::::::::::::::::
[{"PROD_ID":1,"PROD_NOM":"producto1","FECH_CREA":"2024-11-13 12:19:34"},{"PROD_ID":2,"PROD_NOM":"producto2","FECH_CREA":"2024-11-13 23:04:41"}]
    

---------------------------------------------
-------------ibase_fetch_object--------------    
array (size=2)
  0 => 
    object(stdClass)[2]
      public 'PROD_ID' => int 1
      public 'PROD_NOM' => string 'producto1' (length=9)
      public 'FECH_CREA' => string '2024-11-13 12:19:34' (length=19)
  1 => 
    object(stdClass)[3]
      public 'PROD_ID' => int 2
      public 'PROD_NOM' => string 'producto2' (length=9)
      public 'FECH_CREA' => string '2024-11-13 23:04:41' (length=19)

json_encode::::::::::::::::::::::
[{"PROD_ID":1,"PROD_NOM":"producto1","FECH_CREA":"2024-11-13 12:19:34"},{"PROD_ID":2,"PROD_NOM":"producto2","FECH_CREA":"2024-11-13 23:04:41"}]
    */
?>