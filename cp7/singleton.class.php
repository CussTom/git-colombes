<?php


/**
 * Mini framework en PHP orienté objet permettant de se connecter à une BDD MySQL ou
 * MariaDB et de travailler avec ses tables
 */

class Singleton
{
    // Attributs privés
    private static $host = '';
    private static $port = '';
    private static $dbname = '';
    private static $user = '';
    private static $pass = '';
    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    private static $cnn = null;

    /**
     * Constructeur de la classe : vide
     */
    private function __construct()
    {
    }

    /**
     * Méthode permettant de passer les paramètres de connexion à la classe Singleton
     * @param string $newHost - nom ou adresse IP du serveur de BDD (défaut : localhost)
     * @param int $newPort - port d'écoute du serveur de BDD (défaut : 3306)
     * @param string $newDbName - nom de la BDD
     * @param string $newUser - nom de l'utilisateur de la BDD
     * @param string $newPass - mot de passe de connexion
     * @param array $newOptions - options de connexion
     */

    public static function setConfiguration(string $newHost, int $newPort, string $newDbName, string $newUser, string $newPass, array $newOptions = array())
    {
        self::$host = $newHost;
        self::$port = $newPort;
        self::$dbname = $newDbName;
        self::$user = $newUser;
        self::$pass = $newPass;
        self::$options += $newOptions;
    }

    /**
     * Méthode qui valide si une configuration est active ou non
     * @return bool true si on a un hôte (serveur), un port et une BDD
     */
    private static function hasConfiguration(): bool
    {
        // if (empty(self::$host) || empty(self::$port) || empty(self::$dbname)) {
        //     return false;
        // } else {
        //     return true;
        // }

        // ou bien
        return self::$host . self::$port . self::$dbname;
    }

    /**
     * Méthode qui renvoie une connexion à la BDD : Singleton !
     * @return PDO objet de connexion à la BDD
     */

    public static function getPDO()
    {
        // Test si connexion active ou non
        if (self::$cnn === null) {
            // Teste si une configuration est dispo
            if (!self::hasConfiguration()) {
                throw new Exception(__CLASS__ . ' :Aucune configuration définie (hôte, port et nom BDD).');
            } else {
                try {
                    $dsn = 'mysql:host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$dbname . ';charset=utf8';
                    self::$cnn = new PDO(
                        $dsn,
                        self::$user,
                        self::$pass,
                        self::$options
                    );
                } catch (PDOException $err) {
                    throw new Exception(__CLASS__ . ' : ' . $err->getMessage());
                }
            }
        }
        return self::$cnn; // si tout est ok, connexion renvoyée
    }

    /**
     * Destructeur de classe
     */
    public function __destruc()
    {
        if (self::$cnn !== null) {
            self::$cnn = null;
        }
    }

    /**
     * Interdit le clônage de cette classe : Singleton
     */

    public function __clone()
    {
        throw new Exception(__CLASS__ . ' : Clônage de cette classe interdit.');
    }

    /**
     * Méthode qui renvoie les deux premières colonnes d'une requête
     * SELECT/SHOW sous la forme d'un composant HTML select
     * @param string $id - attribut id et name du composant (SELECT)
     * @param string $sql - requête SQL préparée de type SELECT/SHOW
     * @param array $vals - tableau de paramètres (défaut array())
     * @return string code HTML (le Select)
     */

    public static function getHtmlSelect($id, $sql, $vals = array())
    {
        // Tester si configuration dispo
        if (self::hasConfiguration()) {
            // Teste s'il s'agit bien d'une requête SELECT/SHOW
            $stmt = explode(' ', strtolower($sql)); // explode transforme un array en string
            if ($stmt[0] === 'select' || $stmt[0] === 'show') {
                // Prépare la requête
                $qry = self::getPDO()->prepare($sql);
                $qry->execute($vals);
                // Construit le composant HTML
                $html = '<select id="' . $id . '" name="' . $id . '" class="form-control">';
                while ($row = $qry->fetch(PDO::FETCH_NUM)) {
                    // Si la requête ne renvoie qu'une seule colonne
                    if ($qry->columnCount() === 1) {
                        $html .= '<option value="' . $row[0] . '">' . $row[0] . '</option>';
                    } else {
                        $html .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                }
                $html .= '</select>';
                return $html;
            } else {
                throw new Exception(__CLASS__ . ' : La requête doit commencer par SELECT/SHOW.');
            }
        } else {
            throw new Exception(__CLASS__ . ' : Aucune configuration définie (hôte, port et nom BDD).');
        }
    }

    /**
     * Méthode qui renvoie le résultat d'une requête préparée
     * SELECT/SHOW sous la forme d'un composant HTML table
     * @param string $sql - requête SQL de type SELECT ou SHOW
     * @param array $vals - tableau de paramètres
     * @return string code html
     */

    public static function getHtmlTable(string $sql, array $vals = array())
    {
        if (self::hasConfiguration()) {
            // Teste si la requête est bien du type SELECT/SHOW
            $stmt = explode(' ', strtolower($sql));
            if ($stmt[0] === 'select' || $stmt[0] === 'show') {
                try {
                    // Prépare et exécute ma requête
                    $qry = self::getPDO()->prepare($sql);
                    $qry->execute($vals);
                    // Affiche le nom des colonnes
                    $html = '<table class="table table-dark table-striped table-hover"><thead><tr>';
                    for ($i = 0; $i < $qry->columnCount(); $i++) {
                        $meta = $qry->getcolumnMeta($i);
                        $html .= '<th>' . $meta['name'] . '</th>'; // affiche en-tête du tableau
                    }
                    $html .= '</tr></thead><tbody>';
                    // Affiche les data
                    while ($row = $qry->fetch()) {
                        $html .= '<tr>';
                        foreach ($row as $key => $val) {
                            $html .= '<td>' . $val . '</td>';
                        }
                        $html .= '</tr>';
                    }
                    $html .= '</table></tbody>';
                    return $html;
                } catch (PDOException $err) {
                    throw new PDOException(__CLASS__ . ' : ' . $err->getMessage());
                }
            }
        } else {
            throw new Exception(__CLASS__ . ' : Aucune configuration définie (hôte, port et nom BDD).');
        }
    }
}
