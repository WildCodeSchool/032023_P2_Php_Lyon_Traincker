<?php

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $homeManager = new HomeManager();
        $station = $homeManager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['stations' => $station]);
    }
}
