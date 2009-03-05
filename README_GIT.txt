GUide d'utilisation de git pour l'olivet.
----------------------------------------

1. Outils : 
	utilisation de git-gui uniquement pour visualiser l'arboresence du git
	utilisation de git-bash pour les commandes de mis � jour du git

2. Transfert avec le serveur (git@github.com:gtrepos/olivet.git) :
	git clone git@github.com:gtrepos/olivet.git : initialiser d'un depot local (� ne faire qu'une fois)
	git push 				    : met � jour le depot du serveur avec le depot local 
	git pull 				    : met � jour le d�p�t local avec le d�p�t du serveur (cf plus bas)


3. Mis � jour du depot local :
	git add <filename> 			    : ajout d'un fichier au d�p�t local (necessite toutefois un commit)
	git commit -a -m "commentaire" 	            : met � jour le depot local avec les modifs des fichiers locaux





4. Lors d'un git pull un conflit peut �tre indiqu�, le fichier en question est modifi� avec un diff (cf exemple dessous) : 


	<<<<<<< HEAD:README_GIT.txt
	texte dans le site local
	=======
	texte sur le serveur 
	>>>>>>> 1c9760dc13392251443b8d230f6ce52a2089acc6:README_GIT.txt


5. Autres points

voir "gitignore" si on utilise eclipse : eclipse cr�e un fichier .project qui ne doit pas faire partie du git.

NOUVEAU conflit depuis dit1  