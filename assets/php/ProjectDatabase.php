<?php

require_once 'Database.php';

class ProjectDatabase extends Database
{
    public function __construct()
    {
        $databaseFile = dirname(__FILE__) . '/../db/database.db';
        parent::__construct($databaseFile);

        $tableExists = $this->tableExist();
        if (!$tableExists) {
            $this->initProjectTable();
        }
    }

    private function tableExist(): bool
    {
        $sql = "SELECT name FROM sqlite_master WHERE type='table' AND name='project'";
        $result = $this->pdo->query($sql);
        $tableExists = $result->fetch();
        return !empty($tableExists);
    }


    private function initProjectTable(): void
    {
        // créer la table
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS project (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            img TEXT NOT NULL,
            title TEXT NOT NULL,
            prog TEXT NOT NULL,
            content TEXT NOT NULL
        )');

        // rentre manuellement les valeurs dans un tableau
        $projects_value = [
            [
                'img' => 'assets/img/puissance4_profil.png" alt="Image de l\'affichage du jeu puissance4',
                'title' => 'Puissance 4',
                'prog' => ['Assembleur MIPS'],
                'content' => 'Projet réalisé dans le cadre de l\' UE Architecture des ordinateurs pour la L2S3 Informatique à 
    l\' UFR Mathématique et Informatique Strasbourg. Utilisation de l\'émulateur MARS et première approche de 
    l\'assembleur MIPS.'
            ],
            [
                'img' => 'assets/img/sokoban.png" alt="Image de l\'affichage du sokoban',
                'title' => 'Sokoban',
                'prog' => ['C', 'GitLab', 'Makefile'],
                'content' => 'Projet réalisé dans le cadre de l\' UE Techniques de développement pour la L2S3 Informatique à 
                l\' UFR Mathématique et Informatique Strasbourg. Première approche de Git. Utilisation 
                de la SDL2 pour la partie graphique.'
            ],
            [
                'img' => 'assets/img/monnaie.png" alt="Image de l\'affichage du jeu de rendu de monnaie',
                'title' => 'Rendu de monnaie',
                'prog' => ['HTML', 'CSS', 'Javascript'],
                'content' => 'Projet réalisé dans le cadre de l\' UE Programmation Web 1 pour la L1S2 Informatique à 
                l\' UFR Mathématique et Informatique Strasbourg. Jeu d\'un tiroir caisse dont le but est de rendre le 
                montant exact de monnaie.'
            ],
            [
                'img' => 'assets/img/snake.png" alt="Image de l\'affichage du jeu snake',
                'title' => 'Snake',
                'prog' => ['Assembleur MIPS'],
                'content' => 'Le fameux jeu du snake implémenté en assembleur MIPS ! Lancement du projet avec l\'émulateur MARS. 
                Utilisation de bitmap display pour la partie graphique. Projet réalisé dans le cadre de l\' UE Architecture des ordinateurs.'
            ],
            [
                'img' => 'assets/img/graph.png" alt="Image de l\'affichage du projet d\'un graphe',
                'title' => 'Graphe de relations',
                'prog' => ['Structures de données', 'C', 'Graphe'],
                'content' => 'Projet réalisé dans le cadre de l\' UE Structures de données et algorithmes 2 pour la L2S4 Informatique à 
                l\' UFR Mathématique et Informatique Strasbourg. Implémentation d\'un graphe simple non orienté valué.'
            ],
            [
                'img' => 'assets/img/chess.png" alt="Image de l\'affichage du jeu d\'échecs',
                'title' => 'Jeu d\'échecs',
                'prog' => ['Java'],
                'content' => 'Projet réalisé dans le cadre de l\' UE Programmation orientée objets 2 pour la L2S4 Informatique à 
                l\' UFR Mathématique et Informatique Strasbourg. Conception d\'une application graphique d\'un jeu d\'échecs avec JPanel.'
            ],
        ];

        // insère les projets dans la table project
        foreach ($projects_value as $project) {
            $stmt = $this->pdo->prepare(
                'INSERT INTO project (img, title, prog, content) VALUES (:img, :title, :prog, :content)'
            );
            $stmt->bindValue('img', $project['img'], PDO::PARAM_STR);
            $stmt->bindValue('title', $project['title'], PDO::PARAM_STR);
            $stmt->bindValue('prog', implode(',', $project['prog']), PDO::PARAM_STR);
            $stmt->bindValue('content', $project['content'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }


    public function getProjects($start = null, $limit = null): array
    {
        $sql = 'SELECT * FROM project';
        if ($start !== null && $limit !== null) {
            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        }
        $stmt = $this->pdo->query($sql);

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($projects as &$project) {
            $project['prog'] = explode(',', $project['prog']);
        }

        return $projects;
    }

    public function getProject($id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM project WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        return $project ? $project : null;
    }

    public function getProjectTableSize(): int
    {
        return $this->pdo->query('SELECT COUNT(*) FROM project')
            ->fetchColumn();
    }
}