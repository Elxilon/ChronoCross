<?php

class Database
{
    private string $db_name, $db_user, $db_pwd, $db_host, $db_port;
    private PDO $pdo;
    public function __construct($db_name='chronocross', $db_host='127.0.0.1', $db_port='3307', $db_user = 'root', $db_pwd='password') {
        $this->db_name = $db_name; $this->db_host = $db_host; $this->db_port = $db_port;
        $this->db_user = $db_user; $this->db_pwd = $db_pwd;

        $dsn = 'mysql:dbname=' . $this->db_name . ';host='. $this->db_host. ';port=' . $this->db_port;
        // connexion à la BDD
        try {
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pwd);
        } catch (\Exception $ex) {
            die('Error : ' . $ex->getMessage());
        }
    }

    /**
     * Récupère toutes les courses de la base de données
     *
     * @return array Tableau contenant le(s) résultat(s) de la requête passée en paramètre de la fonction
     */
    public function getAllCourses(): array {
        // Préparation d'une requête simple
        $statement = $this->pdo->prepare("SELECT * FROM course ORDER BY token ASC");
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchAll();
    }
}