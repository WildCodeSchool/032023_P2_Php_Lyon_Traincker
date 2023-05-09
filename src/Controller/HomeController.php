<?php

namespace App\Controller;

use App\Model\BookmarkManager;
use App\Model\StationManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $stationManager = new StationManager();
        $station = $stationManager->selectAll('name');

        $bookmarks = null;

        if (isset($_SESSION['user_id'])) {
            $bookmarkManager = new BookmarkManager();
            $bookmarks = $bookmarkManager->selectBookmarks('depart_station');
        }

        return isset($_SESSION['user_id']) ?

        $this->twig->render('Home/index.html.twig', [
            'stations' => $station,
            'bookmarks' => $bookmarks
        ]) :
        $this->twig->render('Home/index.html.twig', [
            'stations' => $station
        ]);
    }
}
