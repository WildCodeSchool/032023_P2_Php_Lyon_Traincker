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

            FROM " . static::TABLE_DELAY . "

            RIGHT JOIN " . static::TABLE_TRAIN . "
            ON (train.id = delay.train_id AND date = current_date())

                JOIN " . static::TABLE_TRANSIT . "
                    ON transit.train_id = train.id

                    JOIN " . static::TABLE_STATION . " 
                        ON station.id = transit.station_id

                       

                       
            WHERE station.id=:id 
            ORDER BY " . $orderBy . " ASC
            
            
        ");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
