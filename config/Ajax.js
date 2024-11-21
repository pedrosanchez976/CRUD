
/*
https://xhr.spec.whatwg.org/
https://developer.mozilla.org/es/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest

https://developer.mozilla.org/es/docs/Web/HTTP/CORS  #solicitudes_verificadas

ejemplo de envío de un POST:

    var formData = new FormData();
    formData.append("username", "Groucho");
    formData.append("accountnum", 123456);
    formData.append("afile", fileInputElement.files[0]);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "http://foo.com/submitform.php");
    xhr.send(formData);


// ************************************************
Retrieving a FormData object from an HTML form
To construct a FormData object that contains the data from an existing <form>, specify that form element when creating the FormData object:

newFormData = new FormData(someFormElement);

For example:
    var formElement = document.getElementById("myFormElement");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submitform.php");
    xhr.send(new FormData(formElement));

*/


/*
    function cb(Lxhr){
        try {
            
            if(Lxhr.status == 200){
                var datos=JSON.parse(Lxhr.responseText);
                var url_=datos.datos;
                //var error=peticionAjax("GET", url_ , callBack_, null, true, null, null);
                var error=peticionAjax("GET", url_ , callBack_);
                if(error) console.log( 'peticionAjax 2 ERROR: '+ error);
            }
            else{
                console.log('response status= '+ Lxhr.status) ;
            }
            
        } catch (err) {
                console.log('ERROR funcion cb(Lxhr): '+ err );
        }
    }


// se espera que se responda con un objeto JSON, que se asignará a Lvariable
EJEMPLO DE PETICION:
var error=peticionAjax("GET",'https://psh.sytes.net/hBrowser/appComun/AjaxTEST.data.js', cb, null, true, "pedro", "Silvia_976");



CUIDADO CON TEMAS DE POLITICAS CORS: cabecera 
    Access-Control-Allow-Origin * 
para APIS WEB públicas
*/

function peticionAjax(Lmetodo, Lurl, LcbFunction, Ldata,  Lasync, Lusername, Lpassword, LdatoCallback){
    // LdatoCallback: es referencia a un dato que deseamos pasar a la funcion callback, LcbFunction, a través del objeto xhr
    try{ 

/*
xhr.onprogress = onProgress;
xhr.onload = onLoad;
xhr.onerror = onError;

function onProgress(e) {
  var percentComplete = (e.position / e.totalSize)*100;
  // ...
}

function onError(e) {
  alert("Error " + e.target.status + " occurred while receiving the document.");
}
*/

        var xhr = new XMLHttpRequest();
        xhr.withCredentials = Lusername; // es un booleano
        Lasync=Lasync|| true;
        //xhr.timeout=2000;

        xhr.datoCallback = LdatoCallback; // es referencia a un dato que deseamos pasar a la funcion callback, LcbFunction, a través del objeto xhr
       
        //xhr.cbFunction=LcbFunction; // la funcion que se invocará cuando se haya recibido la respuesta
        //xhr.onreadystatechange=CBfuncionAjax;
        //xhr.addEventListener("readystatechange", CBfuncionAjax);
	    //xhr.ontimeout = function(){;};
        //xhrq.onload = function(){;};   // parece evento igual a onreadystatechange
        xhr.onreadystatechange= function() {
            //https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState   CODIGOS DE readyState
            if (this.readyState === 4) // DONE
                if(LcbFunction)
                    LcbFunction(this);
             
        };
       //xhr.open("GET", _AEMET_ + aemet_inventarioEstaciones+"?api_key="+_APIKey_);
       //open(method: string, url: string | URL, async: boolean, username?: string | null, password?: string | null): void;
       //xhr.open("GET", Lurl, Lasync, Lusername, Lpassword);
       xhr.open(Lmetodo, Lurl, Lasync, Lusername, Lpassword);
       // AQUI LAS CABECERAS NECESARIAS ------------------------
       if(Ldata)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       //xhr.setRequestHeader("cache-control", "no-cache");
       //xhr.setRequestHeader("cache-control", "no-cache");
       xhr.send(Ldata);

/*
para POST: SETEAR CABECERAS:
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');     application/xml,  multipart/form-data, text/plain
PARA RESPUESTAS:
xhr.setRequestHeader('Accept','application/javascript');  ¿¿¿¿????? ERROR
*/
       // setRequestHeader ha de invocarse despues de open
       //xhr.setRequestHeader("cache-control", "no-cache");


       //https://stackoverflow.com/questions/21850454/how-to-make-xmlhttprequest-cross-domain-withcredentials-http-authorization-cor
       /*var Luser='pedro';
       var Lpass='xxxxxxx';
       xhr.setRequestHeader( 'Authorization', 'Basic ' + btoa( Luser + ':' + Lpass ) )
       */
       //var Ldata = null;


       //log_.innerHTML+='<br> fin peticionAjax';

    } catch (err) {  return err.message; };
   
}
/*
Access to XMLHttpRequest at 'https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/horaria/08113?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJwZ
WRyb3NhbmNoZXo5NzZAZ21haWwuY29tIiwianRpIjoiYzVhOTBiYjItMDEzYS00ZmEwLTlhMmQtYzc1ZWY3N2EzMjUxIiwiaXNzIjoiQUVNRVQiLCJpYXQiOjE2Mzg1OTE0MzEsInVzZXJJZCI
6ImM1YTkwYmIyLTAxM2EtNGZhMC05YTJkLWM3NWVmNzdhMzI1MSIsInJvbGUiOiIifQ.fYOW4NNb4-WSHgnMYj6eHiuCL2Ce2oO8RRgaHWJpBZ0' 
from origin 'http://192.168.1.8' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.

*/

/* 
PETICION AJAX:
Hypertext Transfer Protocol
    OPTIONS /hBrowser2/appComun/peticionAjaxTEXT.data.js HTTP/1.1\r\n
    Host: hucruces.sytes.net\r\n
    User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0\r\n
    Accept: * /*\r\n
    Accept-Language: es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3\r\n
    Accept-Encoding: gzip, deflate\r\n
=> Access-Control-Request-Method: GET\r\n
    Access-Control-Request-Headers: cache-control\r\n
    Referer: http://psh.sytes.net/\r\n
    Origin: http://psh.sytes.net\r\n
    DNT: 1\r\n
    Connection: keep-alive\r\n
    Sec-GPC: 1\r\n
    \r\n
    [Full request URI: http://hucruces.sytes.net/hBrowser2/appComun/peticionAjaxTEXT.data.js]
    [HTTP request 1/1]
    [Response in frame: 52]

RESPUESTA AJAX
Hypertext Transfer Protocol
    HTTP/1.1 200 OK\r\n
    Date: Fri, 21 Jan 2022 09:30:29 GMT\r\n
    Server: Apache/2.4.39 (Win64) PHP/7.2.18\r\n
    Allow: GET,POST,OPTIONS,HEAD,TRACE\r\n
    Content-Length: 0\r\n
    Keep-Alive: timeout=5, max=100\r\n
    Connection: Keep-Alive\r\n
=> Content-Type: application/javascript\r\n
    \r\n
    [HTTP response 1/1]
    [Time since request: 0.021425000 seconds]
    [Request in frame: 49]
    [Request URI: http://hucruces.sytes.net/hBrowser2/appComun/peticionAjaxTEXT.data.js]

    */