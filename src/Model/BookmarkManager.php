<?php

namespace App\Model;

class BookmarkManager extends AbstractManager
{
    public const TABLE = 'bookmark';

    /* Insert bookmark in database */

    public function insert(array $bookmark): int
    {

        $statement = $this->pdo->prepare("
            INSERT INTO 
            " . self::TABLE . " 
            (train_id) 
            VALUES 
            (:train_id)
        ");
        
        $statement->bindValue(':train_id', $bookmark['train_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
