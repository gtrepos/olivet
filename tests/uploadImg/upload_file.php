<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000)){
  if ($_FILES["file"]["error"] > 0){
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  }else{
  	$filename = $_FILES["file"]["name"];
  	$filename_abs = "../../img/upload/" . $filename;
  	
  	
    echo "Upload: " . $filename  . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("./upload/" . $filename )){
      echo $filename  . " already exists and is erased ". "<br />";
    }
    move_uploaded_file($_FILES["file"]["tmp_name"],$filename_abs );
    echo "Stored in: " . $filename_abs . "<br /><br />";
    
    
    
    //image d'origine
    $imgsize = getimagesize($filename_abs );
    $imgWidth = $imgsize[0];
    $imgHeight = $imgsize[1];
    echo "L'image chargée : ". "<br />";
   	echo "image size :".$imgsize[3]. "<br />";
    echo "<IMG SRC=\"$filename_abs\" $imgsize[3]>". "<br /><br />";
    
    //image coupée
	$little_filename_abs = "./upload/little_" . $filename;
    $imgWidth_little = 40;
    $imgHeight_little = 80;
    $big = imagecreatefromjpeg($filename_abs);
    $little = imagecreatetruecolor($imgWidth_little , $imgHeight_little);
	imagealphablending($little, false);
	imagesavealpha($little, true);
	imagecopy($little, $big, 0, 0,0, 0, $imgWidth_little , $imgHeight_little);	
	imagejpeg($little,$little_filename_abs);
 	$imgsize_little = getimagesize($little_filename_abs );
	echo "L'image coupée (little) : ". "<br />";
 	echo "image size :".$imgsize_little[3]. "<br />";
	echo "<IMG SRC=\"$little_filename_abs\"$imgsize_little[3]>". "<br /><br />";
    
	//image resized
	$rs_filename_abs = "./upload/rs_" . $filename;
    $imgWidth_rs = 80;
    $imgHeight_rs = 95;
    $big2 = imagecreatefromjpeg($filename_abs);
    $rs = imagecreatetruecolor($imgWidth_rs , $imgHeight_rs);
	imagealphablending($rs, false);
	imagesavealpha($rs, true);
	imagecopyresized($rs, $big2, 0, 0,0, 0, $imgWidth_rs , $imgHeight_rs, $imgWidth , $imgHeight);	
	imagejpeg($rs,$rs_filename_abs,100);
 	$imgsize_rs = getimagesize($rs_filename_abs );
	echo "L'image resized (rs) : ". "<br />";
 	echo "image size :".$imgsize_rs[3]. "<br />";
	echo "<IMG SRC=\"$rs_filename_abs\"$imgsize_rs[3]>". "<br /><br />";
  
  }
}else{
  echo "Invalid file";
}
?>

<script type="text/javascript">

function monpopup(){
	window.open("./upload/rs_141.jpg","Window1",
	"menubar=no,width=430,height=360,toolbar=no,location=no,scrollbars=no,status=no,titlebar=no,resizable=no");
}

function popupon(layername){
 valtop=document.body.scrollTop;
 valheight=Math.abs(document.body.clientWidth/2);
 if(valtop<136){valtop=136;}
 document.getElementById(layername).style.visibility = "visible";
 document.getElementById(layername).style.top=valtop+120;
 document.getElementById(layername).style.left=valheight;
 document.getElementById(layername).focus();
}

function popupoff(layername){
 layername.style.height=0;
 layername.style.width=0;
 layername.style.visibility = "hidden";
} 

</script>




<?php echo("L'image resized sur laquelle on clique pour une alerte : ". "<br />")?>
<IMG SRC=<?php echo($rs_filename_abs." ".$imgsize_rs[3])?>  onclick="javascript:alert('coucou');"><br /><br />

<?php echo("L'image resized sur laquelle on clique pour un popup : ". "<br />")?>
<IMG SRC=<?php echo($rs_filename_abs." ".$imgsize_rs[3])?>  onclick="monpopup();"><br /><br />

<?php echo("L'image resized sur laquelle on clique pour le must : ". "<br />")?>
<IMG SRC=<?php echo($rs_filename_abs." ".$imgsize_rs[3])?>  onclick="popupon('divimage');"><br /><br />


<div id="divimage" 
style="position: absolute; width: 0pt; height: 0pt; left: 65px; top: 150px; visibility: hidden;" 
onclick="popupoff(this);" 
onblur="popupoff(this);" 
oncontextmenu="return true;" 
>

<img id="popupimg" 
	style="border-top: 3px solid rgb(254, 189, 17); 
	       border-bottom: 3px solid rgb(165, 165, 153); 
	       position: absolute;" 
	title="Cliquez pour fermer" 
	onerror="this.src='<?php echo($filename_abs)?>'" 
	src=<?php echo($filename_abs)?> />
</div>


