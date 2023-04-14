<?php

namespace App\Controller;

use App\Model\TimesheetManager;

class TimesheetController extends AbstractController
{
    public function index(): string
    {
        $timesheetManager = new TimesheetManager();
        $testest = $timesheetManager->selectAll();

        return $this->twig->render('Timesheet/index.html.twig', ['testests' => $testest]);
    }

    public function show(int $id): string
    {
        $timesheetManager = new TimesheetManager();
        $testest = $timesheetManager->selectOneById($id);

        return $this->twig->render('Timesheet/list.html.twig', ['testest' => $testest]);
    }
}
