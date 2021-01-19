-- Challenge 1 : Liste des employés (titre, prenom, nom) concaténés,
-- âge, salaire (salaire + commission)

SELECT CONCAT(titre, '', prenom, '', nom) AS "salarié", FLOOR(DATEDIFF(NOW(), date_naissance)/365.25) AS 'AGE', salaire+COALESCE(commission,0) AS salaire FROM employes;


-- Challenge 2 : nom, prix unitaire et unites en stock des produits dont
-- le code fournisseur n'est pas 1, 3 ou 5 et dont la quantité contient 'carton' ou 'bouteille'
-- OU des produits dont le code catégorie et un multiple de 2 et soit disponible

SELECT nom_produit, prix_unitaire, unites_stock FROM produits WHERE (no_fournisseur NOT IN (1,3,5) AND (quantite LIKE '%carton%' OR quantite LIKE '%bouteille%'))
OR (MOD(code_categorie,2)=0 AND indisponible = 0);
;

-- Challenge 3 : combien y a t-il de produits valant  moins de 50 EUR livrés en bouteille
SELECT * FROM produits WHERE prix_unitaire < 50 AND quantite LIKE '%bouteilles%';
 
 
-- Challenge 4 : afficher le nom des produits, leur catégorie(nom) et le nom du fournisseur pour les produits 
-- valant plus de 25 EUR et provenant d'Italie, de France et d'Allemagne

SELECT p.NOM_PRODUIT, c.NOM_CATEGORIE, f.SOCIETE
	FROM produits p
		JOIN categories c
			ON p.CODE_CATEGORIE = c.CODE_CATEGORIE
		JOIN fournisseurs f
			ON f.NO_FOURNISSEUR = p.NO_FOURNISSEUR
WHERE p.prix_unitaire > 25 AND f.pays IN('Italie', 'France', 'Allemagne');

-- Challenge 5 : afficher la liste des clients ayant acheté des produits fournis
-- par des soicétés japonnaises, norvégiennes et brésiliennes

SELECT DISTINCT cl.societe
	FROM clients cl
		JOIN commandes co
			ON co.CODE_CLIENT = cl.CODE_CLIENT
		JOIN details_commandes d
			ON co.NO_COMMANDE = d.NO_COMMANDE
		JOIN produits p
			ON p.REF_PRODUIT = d.REF_PRODUIT
		JOIN fournisseurs f
			ON f.NO_FOURNISSEUR = p.NO_FOURNISSEUR			
WHERE f.pays IN ('Japon', 'Norvège', 'Brésil'); 

-- Challenge 6 : qui a réalisé le meilleur CA en 2019

SELECT e.prenom, e.nom, ROUND(SUM(dc.prix_unitaire*dc.quantite * (1 - dc.remise)), 2) AS CA
	FROM employes e
		JOIN commandes co
			ON e.NO_EMPLOYE = co.NO_EMPLOYE
		JOIN details_commandes dc
			ON dc.NO_COMMANDE = co.NO_COMMANDE
WHERE YEAR(co.DATE_COMMANDE) = 2019
GROUP BY e.prenom, e.nom
ORDER BY CA DESC
LIMIT 1;

-- Challege 7 : Quel client a payé la plus grosse facture ?

SELECT cl.societe,
co.no_commmande,
SUM(d.prix_unitaire * d.quantite * (1 - d.remise)) + AVG(co.port) AS montant
	FROM commandes co
		JOIN details_commandes d
			ON co.NO_COMMANDE = d.NO_COMMANDE
		JOIN clients cl
			ON cl.CODE_CLIENT = co.CODE_CLIENT
GROUP BY cl.societe, co.no_commande
ORDER BY montant DESC
LIMIT 1;
























