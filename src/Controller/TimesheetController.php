<?php

namespace App\Controller;

use App\Model\TrainManager;
use App\Model\StationManager;
use App\Model\TransitManager;
use App\Model\DelayManager;
use App\Model\BookmarkManager;

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
            $stringId = $delay['station_id'];
            $intValue = (int) $stringId;
            //---------------------------------------------//
            $this->show($intValue);
            header("location: /timesheet/train-list?id=$intValue");
        }
    }

    public function addBookmark()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookmark = array_map('trim', $_POST);

            $bookmarkManager = new BookmarkManager();
            $bookmarkManager->insert($bookmark);

            //---------convert string to int --------------//
            $stringId = $bookmark['station_id'];
            $intValue = (int) $stringId;
            //---------------------------------------------//
            $this->show($intValue);
            header("location: /timesheet/train-list?id=$intValue");
        }
    }
}
