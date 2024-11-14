<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <script src="./Ajax.js"></script>
    <script>
        function pedirDatos(){
            //console.log("pedirDatos");
            var error=peticionAjax("POST",'http://192.168.1.20/crud/view/home/pedirDatos.php', cb, null, true, "pedro", "Silvia_976");
        }

        function cb(Lxhr){
            try {
                console.log('response status= '+ Lxhr.status) ;
                
                if(Lxhr.status == 200){
                    document.getElementById("divRecepcion").innerHTML=Lxhr.responseText;
                    /*var datos=JSON.parse(Lxhr.responseText);
                    var url_=datos.datos;
                    //var error=peticionAjax("GET", url_ , callBack_, null, true, null, null);
                    var error=peticionAjax("GET", url_ , callBack_);
                    if(error) console.log( 'peticionAjax 2 ERROR: '+ error);*/
                }
                else{
                    //console.log('response status= '+ Lxhr.status) ;
                }
                
            } catch (err) {
                    console.log('ERROR funcion cb(Lxhr): '+ err );
            }
        }
    </script>
    
</head>
<body>
    
<button onclick=pedirDatos();>pedir datos</button>
<h2>DATOS RECIBIDOS:</h2>
<div id="divRecepcion"></div>

 
</body>
</html>