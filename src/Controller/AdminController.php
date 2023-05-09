<?php

namespace App\Controller;

use App\Model\StationManager;
use App\Model\TrainManager;
use App\Model\TransitManager;
use App\Model\UserManager;

class AdminController extends AbstractController
{
    public function showStation(): string
    {
        $stationManager = new StationManager();
        $station = $stationManager->selectAll('name');

        return $this->twig->render('Admin/adminStation.html.twig', [
            'stations' => $station,]);
    }

    public function deleteStation(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $stationManager = new StationManager();
            $stationManager->delete((int)$id);

            header('Location:/admin');
        }
    }

    /**
     * Add a new station
     */
    public function addStation(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $station = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $stationManager = new StationManager();
            $stationManager->insert($station);

            header('Location:/admin');
            return null;
        }

        return $this->twig->render('Admin/adminStation.html.twig');
    }

    //-----------------------------------train-----------------------------------//

    public function showTrain(): string
    {
        $trainManager = new TrainManager();
        $number = $trainManager->selectAll('number');

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

    //----------------------------------transit----------------------------------//

    public function showTransit(): string
    {
        $transitManager = new TransitManager();
        $transit = $transitManager->selectAll();

        return $this->twig->render('Admin/adminTransit.html.twig', [
            'transits' => $transit,]);
    }

    public function deleteTransit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $transitManager = new TransitManager();
            $transitManager->delete((int)$id);

            header('Location:/admin/transit');
        }
    }

    public function addTransit(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $transit = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $transitManager = new TransitManager();
            $transitManager->insert($transit);

            header('Location:/admin/transit');
            return null;
        }

        return $this->twig->render('Admin/adminTransit.html.twig');
    }

//--------------------------Dashboard-----------------------------//

    public function showDashboard(): string
    {
        $userManager = new UserManager();
        $numberOfUser = $userManager->getNumberOfUsers();

        $stationManager = new StationManager();
        $numberOfStation = $stationManager->getNumberOfStation();

        $trainManager = new TrainManager();
        $numberOfTrain = $trainManager->getNumberOfTrain();

        $transitManager = new TransitManager();
        $numberOfTransit = $transitManager->getNumberOfTransit();

        return $this->twig->render('Admin/dashboard.html.twig', [
        'numberOfUser' => $numberOfUser,
        'numberOfStation' => $numberOfStation,
        'numberOfTrain' => $numberOfTrain,
        'numberOfTransit' => $numberOfTransit,]);
    }
}
