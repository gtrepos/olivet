Infos sur la base de données mysql
----------------------------------------

1. création : 
	Il faut créer la base de données via phpmyadmin.
	cliquer sur l'icone accueil.
	créer la base de données 'olivet' en choisissant interclassement utf8_general_ci
	et interclassement pour la connexion Mysql par contre latin1_general_ci (pour rendu des accents corrects dans les exports sql)
	cliquer sur créer.
	cliquer sur importer. choisir le fichier olivet.sql du projet eclipse.
	bien valider que le fichier d'import est encodé dans eclipse en utf-8.
	choisir jeu de caractères du fichier : utf8.
	cliquer sur exécuter.
	la bdd est créée.

2. export (suite à modification du schéma) :
	via phpmyadmin, cliquer sur olivet puis sur exporter.
	via l'écran d'export, cocher la case Transmettre (en bas), puis cliquer sur éxecuter. 
	Cela créera directement le ficher olivet.sql qu'il suffira de reporter dans le projet.   
	