<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';
    public function selectOneByEmail(string $login): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE login=:login");
        $statement->bindValue(':login', $login, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function getNumberOfUsers(): int
    {
        $statement = $this->pdo->query("SELECT COUNT(*) as count FROM " . static::TABLE);
        $data = $statement->fetch();
        $numberOfUser = $data['count'];
        return $numberOfUser;
    }
    public function insert(array $credentials): int
    {
        $statement = $this->pdo->prepare("
        INSERT INTO 
        " . static::TABLE . "
        (`login`, `password`, `username` )
        VALUES
        (:login, :password, :username)
        ");
        $statement->bindValue(':login', $credentials['login']);
        $statement->bindValue(':password', password_hash($credentials['password'], PASSWORD_DEFAULT));
        $statement->bindValue(':username', $credentials['username']);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
