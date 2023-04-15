<?php

namespace App\Controller;

use App\Model\TrainManager;
use App\Model\StationManager;
use App\Model\TransitManager;

class TimesheetController extends AbstractController
{
    /**
     * List stations
 */
    // public function station(): string
    // {
    //     $stationManager = new StationManager();
    //     $stations = $stationManager->selectAll('name');

    //     return $this->twig->render('Timesheet/index.html.twig', ['stations' => $stations]);
    // }

    /**
     * List trains
     */
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
            $station = $stationManager->selectOneById($id);
            $stations = $stationManager->selectAll('name');
            $stations = $stationManager->selectAll('id');

            $trainManager = new TrainManager();
            $trains = $trainManager->selectAll('number');

            // --- transits --------------

            $transitManager = new TransitManager();
            $transits = $transitManager->selectAll('trainid');
            $transits = $transitManager->selectAll('stationid');
            $transits = $transitManager->selectAll('transittime');
            $transitItem = $transitManager->selectOneById($id);
    
            return $this->twig->render('Timesheet/train-list.html.twig', [
                'station' => $station,
                'stations' => $stations,

                'trains' => $trains,

                'transits' => $transits,
                'transit' => $transitItem,
            ]);
        }
    }

        /**
     * Show informations for a train
     */
    // public function show(int $id): string
    // {
    //     $trainManager = new TrainManager();
    //     $train = $trainManager->selectOneById($id);

    //     return $this->twig->render('Timesheet/show.html.twig', ['train' => $train]);
    // }
