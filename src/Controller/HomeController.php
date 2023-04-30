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

        $bookmarkManager = new BookmarkManager();
        $bookmarks = $bookmarkManager->selectBookmarks('departure_time');

        return $this->twig->render('Home/index.html.twig', [
            'stations' => $station,
            'bookmarks' => $bookmarks
        ]);
    }
}
