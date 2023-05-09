<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectOneByEmail(string $email): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE login=:email");
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function getNumberOfUsers(): int
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as count FROM " . static::TABLE);
        $statement->execute();
        $data = $statement->fetch();
        $numberOfUser = $data['count'];
        return $numberOfUser;
    }
}
