<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    
</head>
<body>
    hi
    <?php
    require_once("../../config/conexion.php"); 
    require_once("../../Models/Producto.php"); 
    
    $tbProducto=new Producto();

    $prod_nom='otro2e';
    $prod_id=1;
    //$Q=$tbProducto->get_producto();
    //$Q=$tbProducto->get_producto_x_id($prod_id);
   //$tbProducto->insert_producto($prod_nom);
   $Q= $tbProducto->update_producto($prod_id,$prod_nom);  // resultado= 1
   //$Q= $tbProducto->get_producto_x_nom($prod_nom);
   echo($Q); /*
    $R = ibase_fetch_object($Q);
    if($R)
    echo utf8_encode($R->PROD_NOM); // NOMBRE DEL CAMPO SENSIBLE A MAYUSCULAS
    else
    echo utf8_encode('no hay registros'); // NOMBRE DEL CAMPO SENSIBLE A MAYUSCULAS
*/

    $tbProducto->cerrarConexion();

    ?>
    
</body>
</html>