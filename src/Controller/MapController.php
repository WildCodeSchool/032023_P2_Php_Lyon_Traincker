<?php

namespace App\Controller;
use App\Model\StationManager;
use GdImage;

class MapController extends AbstractController
{

    public function getStations(): array
    {
        $stationManager = new StationManager();
        $stations = $stationManager->selectAll('name');

        return $stations;
    }

    public function getptCoordinates(int $xMin, int $xMax, int $yMin, int $yMax) :array
    {
        $stations = $this->getStations();
        
        $x = random_int($xMin, $xMax);
        $y = random_int($yMin, $yMax);

        foreach ($stations as $station)
        {
            $ptCoordinates[] = [$station['name'] => [$x, $y]];
        };

        return $ptCoordinates;
    }
}