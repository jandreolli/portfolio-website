<?php
require_once 'Database.php';

/* var dump = debug en php (équivalent console.log en js) */
// var_dump($_POST); affiche ce que contient form

class PostForm extends Database
{
    public function __construct()
    {
        $databaseFile = dirname(__FILE__) . '/../db/database.db';
        parent::__construct($databaseFile);
        $this->createTable();
    }

    private function createTable()
    {
        // query traduit entre serveur et sql
        // VARCHAR limité à 250 cara
        $this->pdo->query(
            'CREATE TABLE IF NOT EXISTS message (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            first_name VARCHAR(50) NOT NULL, 
            last_name VARCHAR(50) NOT NULL,
            url_txt VARCHAR(100),
            message_txt TEXT NOT NULL
            )'
        );

    }

    private function getFirstName(): string
    {
        // on récupère les variables --> htmlspecialchars pr faille XSS
        $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; //accède à la clé
        return $firstName;
    }

    private function getLastName(): string
    {
        // on récupère les variables --> htmlspecialchars pr faille XSS
        $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
        return $lastName;
    }

    private function getURL(): ?string
    {
        // écrit null dans tableau si vide
        $url = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : '';
        $url = $url == '' ? null : $url;
        return $url;
    }

    private function getMessage(): string
    {
        $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
        return $message;
    }

    private function checkFirstName(string $firstName): bool
    {
        return preg_match('/^[\S]{1,50}$/', $firstName);
    }

    private function checkLastName(string $lastName): bool
    {
        return preg_match('/^[\S]{1,50}$/', $lastName);
    }

    private function checkURL(?string $url): bool
    {
        return ($url == null || preg_match('/^(?:http|https|ftp):\/\/[\S]{1,92}$/', $url));
    }

    private function checkMessage(string $message): bool
    {
        return $message !== '';
    }

    private function insertData(string $firstName, string $lastName, ?string $url, string $message)
    {
        if (
            $this->checkFirstName($firstName) && $this->checkLastName($lastName) &&
            $this->checkURL($url) && $this->checkMessage($message)
        ) {
            // prepare = pour insérer ou selectionner des données (= sécurisé)
            // VALUES crée des variables : (on choisi même nom)
            $statement = $this->pdo->prepare(
                'INSERT INTO message (first_name, last_name, url_txt, message_txt) 
                VALUES (:first_name, :last_name, :url_txt, :message_txt)'
            );
            // ce sont des string donc PDO::PARAM_STR (on vérifie que string)
            $statement->bindValue('first_name', $firstName, PDO::PARAM_STR);
            $statement->bindValue('last_name', $lastName, PDO::PARAM_STR);
            $statement->bindValue('url_txt', $url, PDO::PARAM_STR);
            $statement->bindValue('message_txt', $message, PDO::PARAM_STR);
            // insère les données entrées dans la bdd
            $statement->execute();
        }
    }

    private function displayMessageDESC(): ?array
    {
        $this->insertData(
            $this->getFirstName(), $this->getLastName(),
            $this->getURL(), $this->getMessage()
        );
        $messages = $this->pdo->query(
            'SELECT * FROM message ORDER BY id DESC'
        )->fetchAll();

        return $messages;
    }

    public function getDisplayMessageDESC(): ?array
    {
        return $this->displayMessageDESC();
    }

}

?>