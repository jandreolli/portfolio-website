<?php
abstract class Database
{
    protected PDO $pdo;

    public function __construct(string $fileName)
    {
        $this->pdo = new PDO('sqlite:' . $fileName);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>