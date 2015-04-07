<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" href='../css/estilos.css'>
    </head>
    <body>

        <?php session_start() ?>
        <?php $controlador = 0 ?>
        <?php if (isset($_GET['base'])): ?>
            <?php $componentes = explode(',', $_GET['array']) ?>
            <?php $base = $_GET['base']; ?>
            <?php $ocultar=$_GET['include']; ?>
            <?php include '../config/config.php'; ?>
            <?php $conexion = mysql_connect($server, $user, $password) or die('Error al intentar conectar al servidor'); ?>
            <?php $bd = @mysql_select_db($base, $conexion) or die('error conexión a ' . $base); ?>
            <?php $query = "SHOW FULL TABLES FROM $base LIKE '%extensions' "; ?>
            <?php $result = mysql_query($query); ?>
            <?php while ($row = mysql_fetch_array($result)): ?>
                <?php $table = $row[0]; ?>
                <?php $table = explode("_", $table); ?>
                <?php if (count($table) == 2): ?>
                    <?php $table_extensions = $row[0]; ?>
                <?php endif ?>
            <?php endwhile ?>

            <div id='reporte'> 
                <div id='logo_pdf'> <a href='export_pdf.php'><img src='../img/pdf.jpg' width='110' height='120'></a></div>
                <div id='logo_excel'> <a href='export_excel.php'><img src='../img/excel.png' width='110' height='120'></a></div>
                <table id="table_res" class="table_res" border="1">
                    <tr>
                        <td>
                            Nombre
                        </td>
                        <td>
                            Tipo
                        </td>
                        <td>
                            Autor
                        </td>
                        <td>
                            Versión
                        </td>
                    </tr>

                    <?php $_SESSION['format_pdf'] = '<table style="border-collapse: collapse; border: 1px solid black; font-size: 10px; font-weight: bold;" >
                    <tr style="text-align: center; background: #00aff0; color:white;">
                        <td style="border: 1px solid black">
                            Nombre
                        </td>
                        <td style="border: 1px solid black">
                            Tipo
                        </td>
                        <td style="border: 1px solid black">
                            Autor
                        </td>
                        <td style="border: 1px solid black">
                            Versión
                        </td>
                    </tr>'; ?>
                    <?php $query = "SELECT manifest_cache FROM " . $table_extensions . " WHERE enabled=1"; ?>
                    <?php $result = mysql_query($query); ?>
                    <?php while ($row = mysql_fetch_array($result)): ?>
                        <?php $information = $row[0]; ?>
                        <?php $information = str_replace('"', "", $information); ?>
                        <?php $information = str_replace('{', "", $information); ?>
                        <?php $information = explode(",", $information); ?>
                        <?php for ($i = 0; $i < count($information); $i++): ?>
                            <?php $information[$i] = explode(":", $information[$i]); ?>
                        <?php endfor ?>
                        <?php for ($i = 0; $i < count($information); $i++): ?>
                            <?php
                            switch ($information[$i][0]):
                                case 'name':
                                    $nombre_extension = $information[$i][1];
                                case 'type':
                                    $tipo = $information[$i][1];
                                case 'author':
                                    $autor = $information[$i][1];
                                case 'version':
                                    $version = $information[$i][1];
                            endswitch;
                            ?>
                        <?php endfor ?>

                        <?php for ($i = 0; $i < count($componentes); $i++): ?>
                            <?php if ($nombre_extension != ""): ?>
                                <?php if ($tipo == $componentes[$i]): ?>
                                    <?php if(!($ocultar=='true' && $autor=='Joomla! Project' )):?>
                                    <?php $controlador++ ?>
                                    <tr>
                                        <td>
                                            <?php print $nombre_extension ?>
                                        </td>
                                        <td>
                                            <?php print $tipo ?>
                                        </td>
                                        <td>
                                            <?php print $autor ?>
                                        </td>
                                        <td>
                                            <?php print $version ?>
                                        </td>
                                    </tr>
                                    <?php if (fmod($controlador, 2) == 1): ?>
                                        <?php $_SESSION['format_pdf'].="<tr style='text-align: center; background: #c7edfc;'>
                                    <td style='border: 1px solid black'>
                                         $nombre_extension 
                                    </td>
                                    <td style='border: 1px solid black'>
                                        $tipo 
                                    </td>
                                    <td style='border: 1px solid black'>
                                        $autor 
                                    </td>
                                    <td style='border: 1px solid black'>
                                         $version
                                    </td>
                                </tr>" ?>
                                    <?php else: ?>
                                  
                                        <?php $_SESSION['format_pdf'].="<tr style='text-align: center; background:#e5f7fd;'>
                                    <td style='border: 1px solid black'>
                                         $nombre_extension 
                                    </td>
                                    <td style='border: 1px solid black'>
                                        $tipo 
                                    </td>
                                    <td style='border: 1px solid black'>
                                        $autor 
                                    </td>
                                    <td style='border: 1px solid black'>
                                         $version
                                    </td>
                                </tr>" ?>
                                    <?php endif ?>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php endfor ?>
                        <?php $nombre_extension = "" ?>
                        <?php $tipo = "" ?> 
                        <?php $autor = "" ?> 
                        <?php $version = "" ?> 
                    <?php endwhile; ?>
                <?php endif ?>
            </table>
            <?php $_SESSION['format_pdf'].="</table>" ?>

        </div>



    </body>
</html>