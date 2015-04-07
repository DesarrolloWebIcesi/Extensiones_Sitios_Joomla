function crearXMLHttpRequest()
{
    var xmlHttp = null;
    if (window.ActiveXObject)
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    else
    if (window.XMLHttpRequest)
        xmlHttp = new XMLHttpRequest();
    return xmlHttp;
}


function consultar()
{
    var boton = document.getElementById('analizar');
    var boton2 = document.getElementById('mostrar');
    var respuesta = document.getElementById("response");
    if (boton.style.background !== 'rgb(238, 238, 238)') {
        boton.style.background = "#eee";
        boton.style.color = "#aaa";
        boton2.style.background = "#eee";
        boton2.style.color = "#aaa";
        conexion = crearXMLHttpRequest();
        conexion.onreadystatechange = function() {
            if (conexion.readyState == 4)
            {
                respuesta.innerHTML = conexion.responseText;
                boton.style.background = "#0061AA";
                boton.style.color = "#fff";
                boton2.style.background = "#0061AA";
                boton2.style.color = "#fff";
            }
            else
            {
                respuesta.innerHTML = 'Cargando... por favor espere el proceso puede tardar algunos minutos';
                // respuesta.innetHTML = conexion.responseText;
            }
        };
        conexion.open('GET', 'controller/listar.php', true);
        conexion.send(null);
    }
}

function mostrar()
{
    var boton = document.getElementById('analizar');
    var boton2 = document.getElementById('mostrar');
    var respuesta = document.getElementById("response");
    if (boton2.style.background !== 'rgb(238, 238, 238)') {
        boton.style.background = "#eee";
        boton.style.color = "#aaa";
        boton2.style.background = "#eee";
        boton2.style.color = "#aaa";
        conexion = crearXMLHttpRequest();
        conexion.onreadystatechange = function() {
            if (conexion.readyState == 4)
            {
                respuesta.innerHTML = conexion.responseText;
                boton.style.background = "#0061AA";
                boton.style.color = "#fff";
                boton2.style.background = "#0061AA";
                boton2.style.color = "#fff";
            }
            else
            {
                respuesta.innerHTML = 'Cargando...';
                // respuesta.innetHTML = conexion.responseText;
            }
        };
        conexion.open('GET', 'controller/listar_sitios.php', true);
        conexion.send(null);
    }
}

function listar_extensiones(base)
{
    var tipos=document.getElementsByName('extensiones[]');
    var array_tipos = new Array();
    var contador=0;
    var include= true;
    for (var i=0; i<tipos.length;i++){
        if(tipos[i].checked==true){
            array_tipos[contador]= tipos[i].value;
            contador++
        }
    }
   
   var ext_core=document.getElementById('check_joomla');
   if (ext_core.checked!=true){
       include=false;
   }
    window.open('view/componentes.php?base='+base+'&array='+array_tipos+'&include='+include);
}