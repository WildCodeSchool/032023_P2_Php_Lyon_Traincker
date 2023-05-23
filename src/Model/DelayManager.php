<?php

namespace App\Model;

class DelayManager extends AbstractManager
{
    public const TABLE = 'delay';

    /* Insert new delay in database */

    public function insert(array $delay): int
    {

        $statement = $this->pdo->prepare("INSERT INTO "
            . self::TABLE . " (`date`, `train_id`) VALUES (CURRENT_DATE(), :train_id)");
        $statement->bindValue(':train_id', $delay['train_id'], \PDO::PARAM_INT);

        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
