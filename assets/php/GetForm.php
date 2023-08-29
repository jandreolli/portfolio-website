<?php

class GetForm extends Database
{
    public function __construct()
    {
        $databaseFile = dirname(__FILE__) . '/../db/database.db';
        parent::__construct($databaseFile);
    }

    public function getSearchResults(string $searchInput): array
    {
        // variable searchInput a récupéré l'input entrée dans la barre de recherche
        $regexSearch = '/^[a-zA-Z0-9\s]{1,80}$/';

        // check la regex
        if (preg_match($regexSearch, $searchInput)) {
            // recherche toutes les concordances de la recherche
            $stmt = $this->pdo->prepare(
                "SELECT DISTINCT * FROM project WHERE title LIKE :search OR prog LIKE :search OR content LIKE :search"
            );

            // modifie l'url
            $stmt->bindValue(':search', '%' . $searchInput . '%', PDO::PARAM_STR);
            $stmt->execute();

            // récupère le tableau associatif
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }
        return []; // retourne un tableau vide si ne trouve rien car sinon erreur
    }

    // envoie en JSON les concordances
    public function sendResults(array $results): array
    {
        if (!empty($results)) {
            $output = array();
            foreach ($results as $result) {
                $temp = array(
                    "title" => htmlspecialchars($result['title']),
                    "prog" => htmlspecialchars($result['prog']),
                    "content" => htmlspecialchars($result['content'])
                );
                array_push($output, $temp);
            }
            return $output;
        }
        return [];
    }
}

?>