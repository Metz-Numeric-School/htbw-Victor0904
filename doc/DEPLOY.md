# Procédure de Déploiement
Installer AAPANEL sur la VM 

wget -O install.sh http://www.aapanel.com/script/install-ubuntu_6.0_en.sh && bash install.sh aapanel

 Configuration Initiale de aaPanel

	Installation des composants (LNMP) :

________________________________________
 Création du Site Web
	Dans le menu de gauche, cliquez sur Website.
	Cliquez sur le bouton Add site.
	Remplissez le formulaire :
	Domain name : 192.168.119.130 (L'IP de votre VM).
	Database :  MySQL.

________________________________________
 Activation du SSH pour aaPanel

Sur la VM
apt update && apt install openssh-server -y
1.	
Modifiez la configuration SSH :
Bash
nano /etc/ssh/sshd_config

	Cherchez la ligne #PermitRootLogin prohibit-password.
	Modifiez-la pour avoir : PermitRootLogin yes
	(Si la ligne n'existe pas, ajoutez-la à la fin du fichier).
	Sauvegardez et quittez (CTRL + X, puis O ).
	
________________________________________
 Importation du Code (Git)
Maintenant, utilisez le Terminal intégré à aaPanel (ou votre terminal VM).
Allez dans le dossier du site :
Bash
cd /www/wwwroot/adresseIp
git clone https://github.com/Victor0904/LeNomDuDossier .

________________________________________
 Configuration Nginx (Dossiers & Redirection)
Le code est importé, mais le site ne s'affiche pas encore car les dossiers ne correspondent pas.
1. Ajuster les dossiers (Site Directory)
Le vrai site se trouve souvent dans un sous-dossier (ex: public).
1.	Dans aaPanel > Website > Cliquez sur votre site (192.168.119.130).
2.	Allez dans l'onglet Site directory.
3.	Running directory (en bas) : Sélectionnez /public dans la liste.
4.	Cliquez sur Save.
2. Corriger le fichier de démarrage (Default Doc)
Par défaut, Nginx cherche default.html alors que nous avons index.php.
1.	Dans la configuration du site, allez dans l'onglet Default Doc.
2.	Ajoutez index.php dans la première case et cliquez sur Add.
3.	Assurez-vous que index.php est en haut de la liste.
3. Désactiver la protection Open_basedir (Anti-XSS)
Cette sécurité empêche le site d'accéder à ses propres fichiers de configuration.
1.	Dans l'onglet Site directory, décochez la case Anti-XSS attack (open_basedir).
Si la case se recoche toute seule (bug fréquent), forcez la désactivation via le terminal :
Bash
cd /www/wwwroot/192.168.119.130/bloc4-dfs-training-main/public
chattr -i .user.ini
rm .user.ini
/etc/init.d/php-fpm-83 restart

________________________________________
 Installation des Dépendances (Composer)
Autoriser les fonctions Composer :
Allez dans aaPanel > App Store.
Trouvez PHP 8.3 > Cliquez sur Setting.
Allez dans Disabled functions.
Supprimez (avec la croix x) : putenv et proc_open.
Installer via le terminal :
Bash
cd /www/wwwroot/192.168.119.130/LeNomDuDossier
composer install --no-dev

________________________________________
 Base de Données & Environnement (.env)
Il faut connecter le code à la base de données créée à l'Étape 3.
Créer le fichier .env :
Bash
cd /www/wwwroot/192.168.119.130/bloc4-dfs-training-main
cp .env.example .env
nano .env
1.	
Configurer les accès :
Bash
nano .env
Modifiez les lignes suivantes avec les infos trouvées dans aaPanel > Databases :
Ini, TOML

DB_HOST=127.0.0.1
DB_NAME=
DB_USER=
DB_PASSWORD=
 Étape 10 : NGNIX 404 

Solution 1 : La Réécriture d'URL (URL Rewrite)


Nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}


OU Trouver le fichier ngnix.conf dans le projet et copier la location 
exemple 



6.	Clique sur Save.
7.	Rafraîchis ton site.

 Étape 10 : Permissions Finales 

Bash
chown -R www:www /www/wwwroot/192.168.119.130
Ou chown -R www:www .

Si ca ne marche pas == cause : Fichier user.ini

Donc si erreur  = 
chown: modification du propriétaire de './bloc4-dfs-training-main/public/.user.ini': Opération non permise

Il faut supprimer ce user.ini

Donc = 
cd bloc4-dfs-training-main/public
chattr -i .user.ini

puis relancer 

chown -R www:www .

## Préparation du VPS

Se connecter au VPS avec ssh root@IP 
Installer AAPANEL 
Suivre la méthode expliqué dans la procédure de déploiement

## Méthode de déploiement

Utiliser le versioning avec les TAG de git 
winget install git-cliff

Ajouter un tag a chaque commit 
Normalement le fichier Changelog.md s'actualise avec les derniers commits.

Toujours utiliser le code sur son PC, modifier/ajouter/créer..
faire : 
Git add .
git commit -m"fix: correction de ..."
git tag V1.0.5

git push -u origin master

ENSUITE sur AAPANEl 
Ouvrir le terminal
Aller dans le dossier du site 

Git pull 

Cela actualise le site avec le dernier commit sur github.