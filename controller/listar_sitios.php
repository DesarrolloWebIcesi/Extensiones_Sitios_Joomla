<?php $fp = fopen("../archivo.txt", "r"); ?>
<?php $contador=0; ?>
<table id="table_res" border="1">
    <tr>
        <td>
            Listar
        </td>
        <td>
            Nombre del Sitio
        </td>
        <td>
            URL
        </td>
    </tr>
    <?php while (!feof($fp)): ?>
    
    <tr>
       
        <?php $linea = fgets($fp); ?>
        <?php $array_linea=  explode("&&", $linea);?>
        <?php $url= $array_linea[0]?>
        <?php include '../config/config.php' ?>
        <?php $url= str_replace($direc_joom, $server_url, $url) ?> 
        <?php $url= str_replace('configuration.php', '', $url) ?> 
        <?php $base_datos= $array_linea[1]?>
        <?php $nombre= $array_linea[2]?>
         <td>
             <input id="but_listar" type="button" value="listar" onclick="listar_extensiones('<?php echo $base_datos ?>')"> 
        </td>
        <td>
        <?php print $nombre ?>
        </td>
        <td>
            <a href="<?php echo $url ?>" target="_blank"><?php print $url ?></a>
        </td>
    </tr>
    <?php $contador++?>
    <?php endwhile; ?>    
    <?php fclose($fp); ?>
</table>

