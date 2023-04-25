<?php

namespace App\Controller;

use App\Model\TrainManager;
use App\Model\StationManager;
use App\Model\TransitManager;
use App\Model\DelayManager;
use Seld\JsonLint\Undefined;

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

    public function reportDelay()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $delay = array_map('trim', $_POST);

            $delayManager = new DelayManager();
             $delayManager->insert($delay);
//---------convert string to int --------------//
            $stringId = $delay['station_Id'];
            $intValue = (int) $stringId;
//---------------------------------------------//
            return $this->show($intValue);
        }
    }
}
