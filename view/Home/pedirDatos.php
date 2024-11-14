    <?php
/*devuelve algo como
[
    {"PROD_ID":1,"PROD_NOM":"producto1","FECH_CREA":"2024-11-13 12:19:34","FECH_MODI":"2024-11-13 19:13:21","FECH_ELIM":null,"EST":1},
    {"PROD_ID":2,"PROD_NOM":"producto2","FECH_CREA":"2024-11-13 23:04:41","FECH_MODI":null,"FECH_ELIM":null,"EST":1}
] 
*/
header('Content-Type: application/json');

    require_once("../../models/conexionFB.php"); 
    
    $peticion=new conexionFB();
    /*
    $serverData=$peticion->serverinfo();
    echo "serverData: ";
    var_dump($serverData);
    echo json_encode($serverData);

    $SQL_sentence="SELECT * FROM tm_producto";
    $SQL_sentence="SELECT * FROM HOSPITALES a WHERE idhospital=2";
    */
    $dataSet=null;
    if($_REQUEST['query']){
        $SQL_sentence=htmlspecialchars($_REQUEST['query']);// htmlspecialchars($_GET["name"])
        $dataSet=$peticion->executeSQL($SQL_sentence);
    }
    //echo $SQL_sentence;
    
    if($dataSet){
        //var_dump($dataSet);
        echo json_encode($dataSet);
    }
    else echo '[]'; 

    ?>

