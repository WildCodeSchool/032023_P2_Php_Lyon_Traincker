<?php

namespace App\Model;

use PDO;

class TransitManager extends AbstractManager
{
    public const TABLE = 'transit';

    public function selectTrainbyStationID(int $stationId): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT trainid FROM " . static::TABLE . " WHERE stationid=:stationid");
        $statement->bindValue('stationid', $stationId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectStationsByTrainID(int $trainId): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT stationid FROM " . static::TABLE . " WHERE trainid=:trainid");
        $statement->bindValue('trainid', $trainId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}