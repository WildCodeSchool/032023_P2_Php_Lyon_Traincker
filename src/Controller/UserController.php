<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            if (!isset($credentials['login']) || empty($credentials['login'])) {
                $errors[] = 'Remplissez le champ email !';
            }
            if (!isset($credentials['password']) || empty($credentials['password'])) {
                $errors[] = 'Remplissez le mot de passe !';
            }

            if (empty($errors)) {
                $userManager = new UserManager();
                $user = $userManager->selectOneByEmail($credentials['login']);

                if ($user && password_verify($credentials['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /');
                    exit();
                }
                $errors[] = 'Email ou mot de passe invalide !';
            }
        }

        return $this->twig->render('User/login.html.twig', [
            'errors' => $errors
        ]);
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_id']);
        header('Location: /');
    }

    public function register()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            // Validation de l'adresse e-mail
            if (!filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Adresse e-mail invalide';
            }

            if (empty($errors)) {
                $userManager = new UserManager();
                if ($userManager->insert($credentials)) {
                    return $this->login();
                }
                $user = $userManager->selectOneByEmail($credentials['login']);
                if ($user && password_verify($credentials['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /');
                }
                return $this->twig->render('User/login.html.twig');
            }
        }

        return $this->twig->render('User/login.html.twig', [
            'errors' => $errors
        ]);
    }
}
