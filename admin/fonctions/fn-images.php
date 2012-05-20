<?php



function affich_images () {
	$dirname = '../img/upload/';
	$dir = opendir($dirname);
	$ouvreLigne = false; 
	$idImage=0;
	echo '<table id=tableau cellspacing="0" cellspacing="0">';	
	echo '<tr>';
	while($file = readdir($dir)) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
			$idImage++;
			echo "<td id='image_".$idImage."' onmouseover=\"montreImage('".$idImage."', '".$file."');\" onmouseout=cacheImage('".$idImage."')>" .
					"<a href=\"".$dirname.$file."\">".$file."</a> (<a href='?page=suppressionImage&nomImage=$file' title='supprimer $file'>X</a>)</td>";
			if ($idImage % 5==0) {
				$ouvreLigne = true;
			}
			else {
				$ouvreLigne = false;
			}
			if($ouvreLigne) {
				echo "</tr><tr>";
			}	
		}
	}
	echo '</tr>';
	echo '</table>';
	closedir($dir);
}

function supprimeImage($nomImage){
	$dirname = '../img/upload/';
	$dir = opendir($dirname);
	$pathFile = $dirname.$nomImage;
	unlink ($pathFile);
	closedir ($dir);
}

?>
