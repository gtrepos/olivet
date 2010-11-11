<font class=olivet>Page d'accueil</font>

<p>
Important : Il faut transférer les images avant de les référencer (cf <a href="index.php?page=gestionImages">Gestion des images</a>). Il faut préfixer leur référence par 'http://<?php echo $_SERVER['HTTP_HOST'];?>/img/upload/'
</p>  




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

<form action="index.php?page=accueil&action=enregistrer" method="post">
	<p>
		<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="30">
		<?php affich_accueil()?>
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
	enregistrer_accueil();
}
if ($action=='enregistrer') {
	echo "<script type='text/javascript'>window.location='index.php?page=accueil'</script>";
}
?>