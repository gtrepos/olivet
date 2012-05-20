<font class=olivet><?php echo ADMIN_GESTION_IMAGES; ?></font><br /><br />

<script language="JavaScript">
// Create PopupWindow object

var popup = new PopupWindow("divPopup");
popup.offsetX=-20;
popup.offsetY=20;
popup.autoHide();
var popupinput=null;

popup.populate('<iframe src="./gestionImages/formupload.html" frameborder=1 scrolling=no width="550px;" height="60px;"/>');

function popupActivate(obj,anchor) {
	popupinput=obj;
	popup.showPopup(anchor);
}
function popupPick(val) {
	popupinput.value = val;
	popup.hidePopup();
}
</script>

<form name="form_gestionimages" action='index.php?page=gestionImages&action=enregistrer' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event);">
	<div style='position:relative;'>
		<table>
			<tr>
				<td>Transfert d'une nouvelle image : <a href="#" onclick="popupActivate(document.forms['form_gestionimages'].photo,'anchor');return false;" name="anchor" id="anchor">Choisir un fichier</a></td>
			</tr>
		</table>
	</div>	
</form>

<br><br>

<?php affich_images(); ?>	

<div id="divPopup" style="position: absolute; visibility: hidden; background-color:#E2BAD9; width: 550px; height: 60;"></div>