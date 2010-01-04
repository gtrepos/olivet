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

<form name="form_produit_resa" action='index.php?page=produitsresa&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkProduitResa);">
<?php
$id = $_GET['id'];
affich_modif_produit_resa($id);
?>
<br>
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkProduitResa()">
</form>

<div id="divPopup" style="position: absolute; visibility: hidden; background-color:#E2BAD9; width: 550px; height: 60;"></div>
