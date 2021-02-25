USE northwind;

-- Stats des ventes : CA annuel par vendeur

SELECT e.no_employe,
		e.nom,
        YEAR(c.date_commande) as annee,
		MONTH(c.date_commande) as mois,
        SUM((d.prix_unitaire*d.quantite)*(1-d.remise)) as ca
FROM employes e
	JOIN commandes c
		ON e.no_employe = c.no_employe
    JOIN details_commandes d
		ON c.no_commande = d.no_commande
	WHERE e.no_employe = 5
    AND YEAR(c.date_commande) = 2019
	GROUP BY e.no_employe,
		e.nom,
        YEAR(c.date_commande),
		MONTH(c.date_commande)
;