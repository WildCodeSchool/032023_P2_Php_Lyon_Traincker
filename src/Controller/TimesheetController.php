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

        $bookmarkManager = new BookmarkManager();
        $bookmarks = $bookmarkManager->selectBookmarks('depart_station');

        return $this->twig->render('Timesheet/train-list.html.twig', [
            'stationById' => $stationById,
            'stations' => $stations,
            'trains' => $trains,
            'cardDatas' => $cardDatas,
            'bookmarks' => $bookmarks
        ]);
    }

    public function reportDelay()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $delay = array_map('trim', $_POST);

            $delayManager = new DelayManager();
            $delayManager->insert($delay);
            //---------convert string to int --------------//
            $stationStringId = $delay['station_id'];
            $stationId = (int) $stationStringId;
            header("location: /timesheet/train-list?id=$stationId");
        }
    }

    public function addBookmark()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookmark = array_map('trim', $_POST);

            $bookmarkManager = new BookmarkManager();
            $bookmarkManager->insert($bookmark);

            //---------convert string to int --------------//
            $stationStringId = $bookmark['station_id'];
            $stationId = (int) $stationStringId;
            header("location: /timesheet/train-list?id=$stationId");
        }
    }
}
