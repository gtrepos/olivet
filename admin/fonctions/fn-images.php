<?php



function affich_images () {
	$dirname = '../img/upload/';
//	$dir = opendir($dirname);
	$ouvreLigne = false; 
	$idImage=0;
	echo '<table id=tableau cellspacing="0" cellspacing="0">';	
	echo '<tr>';
	
//	$tabFiles = readdir($dir);
//	sort($tabFiles);
	
	//Exemple d'utilisation
	$T_fich = lstDir($dirname,'DESC','nom');
	
	print_r($T_fich);
	
//	while($file = $T_fich) {
//		
////		echo $file;
//		
////		if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
////			$idImage++;
////			echo "<td id='image_".$idImage."' onmouseover=\"montreImage('".$idImage."', '".$file."');\" onmouseout=cacheImage('".$idImage."')>" .
////					"<a href=\"".$dirname.$file."\">".$file."</a> (<a href='?page=suppressionImage&nomImage=$file' title='supprimer $file'>X</a>)</td>";
////			if ($idImage % 5==0) {
////				$ouvreLigne = true;
////			}
////			else {
////				$ouvreLigne = false;
////			}
////			if($ouvreLigne) {
////				echo "</tr><tr>";
////			}	
////		}
//	}
	echo '</tr>';
	echo '</table>';
//	closedir($dir);
}

function lstDir($dir,$ordre='ASC',$type='nom') {
    $handle = opendir($dir);
    while ($file = readdir($handle)) {
        $T['nom'][] = $file;
        $T['mtime'][] = filemtime($dir.$file);
        $T['atime'][] = fileatime($dir.$file);
        $T['size'][] = filesize($dir.$file);
        $T['type'][] = filetype($dir.$file);
    }
    closedir($handle);
    
    if ($type!='nom' && $type!='mtime' && $type!='atime'
         && $type!='size' && type!='type')
        $type = 'nom';

    if ($ordre=='DESC') $fct = 'arsort';
    else $fct = 'asort';

    $fct($T[$type]);

    $i=0;
    while (list ($key, $val) = each ($T[$type])) {
        $Tr[$i]['nom'] = $T['nom'][$key];
        $Tr[$i]['mtime'] = $T['mtime'][$key];
        $Tr[$i]['atime'] = $T['atime'][$key];
        $Tr[$i]['size'] = $T['size'][$key];
        $Tr[$i]['type'] = $T['type'][$key];
        $i++;
    }
    return $Tr;
}


function supprimeImage($nomImage){
	$dirname = '../img/upload/';
	$dir = opendir($dirname);
	$pathFile = $dirname.$nomImage;
	unlink ($pathFile);
	closedir ($dir);
}

?>
