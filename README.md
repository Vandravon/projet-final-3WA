Disclaimer: I highly doubt that non French speaking people come here, but if this happens please forgive me: as the project is for a French exam, all is in French (except filenames and variables), so I'm afraid that won't be valuable for you.

# projet-final-3WA

Ceci est le projet que j'ai fait pour mon examen final de Développeur/Intégrateur fait à la 3W Academy de Bordeaux en Août 2022.
J'ai été très inspiré par les favoris qu'on peut enregistrer sur le site Notion (https://www.notion.so/), et j'ai voulu reproduire une partie du fonctionnement.

Installation:

- mettre le projet sur votre serveur ou dans le dossier www de votre WAMP/MAMP/LAMP

Base de donnée:

- créer une nouvelle base de donnée; nom que vous souhaitez, celà sera indiqué dans la configuration du projet
- créer une table bookmarks: id (auto increment), title (varchar(255)), picture_url (varchar(255)), url (varchar(255)), created_at (datetime), user_id (clé étrangère)
- créer une table categories: id (auto increment), name (varchar(30)); il faudra également rajouter à la main les catégories que vous souhaitez
- créer une table contacts: id (auto increment), title (varchar(255)), content (text)
- créer une table users: id (auto increment), nickname (varchar(255)), email (varchar(255)), password (varchar(255)), created_at (datetime), role (bool)
- créer une table bookmarks_categories (table de liaison): bookmarks_id (clé étrangère), categories_id (clé étrangère)

Dans le dossier config du projet, mettre les informations de la base de donnée dans le fichier database.php:

- host: adresse de la base de donnée
- port: port de la base de donnée
- dbname: nom que vous avez donné à la base de donnée
- username: votre nom d'utilisateur pour vous connecter à la base de donnée
- password: le mot de passe pour vous connecter à la base de donnée

Information additionnelle:

- pour donner le rôle d'administrateur à un utilisateur, il faut aller dans la table users et mettre le role à 1 pour le compte
