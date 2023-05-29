<?php

class Database
{
    private string $db_name, $db_user, $db_pwd, $db_host, $db_port;
    private PDO $pdo;
    public function __construct($db_name='chrono', $db_host='127.0.0.1', $db_port='3306', $db_user = 'root', $db_pwd='05111998') {
        $this->db_name = $db_name; $this->db_host = $db_host; $this->db_port = $db_port;
        $this->db_user = $db_user; $this->db_pwd = $db_pwd;

        $dsn = 'mysql:dbname=' . $this->db_name . ';host='. $this->db_host. ';port=' . $this->db_port;
        // connexion à la BDD
        try {
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pwd);
        } catch (Exception $ex) {
            die('Error : ' . $ex->getMessage());
        }
    }

    /**
     * @param int $id Id de la course
     * @return array Tableau avec la liste des coureurs qui ont terminés la course dans les 3 premières position
     */
    private function getCoureursFromCourse(int $id): array {
        $query = "SELECT CONCAT(UPPER(utilisateurs.nom), ' ', utilisateurs.prenom) AS nom_prenom, Temps, Classement
            FROM course_has_coureur AS chc
            INNER JOIN utilisateurs on chc.idUtilisateur = utilisateurs.id
            WHERE Course_idCourse = :id
            ORDER BY Classement ASC";
        // Préparation de la requête qui va récupérer nom_prenom des coureurs, leur temps, et leur classement
        // en ne prenant que les coureurs de la course qui a l'id passé en paramètre
        return $this->exec($query, ['id' => $id]);
    }

    /**
     * Récupère toutes les courses de la base de données
     *
     * @return array Tableau contenant le(s) résultat(s) de la requête passée en paramètre de la fonction
     */
    public function getAllCourses(): array {
        $courses = $this->exec("SELECT * FROM course ORDER BY token ASC");

        // pour chaque course je récupère la liste des coureurs qui ont terminés et je la stocke
        foreach ($courses as $key => $course) {
            // on utilise $courses puis donc $key pour persister la liste en dehors de la boucle
            $courses[$key]['coureurs'] = $this->getCoureursFromCourse($course['id']);
        }
        return $courses;
    }

    private function exec(string $query, array $params=null): array {
        // Préparation de la requête $query
        $statement = $this->pdo->prepare($query);
        // Exécution de la requête avec les paramètres entrés s'il y en a
        try {
            $statement->execute($params);
        } catch (Exception $ex) {
            die('Error : ' . $ex->getMessage());
        }
        return $statement->fetchAll();
    }
}