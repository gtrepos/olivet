<?php
function affich_images () {
	$dirname = '../img/upload/';
	$dir = opendir($dirname); 
	$ouvreLigne = false; 
	$idImage=0;
	echo '<tr>';
	while($file = readdir($dir)) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file)){
			$idImage++;
			echo "<td id='image_".$idImage."' onmouseover=survolLigne('image_".$idImage."') onmouseout=restaureLigne('image_".$idImage."')><img src=\"".$dirname.$file."\"><p><a href=\"".$dirname.$file."\">".$file."</a></p></td>";
			
			if ($idImage % 4==0) {
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
	closedir($dir);
}

?>
