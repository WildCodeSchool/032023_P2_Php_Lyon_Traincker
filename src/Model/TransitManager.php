<?php

namespace App\Model;

class TransitManager extends AbstractManager
{
    public const TABLE_TRANSIT = 'transit';
    public const TABLE_TRAIN = 'train';
    public const TABLE_STATION = 'station';
    public const TABLE_DELAY = 'delay';

    public function selectAllByStationId(int $id, string $orderBy)
    {

        // prepared request
        $statement = $this->pdo->prepare("

            SELECT DISTINCT
                train.number as train_number,
                train.id as train_id,
                station.name as station_name,
                destination,
                date,
                
                DATE_FORMAT(
                    transit.transit_time, 
                    '%H:%i') 
                    as departure_time

            FROM " . static::TABLE_TRAIN . "

                JOIN " . static::TABLE_TRANSIT . "
                    ON train.id=transit.train_id

                    JOIN " . static::TABLE_STATION . " 
                        ON transit.station_id=station.id

                        LEFT JOIN " . static::TABLE_DELAY . "
                             ON train.id = delay.train_id

                       
            WHERE transit.station_id=:id 
            
            ORDER BY " . $orderBy . " ASC
        ");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
