<?php

namespace App\Model;

class TransitManager extends AbstractManager
{
    public const TABLE_TRANSIT = 'transit';
    public const TABLE_TRAIN = 'train';
    public const TABLE_STATION = 'station';
    public const TABLE_DELAY = 'delay';
    public const TABLE_BOOKMARK = 'bookmark';

    public function selectAllByStationId(int $id, string $orderBy)
    {

        // prepared request
        $statement = $this->pdo->prepare("

            SELECT DISTINCT
                transit.id as transit_id,
                train.number as train_number,
                train.id as train_id,
                station.name as station_name,
                transit.transit_time as transit_time,
                destination,
                date,
                bookmark.transit_id as bookmarked,
                
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

                        LEFT JOIN " . static::TABLE_BOOKMARK . "
                            ON bookmark.transit_id = transit.id

            WHERE station.id=:id 
            AND
                (
                    (date IS NOT NULL AND (transit_time + INTERVAL 1 HOUR) > NOW())
                    or
                    (date IS NULL AND (transit_time + INTERVAL 15 MINUTE) > NOW())
                )
            ORDER BY " . $orderBy . " ASC
            
        ");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectStopsByTrainId()
    {
        $query = "
            SELECT
                DATE_FORMAT(transit.transit_time, '%H:%i') as transit_time,
                station.name as station_name,
                transit.train_id as train_id

            FROM " . static::TABLE_TRANSIT . "

            JOIN " . static::TABLE_STATION . "
                ON transit.station_id = station.id

            ORDER BY transit_time
        ";

        return $this->pdo->query($query)->fetchAll();
    }
}
