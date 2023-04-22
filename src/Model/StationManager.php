<?php

namespace App\Model;

class StationManager extends AbstractManager
{
    public const TABLE = 'station';

    public function selectAll(string $orderBy = 'name', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
