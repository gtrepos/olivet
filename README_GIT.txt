GUide d'utilisation de git pour l'olivet.
----------------------------------------

Outils : 
	utilisation de git-gui uniquement pour visualiser l'arboresence du git
	utilisation de git-bash pour les commandes de mis à jour du git

Transfert avec le serveur (git@github.com:gtrepos/olivet.git) :
	git clone git@github.com:gtrepos/olivet.git : initialiser d'un depot local (à ne faire qu'une fois)
	git fetch                                   : récupération depuis depot de serveur git (ne fait pas le merge)
	git push 				    : met à jour le depot du serveur avec le depot local 

Mis à jour du depot local :
	git commit 				    : met à jour le depot local avec les modifs des fichiers locaux
	git rebase 				    : espèce de merge, plus propre??, avec le depot du serveur

