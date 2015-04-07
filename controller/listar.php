<?php

//$rDir=2  listara los directorios
//$rDir=1 listara pero no mostrara su contenido
//$rDir=0 no listara ni mostrara su contenido
function read_dir($dir, $rDir = 0) {

    if (!is_dir($dir)) {
        return false;
    }
    $cDir = dir($dir); //cDir = current dir;
    $dirname = dir_name($dir);


    $aDir[$dirname] = array();
    while (false !== ($file = $cDir->read())) {
        if (($file != ".") && ($file != "..") && ($file != "administrator") && ($file != "cache") && ($file != "components") && ($file != "images") && ($file != "includes") && ($file != "language") && ($file != "libraries") && ($file != "logs") && ($file != "media") && ($file != "modules") && ($file != "plugins") && ($file != "templates") && ($file != "tmp")) {
            $isDir = is_dir($dir . "/" . $file);
            if (($isDir) && ($rDir == 2)) {
                $aDir[$dirname] = array_merge($aDir[$dirname], read_dir($dir . "/" . $file, $rDir));
            } else if (($isDir) && ($rDir > 0)) {
                $aDir[$dirname][$file] = array();
            } else if (!$isDir) {
                if ($file == "configuration.php") {
                    $fileCon = file($dir . "/" . $file);
                    foreach ($fileCon as $indice => $file2) {
                        $posCom = strpos($file2, 'db ');
                        if ($posCom === false) {
                            
                        } else {
                            $line = $file2;
                            $bd = explode("'", $line);
                            if (isset($bd[1])) {
                                $bd = $bd[1];
                            }
                        }
                        $posName = strpos($file2, 'sitename ');
                        if ($posName === false) {
                            
                        } else {
                            $line = $file2;

                            $name = explode("=", $line);

                            $name2 = explode("-", $name[1]);
                            $name2[0] = str_replace("'", "", $name2[0]);
                            $name2[0] = str_replace(";", "", $name2[0]);
                            if (isset($name2[0])) {
                                $name = trim($name2[0]);
                            }
                        }
                    }

                    $aDir[$dirname][] = $dir . "/" . $file;
                    if (isset($bd[1])) {
                        $_SESSION['configuration'][] = $dir . "/" . $file . "&&" . $bd . "&&" . $name;
                       
                    }
                }
            }
        }
    }
    $cDir->close();
    return $aDir;
}

function dir_name($dir) {
    $dir = realpath($dir);
    $pos = strrpos($dir, "\\"); //Windows
    if ($pos === false) {
        $pos = strrpos($dir, "/"); //Linux :)
    }
    $dir = substr($dir, $pos + 1, strlen($dir) - $pos);
    return $dir;
}
include '../config/config.php';
read_dir($direc_joom, 2);
$fp = fopen("../archivo.txt", "w");
foreach ($_SESSION['configuration'] as $nomCampo => $valorCampo) {
    $output = $valorCampo;
    fwrite($fp, $output . PHP_EOL);
}
fclose($fp);
echo "Actualización exitosa!! ";
?>