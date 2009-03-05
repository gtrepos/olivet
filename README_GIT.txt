GUide d'utilisation de git pour l'olivet.
----------------------------------------

1. Outils : 

	utilisation de git-gui uniquement pour visualiser l'arboresence du git
	utilisation de git-bash pour les commandes de mis à jour du git

2. Transfert avec le serveur (git@github.com:gtrepos/olivet.git) :

	git clone git@github.com:gtrepos/olivet.git : initialiser d'un depot local (à ne faire qu'une fois)
	git push 				    : met à jour le depot du serveur avec le depot local 
	git pull 				    : met à jour le dépôt local avec le dépôt du serveur -- cf point 5


3. Mis à jour du depot local :

	git add <filename> 			    : ajout d'un fichier au dépôt local (+ commit apres)
	git rm <filename> 			    : effacement d'un fichier du dépôt local (+ commit apres) -- cf point 6
	git commit -a -m "commentaire" 	            : met à jour le depot local avec les modifs des fichiers locaux


4. Echo de la situation actuelle :

	git status 			    	    : -- cf point 7
	git log 	                            : 


5. Au sujet du git pull :

	ATTENTION : il faut faire un commit avant un git pull (sinon erreur)
	
	Lors d'un git pull un conflit peut être indiqué, le fichier en question est modifié avec un diff (cf exemple dessous) : 

	<<<<<<< HEAD:README_GIT.txt
	texte dans le site local
	=======
	texte sur le serveur 
	>>>>>>> 1c9760dc13392251443b8d230f6ce52a2089acc6:README_GIT.txt


5. Au sujet de git status :

	

	$ git status
	# On branch master
	# Your branch is ahead of 'origin/master' by 1 commit. ==> on a un commit d'avance sur le serveur (faire un push peut être)
	#
	# Changes to be committed:
	#   (use "git reset HEAD <file>..." to unstage)
	#
	#       new file:   FAUX_FICHIER.TXT                   ==> file ajouté par git add 
	#       deleted:    modif/modif1.txt		       ==> file supprimé par git rm
	#
	# Changed but not updated:
	#   (use "git add <file>..." to update what will be committed)
	#   (use "git checkout -- <file>..." to discard changes in working directory)
	#
	#       modified:   README_GIT.txt		       ==> fichier modifié (faire un git commit peut être)
	#
	# Untracked files:
	#   (use "git add <file>..." to include in what will be committed)
	#
	#       FAUX_FICHIER2.txt			       ==> fichier non présent dans le git (necessite git add peut être) 
	#

5. Autres points

	voir "gitignore" si on utilise eclipse : eclipse crée un fichier .project qui ne doit pas faire partie du git.


6. Le Readme de Gwen : (que je ne peux pas ssupprimer tout de même) 

	le commit doit être fait dans origin/master
	pour récupérer un commit propre : 
	dépot distant > récupérer de > origin
	fusionner > fusion locale : branche de suivi doit être coché avec origin/master en choix.
	cliquer sur fusionner.

	Dans l'écran de visualisation de la fusion il faut sélectionner la derniere version pushé avec clic 
	droit puis faire un clic gauche sur la version en locale puis faire un Diff this -> 
	selected ou un Diff selected -> this. Le résultat de la comparaison est en bas.




