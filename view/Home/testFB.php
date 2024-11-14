<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    
</head>
<body>
    
    <?php
    require_once("../../config/conexion.php"); 
    require_once("../../Models/Producto.php"); 
    
    $tbProducto=new Producto();
    $serverData=$tbProducto->serverinfo();
    echo "serverData: ";
    var_dump($serverData);
    echo json_encode($serverData);

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
        var_dump($dataSet);
        echo json_encode($dataSet);

    }
    else
    echo utf8_encode('no hay registros'); // NOMBRE DEL CAMPO SENSIBLE A MAYUSCULAS
 /**/

    //$tbProducto->cerrarConexion();

    ?>
    
</body>
</html>