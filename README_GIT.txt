GUide d'utilisation de git pour l'olivet.
----------------------------------------

1. Outils : 
	utilisation de git-gui uniquement pour visualiser l'arboresence du git
	utilisation de git-bash pour les commandes de mis à jour du git

2. Transfert avec le serveur (git@github.com:gtrepos/olivet.git) :
	git clone git@github.com:gtrepos/olivet.git : initialiser d'un depot local (à ne faire qu'une fois)
	git push 				    : met à jour le depot du serveur avec le depot local 
	git pull 				    : met à jour le dépôt local avec le dépôt du serveur (cf plus bas)


3. Mis à jour du depot local :
	git add <filename> 			    : ajout d'un fichier au dépôt local (necessite toutefois un commit)
	git commit -a -m "commentaire" 	            : met à jour le depot local avec les modifs des fichiers locaux





4. Lors d'un git pull un conflit peut être indiqué, le fichier en question est modifié avec un diff (cf exemple dessous) : 


	<<<<<<< HEAD:README_GIT.txt
	texte dans le site local
	=======
	texte sur le serveur 
	>>>>>>> 1c9760dc13392251443b8d230f6ce52a2089acc6:README_GIT.txt


5. Autres points

voir "gitignore" si on utilise eclipse : eclipse crée un fichier .project qui ne doit pas faire partie du git.

NOUVEAU conflit depuis dit1  