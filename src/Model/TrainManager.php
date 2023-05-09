<?php

namespace App\Model;

class TrainManager extends AbstractManager
{
    public const TABLE = 'train';

    public function insert(array $train): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`number`) VALUES (:number)");
        $statement->bindValue('number', $train['number'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function getNumberOfTrain(): int
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as count FROM " . static::TABLE);
        $statement->execute();
        $data = $statement->fetch();
        $numberOfTrain = $data['count'];
        return $numberOfTrain;
    }
}
