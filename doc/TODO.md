# TODO

Suite à un audit effectué en amont, voici les failles et les bugs qui ont été identifés comme prioritaire.

## FAILLES

* Des utilsateurs non admin ont des accès à l'interface de gestion des utilisateurs ==Droit dans routes.json
* Les mots de passes ne sont pas chiffrée en base de données...
* Des injections de type XSS ont été détéctées sur certains formulaires
* On nous a signalé des injections SQL lors de la création d'une nouvelles habitudes
  * exemple dans le champs "name" : foo', 'INJECTED-DESC', NOW()); --

## BUGS

* Une 404 est détéctée lors de la redirection après l'ajout d'une habitude---------- habit dans Src/Controller/Member/HabitsController.php doit être remplacé par Habits le vrai nom de la page 
* Le formulaire d'inscription ne semble pas fonctionner ------la fonction index est en $_GET au lieu d e$_POST problème résolu 
* Fatal error: Uncaught Error: Class "App\Controller\Api\HabitsController" lorsque l'on accède à l'URL  ``/api/habits``
-----C'est normal la page pointe vers Tickets alors qu'il s'agit de Habits 
Egalement un oublie du s de habits dans la class habitsController

**ATTENTION : certains bugs n'ont pas été listé**
