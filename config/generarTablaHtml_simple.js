
// ESTO ES UN CONTROLADOR SIMPLE QUE GENERA ELEMENTO TABLE LIGADO A UN OBJETO 
        
function generarTablaHtml_simple(datos_){
/* 
    datos_=
    {
            "nCampos":3,
        "campos":["PROD_ID","PROD_NOM","FECH_CREA"],
            "tipos":["INTEGER:4","VARCHAR:100","TIMESTAMP:8"],
            "alias":["ID","NOMBRE","FEHO_CREACION"],
            "relation":["TM_PRODUCTO","TM_PRODUCTO","TM_PRODUCTO"],
        datos:[[1,"producto1","28/12/2023, 12:00"],[2,"producto2","28/12/2023, 12:01"]]
    }
        
    ==>>
    
      
    <thead>
        <tr> 
            <th index=0>PROD_ID</th> 
            <th index=1>PROD_NOM</th> 
            <th index=2>FECH_CREA</th> 
        </tr>
    </thead>
    <tbody>
        <tr index=0> 
            <td>1</td> 
            <td>producto1</td> 
            <td>28/12/2023, 12:00</td> 
        </tr>
        <tr index=1> 
            <td>2</td> 
            <td>producto2</td> 
            <td>28/12/2023, 12:01</td> 
        </tr>
    </tbody>
    
*/
    const _ICONO_='<i class="material-icons" style="font-size:14px;">_NOMBRE_ICONO_</i>';
    const _ICONO_thumb_up=_ICONO_.replace("_NOMBRE_ICONO_", 'check');
    const _ICONO_thumb_down=_ICONO_.replace("_NOMBRE_ICONO_", 'cancel');
    const _ICONO_refresh=_ICONO_.replace("_NOMBRE_ICONO_", 'refresh');
    const _BOTONES_EDICION_REGISTRO_=`<button>refresh ${_ICONO_refresh}</button><button>commit ${_ICONO_thumb_up}</button><button onclick='btnCancel(event);'>${_ICONO_thumb_down} cancel</button>`;
    const _BOTONES_EDICION_TODO_=`<button>refresh ${_ICONO_refresh}</button><button>commit ${_ICONO_thumb_up}</button><button onclick='btnCancelTodo(event);'>${_ICONO_thumb_down} cancel</button>`;


    var cabecera_="";
    var cuerpo_="";

//generar cabecera ------------------------------------------
    cabecera_="<tr>";
    cabecera_+=`<th>${_BOTONES_EDICION_TODO_}</th>`
    datos_.alias.forEach( (Ltitulo,index) => cabecera_+=`<th index=${index}>${Ltitulo}</th>` );
    cabecera_+="</tr>";

//generar cuerpo ------------------------------------------ thumb_down

    cuerpo_="";
    datos_.datos.forEach( (Lregistro,index) => {
        //let registro_=`<tr index=${index} onclick='rowOnclick(event);' ondblclick='rowOnDblclick(event);'>`; // funcion al pulsar en una fila
        let registro_=`<tr index=${index} onclick='rowOnclick(event);'>`; // funcion al pulsar en una fila
        registro_+=`<td>${_BOTONES_EDICION_REGISTRO_}</td>`
        Lregistro.forEach( (Ldato,index_td) => {
            //registro_+=`<td onblur="onblurFunction(event);'>${Ldato}</td>`;
            registro_+=`<td  index=${index_td} ondblclick='cellOnDblclick(event);'>${Ldato}</td>`;
        } );
        registro_+="</tr>";
        cuerpo_+=registro_;
    });

    return`<thead>${cabecera_}</thead><tbody id="body1">${cuerpo_}</tbody><tfoot>${cabecera_}</tfoot>`;
   
    /*
    document.getElementById("myTable").innerHTML=tabla_;
    new DataTable('#myTable');
    */
} // function generarTablaHtml

/* ************** GESTION DE COLORINES EN LA TABLA: ELEMENTOS EDITADOS Y EN EDICION **************** */
function cancelar(aux_){
    if(aux_){
        aux_.forEach(elemento_td=>{ 
            var valorOriginal=elemento_td.getAttribute("valorOriginal")
            if(valorOriginal)
                elemento_td.innerHTML=valorOriginal;
            elemento_td.removeAttribute("valorOriginal");
            elemento_td.removeAttribute("edited");
        })
    }
}
function btnCancelTodo(event){
    //console.log('btnCancel');
    var aux_=event.currentTarget.parentNode.parentNode.parentNode.parentNode.querySelectorAll('td'); //  elemento table
    if(aux_)
        cancelar(aux_);
}
function btnCancel(event){
    //console.log('btnCancel');
    var aux_=event.currentTarget.parentNode.parentNode.querySelectorAll('td');//  elemento tr
    if(aux_)
        cancelar(aux_);
}

var indexFilaAnterior_=null;
var indexcolumnaAnterior_=null;

function rowOnclick(event){
    var indexFila_=event.currentTarget.getAttribute("index"); // event.currentTarget == el elemento tr
    var indexColumna_=event.target.getAttribute("index");     // event.target == el elemento td

    console.log('fila='+indexFila_+', columna='+indexColumna_)

    function td_edited(){
        try {
            //if(_td_Target_Edicion.innerHTML!=_td_Target_Valor) // el innerHTML ha sido modificado
            if(_td_Target_Edicion.innerHTML!=_td_Target_Edicion.getAttribute("valorOriginal")) // el innerHTML ha sido modificado
                _td_Target_Edicion.setAttribute("edited",true);

                
            
            //_td_Target_Edicion.parentNode.children.forEach(e=>e.removeAttribute("contenteditable")) ;
/* 
            if(document.querySelector("td[contenteditable]"))
                document.querySelector("td[contenteditable]").removeAttribute("contenteditable");
     */ 
            _td_Target_Edicion.removeAttribute("contenteditable");
            //_td_Target_Edicion.removeAttribute("valorOriginal");
            //_td_Target_Valor=null;
            _td_Target_Edicion=null;
        } catch (error) {
            console.log('td_edited():  '+error.message)
        }
    
    }//function td_edited

    try{
        if(indexFilaAnterior_!=indexFila_){
            Array.from(event.currentTarget.parentNode.children).forEach( e=>e.removeAttribute("seleccionado"));
            event.currentTarget.setAttribute("seleccionado",true);
            if(_td_Target_Edicion)
                td_edited();
        }
        else// estamos en la misma fila ...
        if(indexcolumnaAnterior_!=indexColumna_){ // pero cambiamos de columna
            if(_td_Target_Edicion)
                td_edited();
        }
        else{}// hemos hecho click en la misma casilla td

    }catch(error){console.log('asdf=  '+error.message)}

    indexFilaAnterior_=indexFila_;
    indexcolumnaAnterior_=indexColumna_;
}

//var _td_Target_Valor=null;
var _td_Target_Edicion=null;
function cellOnDblclick(event){
    //var index_=event.target.getAttribute("index");
    //console.log('cellOnDblclick, index_='+index_);   
    event.target.setAttribute("contenteditable",true);
    if(!event.target.getAttribute("valorOriginal"))
        event.target.setAttribute("valorOriginal",event.target.innerHTML);

    _td_Target_Edicion=event.target;
    //_td_Target_Valor=_td_Target_Edicion.innerHTML;
}
