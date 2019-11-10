<?php

namespace App\Model\Facades;

class PlaceFacade 
{
    const PLACES = 240;

    /**
     * get places
     * @param type $date
     * @return array
     */
    public function getPlaces($date = null): array
    {
        return $this->places();
    }
    
    private function places(): array
    {
        $places = [];
        for($i = 1; $i <= self::PLACES; $i++)
        {
            $places[] = $i; 
        }
        
        return $places;
    }
    
    public function isFree($place, $date_from, $date_to)
    {
        
    }
    
}
