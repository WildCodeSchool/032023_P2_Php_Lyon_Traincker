<?php

namespace App\Controller;

use App\Model\StationManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $stationManager = new StationManager();
        $station = $stationManager->selectAll('name');

        return $this->twig->render('Home/index.html.twig', ['stations' => $station]);
    }
}
