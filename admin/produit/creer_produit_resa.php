<script language="JavaScript">
// Create PopupWindow object

var popup = new PopupWindow("divPopup");
popup.offsetX=-20;
popup.offsetY=20;
popup.autoHide();
var popupinput=null;

popup.populate('<iframe src="./produit/formupload.html" frameborder=1 scrolling=no width="550px;" height="60px;"/>');

function popupActivate(obj,anchor) {
	popupinput=obj;
	popup.showPopup(anchor);
}
function popupPick(val) {
	popupinput.value = val;
	popup.hidePopup();
}
</script>

<form name="form_produit_resa" action='index.php?page=produitsresa&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkProduitResa);">
		<table>
			<tr><td colspan="2"><?php echo "Création d'un nouveau produit à la réservation"; ?></tr>
			<tr><td colspan="2">&nbsp;</tr>
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
			<tr><td valign="top">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr>
				<td>Photo : </td>
				<td><input name="photo" id="photo"> <a href="#" onclick="popupActivate(document.forms['form_produit_resa'].photo,'anchor');return false;" name="anchor" id="anchor">Choisir un fichier</a></td>
			</tr>
		</table>
		<br>		
<input type="reset">
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkProduitResa()">
</form>

<div id="divPopup" style="position: absolute; visibility: hidden; background-color:#E2BAD9; width: 550px; height: 60;"></div>


