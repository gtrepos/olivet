
GUide d'utilisation de git pour l'olivet.
----------------------------------------

1. Outils : 

	utilisation de git-gui uniquement pour visualiser l'arboresence du git
	utilisation de git-bash pour les commandes de mis � jour du git

2. Transfert avec le serveur (git@github.com:gtrepos/olivet.git) :

	git clone git@github.com:gtrepos/olivet.git : initialiser d'un depot local (� ne faire qu'une fois)
	git pull 				    : met � jour le d�p�t local avec le d�p�t du serveur -- cf point 5
	git push 				    : met � jour le depot du serveur avec le depot local (faire un git pull avant) 



3. Mis � jour du depot local :

	git add <filename> 			    : ajout d'un fichier au d�p�t local (+ commit apres)
	git rm <filename> 			    : effacement d'un fichier du d�p�t local (+ commit apres)
	git commit -a -m "commentaire" 	            : met � jour le depot local avec les modifs des fichiers locaux 


4. Echo de la situation actuelle (pas de risque):

	git status 			    	    : affiche la situation -- cf point 6
	git log 	                    : affiche la liste des commit -- cf point 7
	git log -n 5					: voir les 5 derniers commits

5. Au sujet du git pull :

	ATTENTION : il faut faire un commit avant un git pull (sinon erreur)
	
	Lors d'un git pull un conflit peut �tre indiqu�, le fichier en question est modifi� avec un diff (cf exemple dessous) : 

	<<<<<<< HEAD:README_GIT.txt
	texte dans le site local
	=======
	texte sur le serveur 
	>>>>>>> 1c9760dc13392251443b8d230f6ce52a2089acc6:README_GIT.txt


6. Au sujet de git status (2 exemples) :

	Exemple complet :

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

	Exemple trompeur (cela  veut dire qu'on est � jour localement mais le serveur peut �tre en avance, faire git log) :

	$ git status
	# On branch master
	# nothing to commit (working directory clean)


7. Au sujet de git log :	

	Pour voir seulement les derniers commit : git log -n <nbs_logs_qu_on_veut_voir>
	Peut �tre le moyen de plus simple pour voir si l'on est � jour par rapport au serveur : comparer les dates de commit

5. Autres points (pas importants) :

	voir "gitignore" si on utilise eclipse : eclipse cr�e un fichier .project qui ne doit pas faire partie du git.
	toujours au sujet de git pull : git pull = git fetch + git merge : il parait que l'on peut remplacer le git merge par un git rebase,
	permet de voir un seul arbre dans git-gui.. mais on verra plus tard. 


6. Le Readme de Gwen : (que je ne vais pas supprimer tout de m�me) 

	le commit doit �tre fait dans origin/master
	pour r�cup�rer un commit propre : 
	d�pot distant > r�cup�rer de > origin
	fusionner > fusion locale : branche de suivi doit �tre coch� avec origin/master en choix.
	cliquer sur fusionner.

	Dans l'�cran de visualisation de la fusion il faut s�lectionner la derniere version push� avec clic 
	droit puis faire un clic gauche sur la version en locale puis faire un Diff this -> 
	selected ou un Diff selected -> this. Le r�sultat de la comparaison est en bas.




