<?php

namespace App\Model\Facades;

use Kdyby\Doctrine\EntityManager;
use App\Model\Entities;
use Nette\Utils\DateTime;

class PlaceFacade 
{
    const PLACES = 240;
    
    /**
     * Manager for works with entities
     * @var EntityManger $entityManager
     */
    private $entityManager;
    
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
     
    /**
     * get places
     * @return array
     */
    public function getPlaces($date = null): array
    {
        $arrayOccupiedPlaces = [];
        if(!is_null($date))
        {
            $occupiedPlaces = $this->getOccupiedPlacesByDate($date);           

            foreach($occupiedPlaces as $place)
            {
                $arrayOccupiedPlaces[] = $place['place'];
            }
        }
        
        return $this->places($arrayOccupiedPlaces);
    }
    
    /**
     * create places
     * @param array $occupiedPlaces
     * @return array
     */
    private function places($occupiedPlaces): array
    {
        $places = [];
        for($i = 1; $i <= self::PLACES; $i++)
        {
            $state = true;
            if(in_array($i, $occupiedPlaces))
            {
                $state = false;
            }
            
            $places[] = [
                'place' => $i,
                'is_free' => $state
            ];
        }
        
        return $places;
    }
    
    /**
     * check place is free
     * @param integer $place
     * @param Nette\Utils\DateTime $date_from
     * @param Nette\Utils\DateTime $date_to
     * @return bool
     */
    public function isFree($place, $date_from, $date_to): bool
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('reservation_date')
            ->from(Entities\ReservationDate::class, 'reservation_date')
            ->innerJoin(Entities\Reservation::class, 'reservation')
            ->where('reservation_date.date BETWEEN :date_from AND :date_to')
            ->andWhere('reservation = :place')
            ->setParameters([
                'date_from' => $date_from->format('Y-m-d'),
                'date_to' => $date_to->format('Y-m-d'), 
                'place' => $place
            ]);
        
        if($qb->getQuery()->getResult())
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * get Occupied places by date
     * @param Nette\Utils\DateTime $date
     * @return array
     */
    public function getOccupiedPlacesByDate($date): array
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('reservation_date.id, reservation_date.date, reservation.place')
            ->from(Entities\Reservation::class, 'reservation')
            ->innerJoin(Entities\ReservationDate::class, 'reservation_date')
            ->where('reservation.id = reservation_date.reservationId')
            ->andWhere('reservation_date.date = :date')
            ->setParameters([
                'date' => $date->format('Y-m-d')
            ]);
                
        return $qb->getQuery()->getResult();
    }
    
}
