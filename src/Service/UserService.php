<?php

namespace App\Service;

class UserService
{
    public array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function loginVerification(array $credentials): void
    {
        if (!isset($credentials['login']) || empty($credentials['login'])) {
            $this->errors[] = 'Remplissez le champ email !';
        }
        if (!isset($credentials['password']) || empty($credentials['password'])) {
            $this->errors[] = 'Remplissez le mot de passe !';
        }
    }
}
