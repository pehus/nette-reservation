<?php

namespace App\Model\Facades;

use Kdyby\Doctrine\EntityManager;
use App\Model\Entities\Reservation;
use Nette\Utils\DateTime;

class ReservationFacade
{    
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
     * get reservation by Id
     * @param int $reservationId
     * @return Reservation|NULL
     */
    public function getReservationById($reservationId)
    {
        return $this->entityManager->find(Reservation::class, $reservationId);
    }
    
    /**
     * get all reservations
     * @return array
     */
    public function getReservations()
    {
        $em = $this->entityManager->getRepository(Reservation::class);
        return $em->findAll();        
    }
    
    /**
     * create reservation
     * @param Nette\Utils\DateTime $from
     * @param Nette\Utils\DateTime $to
     * @param string $plateNumber
     * @param integer $place
     */
    public function create($from, $to, $plateNumber, $place) : void
    {
        $reservation = new Reservation();
        $this->entityManager->persist($reservation);
        
        $reservation
                ->setPlateNumber($plateNumber)                
                ->setDatetimeFrom($from)
                ->setPlace($place)
                ->setDatetimeTo($to);
        
        $this->entityManager->flush();
    }
    
    /**
     * delete reservation
     * @param int $id
     */
    public function delete($id)
    {
        $reservation = $this->entityManager->find(Reservation::class, $id);
        $this->entityManager->remove($reservation);
        $this->entityManager->flush();
    }
    
    /**
     * 
     * @param type $id
     * @param type $from
     * @param type $to
     * @param type $plateNumber
     */
    public function edit($id, $from, $to, $plateNumber) : void
    {
        $reservation = $this->entityManager->getReference(Reservation::class, $id);
        $reservation->setPlateNumber($plateNumber);
        $this->entityManager->flush();
    }
    
}
