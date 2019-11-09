<?php

namespace App\Model\Facades;

class PlaceFacade 
{
    const PLACES = 240;

    public function getPlaces($date = null)
    {
        return $this->places();
    }
    
    private function places()
    {
        $places = [];
        for($i = 1; $i <= self::PLACES; $i++)
        {
            $places[] = $i; 
        }
        
        return $places;
    }
    
}
