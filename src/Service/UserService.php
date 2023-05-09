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
        if (!filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Adresse e-mail invalide';
        }
        if (!isset($credentials['password']) || empty($credentials['password'])) {
            $this->errors[] = 'Remplissez le mot de passe !';
        }
    }

    public function registerVerification(array $credentials): void
    {
        if (!isset($credentials['username']) || empty($credentials['username'])) {
            $this->errors[] = 'Remplissez le champ utilisateur !';
        }
        if (!isset($credentials['login']) || empty($credentials['login'])) {
            $this->errors[] = 'Remplissez le champ email !';
        }
        if (!filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Adresse e-mail invalide';
        }
        if (!isset($credentials['password']) || empty($credentials['password'])) {
            $this->errors[] = 'Remplissez le mot de passe !';
        }
    }
}
