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
        $stationManager = new StationManager();
        $stationById = $stationManager->selectOneById($id);
        $stations = $stationManager->selectAll('name');

        $trainManager = new TrainManager();
        $trains = $trainManager->selectAll('number');

        $transitManager = new TransitManager();
        $cardDatas = $transitManager->selectAllByStationId($id, 'departure_time');
        $bookmarks = null;
        if (isset($_SESSION['user_id'])) {
            $bookmarkManager = new BookmarkManager();
            $bookmarks = $bookmarkManager->selectBookmarks('depart_station');
        }

        return isset($_SESSION['user_id']) ?

        $this->twig->render('Timesheet/train-list.html.twig', [
            'stationById' => $stationById,
            'stations' => $stations,
            'trains' => $trains,
            'cardDatas' => $cardDatas,
            'bookmarks' => $bookmarks
        ]) :
        $this->twig->render('Timesheet/train-list.html.twig', [
            'stationById' => $stationById,
            'stations' => $stations,
            'trains' => $trains,
            'cardDatas' => $cardDatas
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
            $bookmarkManager->insertBookmark($bookmark);

            //---------convert string to int --------------//
            $stationStringId = $bookmark['station_id'];
            $stationId = (int) $stationStringId;
            header("location: /timesheet/train-list?id=$stationId");
        }
    }

    public function removeBookmark()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookmark = array_map('trim', $_POST);

            $bookmarkManager = new BookmarkManager();
            $bookmarkManager->removeBookmark($bookmark);

            //---------convert string to int --------------//
            $stationStringId = $bookmark['station_id'];
            $stationId = (int) $stationStringId;
            header("location: /timesheet/train-list?id=$stationId");
        }
    }
}
