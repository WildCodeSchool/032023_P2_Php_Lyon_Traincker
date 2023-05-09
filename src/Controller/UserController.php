<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Service\UserService;

class UserController extends AbstractController
{
    public function login(): string
    {
        $userService = new UserService();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $userService->loginVerification($credentials);

            if (empty($userService->errors)) {
                $userManager = new UserManager();
                $user = $userManager->selectOneByEmail($credentials['login']);
                if (
                    $user && $credentials['login'] === 'traincker@traincker.com'
                    && $credentials['password'] === 'traincker'
                ) {
                    // Redirect user to admin page if email and password match
                    header('Location: /admin/dashboard');
                    exit;
                } elseif ($user && password_verify($credentials['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /');
                    exit();
                }
                $userService->errors[] = 'Email ou mot de passe invalide !';
            }
        }

        return $this->twig->render('User/login.html.twig', ['errors' => $userService->errors]);
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_id']);
        header('Location: /');
    }

    public function register()
    {
        $userService = new UserService();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $userService->registerVerification($credentials);

            $userManager = new UserManager();
            $existingUser = $userManager->selectOneByEmail($credentials['login']);
            if ($existingUser) {
                $userService->errors[] = 'Cette adresse e-mail est déjà utilisée';
            }
            if (empty($userService->errors)) {
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

        return $this->twig->render('User/login.html.twig', ['errors' => $userService->errors]);
    }

    public function showUser(): string
    {
        $userManager = new UserManager();
        $user = $userManager->selectAll();

        return $this->twig->render('Admin/adminUser.html.twig', [
            'users' => $user,]);
    }
}
