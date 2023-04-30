<?php

namespace App\Model;

class BookmarkManager extends AbstractManager
{
    public const TABLE_BOOKMARK = 'bookmark';
    public const TABLE_TRANSIT = 'transit';
    public const TABLE_TRAIN = 'train';
    public const TABLE_STATION = 'station';

    /* Insert bookmark in database */

    public function insert(array $bookmark): int
    {
        $statement = $this->pdo->prepare("
            INSERT INTO 
            " . self::TABLE_BOOKMARK . " 
            (transit_id) 
            VALUES 
            (:transit_id)
        ");

        $statement->bindValue(':transit_id', $bookmark['transit_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectBookmarks($orderBy)
    {
        $statement = $this->pdo->prepare("
            SELECT
                train.number as train_number,
                station.name as station_name,
                destination,
                DATE_FORMAT(
                    transit.transit_time, 
                    '%H:%i') 
                    as departure_time

            FROM " . self::TABLE_TRANSIT . "

            JOIN " . self::TABLE_BOOKMARK . "
                ON bookmark.transit_id = transit.id

            JOIN " . self::TABLE_TRAIN . "
                ON train.id = transit.train_id

            JOIN " . self::TABLE_STATION . "
                ON station.id = transit.station_id

            WHERE bookmark.transit_id = transit.id

            GROUP BY bookmark.transit_id
            ORDER BY " . $orderBy . " ASC
        ");

        $statement->execute();

        return $statement->fetchAll();
    }
}
