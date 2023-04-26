<?php

namespace App\Model;

class DelayManager extends AbstractManager
{
    public const TABLE_DELAY = 'delay';
    public const TABLE_TRAIN = 'train';

    public function selectDelayId(int $id): array
    {

        $statement = $this->pdo->prepare("

            SELECT EXISTS ( 
            
            SELECT *                 

            FROM " . static::TABLE_DELAY . "

            JOIN " . static::TABLE_TRAIN . "
            ON train.id=delay.train_id

            WHERE train_id=:id 
            
            ) as late_exists
           
        ");
        //  AND DATE(date) = DATE(NOW()) 
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
