<?php

namespace App\Controller;

use App\Model\TrainManager;
use App\Model\StationManager;
use App\Model\TransitManager;
use App\Model\DelayManager;

class TimesheetController extends AbstractController
{
    public function show(int $id): string
    {
        $stationManager = new stationManager();
        $stationById = $stationManager->selectOneById($id);
        $stations = $stationManager->selectAll('name');

        $trainManager = new TrainManager();
        $trains = $trainManager->selectAll('number');

        $transitManager = new TransitManager();
        $cardDatas = $transitManager->selectAllByStationId($id, 'departure_time');



        return $this->twig->render('Timesheet/train-list.html.twig', [
            'stationById' => $stationById,
            'stations' => $stations,

            'trains' => $trains,

            'cardDatas' => $cardDatas,


        ]);
    }
}
