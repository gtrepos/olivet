<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 100000)){
  if ($_FILES["file"]["error"] > 0){
    echo "Erreur : " . $_FILES["file"]["error"];
  }else{
  	$filename = $_FILES["file"]["name"];
  	$filename_abs = "../../img/upload/" . $filename;

    if (file_exists("../../img/upload/" . $filename )){
      echo "Erreur : " . $filename  . " existe d�j� <a href=\"../produit/formupload.html\">Choisir un autre fichier</a>". "<br />";
    }
    else {
      move_uploaded_file($_FILES["file"]["tmp_name"],$filename_abs );
      echo "'" . $filename . "' t�l�charg� <a href=\"javascript:parent.popupPick('$filename')\">Valider</a> <a href=\"../produit/formupload.html\">Choisir un autre fichier</a>" ;
    }
    
    
  }
}else{
  echo "Erreur : Pas de fichier ou fichier invalide (taille > 100 ko ou format diff�rent de image/gif, image/jpeg, image/pjpeg) <a href=\"../produit/formupload.html\">Choisir un fichier</a>";
}
?>