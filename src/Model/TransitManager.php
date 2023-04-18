<?php

namespace App\Model;

class TransitManager extends AbstractManager
{
    public const TABLE_TRANSIT = 'transit';
    public const TABLE_TRAIN = 'train';
    public const TABLE_STATION = 'station';

    public function selectAllByStationId(int $id){

            // prepared request
        $statement = $this->pdo->prepare("

            SELECT 
                train.number as train_number,
                station.name as station_name,

                DATE_FORMAT(
                    date_add(
                        transit.transit_time, 
                        interval 14 minute), 
                    '%H:%i') 
                    as depart_time,

                DATE_FORMAT(
                    transit.transit_time, 
                    '%H:%i') 
                    as arrival_time

            FROM " . static::TABLE_TRANSIT . "

                JOIN " . static::TABLE_TRAIN . "
                    ON train.id=transit.train_id

                    JOIN " . static::TABLE_STATION . " 
                        ON transit.station_id=station.id

            WHERE transit.station_id=:id     
        ");
            
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetchAll();
    }
}