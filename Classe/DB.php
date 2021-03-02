<?php


class DB
{
    private string $host = 'localhost';
    private string $db = 'live_bdd_objet';
    private string $user = 'root';
    private string $password = '';

    private static ?PDO $dbInstance = null;

    /**
     * DB constructor.
     */
    public function __construct() {
        try {
            self::$dbInstance = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->password);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @return PDO|null
     */
    public static function getinstance(): ?PDO {
        if(is_null(self::$dbInstance)) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * on empêche d'autre devellopeurs de cloner l'objet
     * pour s'assurer qu'on a une seule instance de la connexion db.
     */
    public function __clone() {}
}