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

<form name="form_produit" action='index.php?page=produits&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;">
		<table>
			<tr><td colspan="2"><?php echo "Création d'un nouveau produit"; ?></tr>
			<tr><td colspan="2">&nbsp;</tr>
			<tr><td>Catégorie : </td><td><?php liste_categories('-1',false);?></td></tr> 
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' size=70/></td></tr>
			<tr><td valign="top">Descriptif : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr>
				<td>Nom photo : </td>
				<td><input name="photo" id="photo"> <a href="#" onclick="popupActivate(document.forms['form_produit'].photo,'anchor');return false;" name="anchor" id="anchor">Choisir un fichier</a></td>
			</tr>
			<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' size=10 value='0'/></td></tr>
			<tr>
				<td>Jours dispos : </td><td>
					<input type='checkbox' name='jourDispo' checked=true value='2'>Mardi</input>
					<input type='checkbox' name='jourDispo' checked=true value='3'>Mercredi</input> 
					<input type='checkbox' name='jourDispo' checked=true value='4'>Jeudi</input> 
					<input type='checkbox' name='jourDispo' checked=true value='5'>Vendredi</input>
					<input type='checkbox' name='jourDispo' checked=true value='6'>Samedi</input>
					<input type='hidden' name='concatJoursDispos' id='concatJoursDispos'/>
				</td>
			</tr>
		</table>
		<br>		
<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=produits'">		
<input type="reset">
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkProduit()">		
</form>

<div id="divPopup" style="position: absolute; visibility: hidden; background-color:#E2BAD9; width: 550px; height: 60;"></div>


