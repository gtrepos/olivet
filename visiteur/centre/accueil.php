<h3>Bienvenue !</h3>
<p style='text-align: justify;'><b>La ferme d'Olivet</b> a ouvert son magasin de vente directe depuis le <b>mercredi 3 février 2010</b>. Cette date importante correspond naturellement à la date de mise en ligne de ce site web. Ce site vous permettera donc de vous documenter sur <a href="javascript:clickNavigation('la_ferme');">les activités du GAEC à 3 voix</a>, mais également de commander des produits bio locaux, qu'ils proviennent directement du GAEC, ou qu'ils proviennent d'autres producteurs du département. Nous allons aussi profiter de ce support pour vous tenir au courant des actualités du GAEC, mais également des actualités locales (Servon sur Vilaine et ses environs) et du monde agricole.</p> 
<p style='text-align: justify;'>Cette page d'accueil sera donc l'endroit des 'news'.<p>

<?php

$tmpres = bddNouveauxProduits();
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Zoom produits : </h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		$produit_id = $row[0];
		$categorie_produit_libelle = $row[1];
		$cond_nom = $row[2];
		$produit_libelle = $row[3];
		$categorie_produit_id = $row[4];
		echo "<a href='javascript:clickSelectCatProduit($categorie_produit_id)'>"
		.$categorie_produit_libelle. " > " 
		.$produit_libelle. " > " 
		.$cond_nom."</a>";
		echo "<br/>";
	}
	echo "</p>";	
}	
?>


<?php 
$tmpres = bddActusGaec(true, false);
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Actualités du GAEC :</h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo $row[2]." : "
		."<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
	echo "</p>";
}	
?>

<?php 
$tmpres = bddActusLoma(true, false);
if (mysql_num_rows($tmpres)>0) {	
	echo "<h3>Actualités locales et du monde agricole :</h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo $row[2]." : "
		."<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
	echo "</p>";
}	
?>

<h3>Informations pratiques :</h3>
<p style='text-align: justify;'>Pour commander des produits, rien de plus simple. Cela se fait en deux étapes, d'abord par le choix de produits dans la page <a href="javascript:clickNavigation('nos_produits');">Les produits</a>, puis par une validation de commande via la page <a href="javascript:clickNavigation('commander');">Commander</a>. Lors de votre première commande, nous vous demanderons de saisir quelques informations vous concernant, dans le but de pouvoir vous joindre facilement. Toutes les commandes sont à récupérer directement à <a href="javascript:clickNavigation('nous_contacter');">la ferme d'Olivet</a>.<p>
<p style='text-align: justify;'>Le GAEC à 3 voix vous souhaite une excellente navigation.<p>
<p style='text-align: justify;'>NB : pour un affichage optimal, vérifier que la police French Grotesque est installée sur votre poste. Vous pouvez la télécharger <a href="./police/frenchgrotesque.zip" target="blank_">ici</a>.


