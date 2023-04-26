<?php

namespace App\Model;

class TransitManager extends AbstractManager
{
    public const TABLE_TRANSIT = 'transit';
    public const TABLE_TRAIN = 'train';
    public const TABLE_STATION = 'station';

    public function selectAllByStationId(int $id, string $orderBy)
    {

        // prepared request
        $statement = $this->pdo->prepare("

            SELECT 
                train.number as train_number,
                station.name as station_name,
                destination,
                train.is_late as is_late,

                DATE_FORMAT(
                    transit.transit_time, 
                    '%H:%i') 
                    as departure_time

            FROM " . static::TABLE_TRANSIT . "

                JOIN " . static::TABLE_TRAIN . "
                    ON train.id=transit.train_id

                    JOIN " . static::TABLE_STATION . " 
                        ON transit.station_id=station.id

            WHERE transit.station_id=:id
            ORDER BY " . $orderBy . " ASC
        ");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
