<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($credentials['login']);
            if ($user && password_verify($credentials['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                exit();
            } else {
                die("C'est pas le bon mot de passe !");
            }
        }

        return $this->twig->render('User/login.html.twig');
    }
}
