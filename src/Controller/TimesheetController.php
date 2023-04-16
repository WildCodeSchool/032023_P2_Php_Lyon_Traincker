<?php

namespace App\Controller;

use App\Model\TrainManager;
use App\Model\StationManager;
use App\Model\TransitManager;

class TimesheetController extends AbstractController
{
    public function index(): string
    {
        $trainManager = new TrainManager();
        $trains = $trainManager->selectAll('number');

        $stationManager = new StationManager();
        $stations = $stationManager->selectAll('name');

        $stationManager = new StationManager();
        $stations = $stationManager->selectAll('id');

        return $this->twig->render('Timesheet/index.html.twig', [
            'trains' => $trains,
            'stations' => $stations
        ]);
    }

    public function show(int $id): string
    {
        $stationManager = new stationManager();
        $stationByID = $stationManager->selectOneById($id);
        $stations = $stationManager->selectAll('name');
        $stations = $stationManager->selectAll('id');

        $trainManager = new TrainManager();
        $trains = $trainManager->selectAll('number');

        // --- transits --------------

        $transitManager = new TransitManager();
        $transits = $transitManager->selectAll('trainid');
        $transits = $transitManager->selectAll('stationid');
        $transits = $transitManager->selectAll('transittime');
        $transitByID = $transitManager->selectOneById($id);

        return $this->twig->render('Timesheet/train-list.html.twig', [
            'stationByID' => $stationByID,
            'stations' => $stations,

            'trains' => $trains,

            'transits' => $transits,
            'transitByID' => $transitByID,
        ]);
    }
}
