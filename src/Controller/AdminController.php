<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function admin(): string
    {
        $adminManager = new AdminManager();
        $station = $adminManager->selectAll('name');

        return $this->twig->render('Admin/admin.html.twig', [
            'stations' => $station,]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $adminManager = new AdminManager();
            $adminManager->delete((int)$id);

            header('Location:/Admin/admin.html.twig');
        }
    }
}
