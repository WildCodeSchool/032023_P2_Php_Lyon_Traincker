<?php

namespace App\Controller;

use App\Model\TrainManager;
use App\Model\StationManager;

class TimesheetController extends AbstractController
{
    public function show(int $id): string
    {
        $stationManager = new stationManager();
        $stationByID = $stationManager->selectOneById($id);
        $stations = $stationManager->selectAll('name');
        $stations = $stationManager->selectAll('id');

        $trainManager = new TrainManager();
        $trains = $trainManager->selectAll('number');

        return $this->twig->render('Timesheet/train-list.html.twig', [
            'stationByID' => $stationByID,
            'stations' => $stations,

            'trains' => $trains
        ]);
    }
}
