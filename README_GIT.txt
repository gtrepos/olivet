GUide d'utilisation de git pour l'olivet.
----------------------------------------

1. Outils : 

	utilisation de git-gui uniquement pour visualiser l'arboresence du git
	utilisation de git-bash pour les commandes de mis � jour du git

2. Transfert avec le serveur (git@github.com:gtrepos/olivet.git) :

	git clone git@github.com:gtrepos/olivet.git : initialiser d'un depot local (� ne faire qu'une fois)
	git push 				    : met � jour le depot du serveur avec le depot local 
	git pull 				    : met � jour le d�p�t local avec le d�p�t du serveur -- cf point 5


3. Mis � jour du depot local :

	git add <filename> 			    : ajout d'un fichier au d�p�t local (+ commit apres)
	git rm <filename> 			    : effacement d'un fichier du d�p�t local (+ commit apres) -- cf point 6
	git commit -a -m "commentaire" 	            : met � jour le depot local avec les modifs des fichiers locaux


4. Echo de la situation actuelle :

	git status 			    	    : -- cf point 7
	git log 	                            : 


5. Au sujet du git pull :

	ATTENTION : il faut faire un commit avant un git pull (sinon erreur)
	
	Lors d'un git pull un conflit peut �tre indiqu�, le fichier en question est modifi� avec un diff (cf exemple dessous) : 

	<<<<<<< HEAD:README_GIT.txt
	texte dans le site local
	=======
	texte sur le serveur 
	>>>>>>> 1c9760dc13392251443b8d230f6ce52a2089acc6:README_GIT.txt


5. Au sujet de git status :

	

	$ git status
	# On branch master
	# Your branch is ahead of 'origin/master' by 1 commit. ==> on a un commit d'avance sur le serveur (faire un push peut �tre)
	#
	# Changes to be committed:
	#   (use "git reset HEAD <file>..." to unstage)
	#
	#       new file:   FAUX_FICHIER.TXT                   ==> file ajout� par git add 
	#       deleted:    modif/modif1.txt		       ==> file supprim� par git rm
	#
	# Changed but not updated:
	#   (use "git add <file>..." to update what will be committed)
	#   (use "git checkout -- <file>..." to discard changes in working directory)
	#
	#       modified:   README_GIT.txt		       ==> fichier modifi� (faire un git commit peut �tre)
	#
	# Untracked files:
	#   (use "git add <file>..." to include in what will be committed)
	#
	#       FAUX_FICHIER2.txt			       ==> fichier non pr�sent dans le git (necessite git add peut �tre) 
	#

5. Autres points

	voir "gitignore" si on utilise eclipse : eclipse cr�e un fichier .project qui ne doit pas faire partie du git.


6. Le Readme de Gwen : (que je ne peux pas ssupprimer tout de m�me) 

	le commit doit �tre fait dans origin/master
	pour r�cup�rer un commit propre : 
	d�pot distant > r�cup�rer de > origin
	fusionner > fusion locale : branche de suivi doit �tre coch� avec origin/master en choix.
	cliquer sur fusionner.

	Dans l'�cran de visualisation de la fusion il faut s�lectionner la derniere version push� avec clic 
	droit puis faire un clic gauche sur la version en locale puis faire un Diff this -> 
	selected ou un Diff selected -> this. Le r�sultat de la comparaison est en bas.




