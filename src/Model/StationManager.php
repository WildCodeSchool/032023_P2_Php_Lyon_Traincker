<?php

namespace App\Model;

class StationManager extends AbstractManager
{
    public const TABLE = 'station';

    public function insert(array $station): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $station['name'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function getNumberOfStation(): int
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as count FROM " . static::TABLE);
        $statement->execute();
        $data = $statement->fetch();
        $numberOfStation = $data['count'];
        return $numberOfStation;
    }
}
