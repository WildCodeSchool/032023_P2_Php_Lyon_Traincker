<?php

namespace App\Controller;

use App\Model\TrainManager;

class AdminTrainController extends AbstractController
{
    public function showTrain(): string
    {
        $trainManager = new TrainManager();
        $number = $trainManager->selectAll();

        return $this->twig->render('Admin/adminTrain.html.twig', [
            'trains' => $number,]);
    }

    public function deleteTrain(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $trainManager = new TrainManager();
            $trainManager->delete((int)$id);

            header('Location:/admin/train');
        }
    }

    public function addTrain(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $train = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $trainManager = new TrainManager();
            $trainManager->insert($train);

            header('Location:/admin/train');
            return null;
        }

        return $this->twig->render('Admin/adminTrain.html.twig');
    }
}
