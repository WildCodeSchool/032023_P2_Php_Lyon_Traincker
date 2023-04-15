<?php

namespace App\Model;

use PDO;

class TransitManager extends AbstractManager
{
    public const TABLE = 'transit';

    public function selectStationByTrainId(int $stationId): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE stationid=:stationid");
        $statement->bindValue('stationid', $stationId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}