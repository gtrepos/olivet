<script language="JavaScript">
// Create PopupWindow object

var popup = new PopupWindow("divPopup");
popup.offsetX=-20;
popup.offsetY=20;
popup.autoHide();
var popupinput=null;

popup.populate('<iframe src="./producteur/formupload.html" frameborder=1 scrolling=no width="550px;" height="60px;"/>');

function popupActivate(obj,anchor) {
	popupinput=obj;
	popup.showPopup(anchor);
}
function popupPick(val) {
	popupinput.value = val;
	popup.hidePopup();
}
</script>

<form name="form_producteur" action='index.php?page=producteurs&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkProducteur);">
	<div style='position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau producteur</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/></tr>
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' size=50/></td></tr>
			<tr><td>Adresse : </td><td><input type='text' id='adresse' name='adresse' size=50/></td></tr>
			<tr><td>Latitude google map : </td><td><input type='text' id='latitude' name='latitude' size=20/></td></tr>
			<tr><td>Longitude google map : </td><td><input type='text' id='longitude' name='longitude' size=20/></td></tr>
			<tr><td valign="top">Descriptif du producteur : </td><td><textarea rows=5 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr><td>Rang : </td><td><input type='text' id='rang' name='rang'/></td></tr>
			<tr>
				<td>Picto : </td>
				<td><input name="picto" id="picto"> <a href="#" onclick="popupActivate(document.forms['form_producteur'].picto,'anchor');return false;" name="anchor" id="anchor">Choisir un fichier</a></td>
			</tr>
			<tr>
				<td>Photo : </td>
				<td><input name="photo" id="photo"> <a href="#" onclick="popupActivate(document.forms['form_producteur'].photo,'anchor');return false;" name="anchor" id="anchor">Choisir un fichier</a></td>
			</tr>
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkProducteur()">
</form>

<div id="divPopup" style="position: absolute; visibility: hidden; background-color:#E2BAD9; width: 550px; height: 60;"></div>