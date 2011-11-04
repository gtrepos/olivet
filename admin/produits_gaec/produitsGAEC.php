<font class=olivet>Où trouver les produits du GAEC</font>

<!-- This <div> holds alert messages to be display in the sample page. -->
<div id="alerts">
	<noscript>
		<p>
			<strong>L'éditeur CKEditor nécessite JavaScript pour fonctionner</strong>. Avec un navigateur sans Javascript tel que le vôtre, 
			vous devriez voir le contenu (données HTML) et vous devriez être capable d'éditer les données sans bénéficier de l'éditeur.
		</p>
	</noscript>
</div>

<div style="height:600px;">

<form action="index.php?page=produitsGAEC&action=enregistrer" method="post">
	<p>
		<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="30">
		<?php affich_produitsGAEC()?>
		</textarea>
	</p>
	<p>
		<input type="submit" value="Enregistrer" />
	</p>
</form>

</div>

<?php 
if (isset($_GET['action'])){
	$action=$_GET['action'];
}
else {
	$action='editer';
}

if ($action=='enregistrer') {
	enregistrer_produitsGAEC();
}
if ($action=='enregistrer') {
	echo "<script type='text/javascript'>window.location='index.php?page=produitsGAEC'</script>";
}
?>