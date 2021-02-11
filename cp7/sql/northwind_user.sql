-- Création d'un user v1
use northwind;
CREATE USER 'jean'@'localhost'
IDENTIFIED BY 'Neym@r'
;

-- Vérif
SELECT * FROM mysql.user;

-- Possibilité de hash
SELECT MD5('secret');

SELECT SHA1('secret');

SELECT SHA2('secret', 512);

-- Ajout d'un SALT
SELECT SHA2(CONCAT(SHA1('secret'), 'licorne'), 256);


-- Création d'user v2
CREATE USER 'karima'@'localhost'
IDENTIFIED BY 'a127bcc947d13b145e343c704377aa2b3b2ee5f160632bd853ce37e0c66dbc7f'
;

-- Change le pass de karima
SET PASSWORD FOR 'karima'@'localhost' = 'waran';

-- Lecture pour Jean et CRUD pour Karima
GRANT SELECT ON northwind.produits TO jean@localhost;


SELECT CONCAT('GRANT INSERT, SELECT, UPDATE, DELETE ON northwind.', table_name, 'TO karima@localhost;') FROM information_schema.tables WHERE table_schema = 'northwind'AND 
table_name LIKE '%commandes%';

GRANT INSERT, SELECT, UPDATE, DELETE ON northwind.* TO karima@localhost;








