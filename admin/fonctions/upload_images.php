<?php

if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")) 
	&& ($_FILES["file"]["size"] < 100000)){
  if ($_FILES["file"]["error"] > 0){
    echo "Erreur : " . $_FILES["file"]["error"];
  }else{
  	$filename = $_FILES["file"]["name"];
  	$filename_abs = "../../img/upload/" . $filename;

    if (file_exists("../../img/upload/" . $filename )){
      echo utf8_decode("Erreur : " . $filename  . " existe d&eacute;j&agrave; <a href=\"../" . $POST['retour'] . "/formupload.html\">Choisir un autre fichier</a>". "<br />");
    }
    else {
      move_uploaded_file($_FILES["file"]["tmp_name"],$filename_abs );
      echo utf8_decode("'" . $filename . "' t&eacute;l&eacute;charg&eacute; <a href=\"javascript:parent.popupPick('$filename')\">Valider</a> <a href=\"../" . $POST['retour'] . "/formupload.html\">Choisir un autre fichier</a>") ;
    } 
    
  }
}else{
  echo utf8_decode("Erreur : Pas de fichier ou fichier invalide (taille > 100 ko ou format diff&eacute;rent de image/gif, image/jpeg, image/pjpeg) <a href=\"../" . $POST['retour'] . "/formupload.html\">Choisir un fichier</a>");
}
?>