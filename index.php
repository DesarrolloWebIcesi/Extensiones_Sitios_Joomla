<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" href='css/estilos.css'>
        <script src="js/eventos.js"></script>
    </head>
    <body>
        <div id='content'>
            <article>
              <?php include_once ('view/head.php'); ?>  
                <div id="top_buttons">
                    <div id="first_button"><span>(Este proceso puede tardar varios minutos)</span><br>
                    <input type="button" id="analizar" value="Analizar sitios" onclick="consultar()">
                    </div>
                    <div id="second_button"><br>
                    <input type="button" id="mostrar" value="Mostrar sitios" onclick="mostrar()"> 
                    </div>
                </div>
                <div id="tipo_extensiones">
                    <input type="checkbox" name="extensiones[]"  value='library' checked>  Library
                    <input type="checkbox" name="extensiones[]" value='package' checked>  Package
                    <input type="checkbox" name="extensiones[]" value='component' checked>  Componente
                    <input type="checkbox" name="extensiones[]" value='plugin' checked>  Plugin
                    <input type="checkbox" name="extensiones[]" value='template' checked>  Plantilla
                    <input type="checkbox" name="extensiones[]" value='module' checked>  Modulo
                    <input type="checkbox" name="extensiones[]" value='language' checked>  Lenguaje <br>
                      <input type="checkbox" id="check_joomla">  Ocultar extensiones del core de Joomla
                </div>
                <div id="response">
                  
                </div>
               
                 <?php include_once ('view/footer.php'); ?>
            </article>
        </div>
    </body>
</html>

