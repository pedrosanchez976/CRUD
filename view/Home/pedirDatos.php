    <?php
/*devuelve algo como
[
    {"PROD_ID":1,"PROD_NOM":"producto1","FECH_CREA":"2024-11-13 12:19:34","FECH_MODI":"2024-11-13 19:13:21","FECH_ELIM":null,"EST":1},
    {"PROD_ID":2,"PROD_NOM":"producto2","FECH_CREA":"2024-11-13 23:04:41","FECH_MODI":null,"FECH_ELIM":null,"EST":1}
] 
*/
header('Content-Type: application/json');

    require_once("../../config/conexion.php"); 
    require_once("../../Models/Producto.php"); 
    
    $tbProducto=new Producto();
    /*
    $serverData=$tbProducto->serverinfo();
    echo "serverData: ";
    var_dump($serverData);
    echo json_encode($serverData);*/

    $prod_id=2;
    $prod_nom='otro2eeee';
    $dataSet=$tbProducto->get_producto();
    //$dataSet=$tbProducto->get_producto_x_id($prod_id);
    //$dataSet= $tbProducto->get_producto_x_nom($prod_nom);
    //$dataSet=$tbProducto->insert_producto($prod_nom);
   //$dataSet= $tbProducto->update_producto($prod_id,$prod_nom);  // resultado= 1
   //$dataSet= $tbProducto->delete_producto($prod_id);  // resultado= 1
   //echo($dataSet); 

    if($dataSet){
        //var_dump($dataSet);
        echo json_encode($dataSet);
    }
    else echo '[]'; 

    ?>

