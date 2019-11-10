<?php

namespace App\Model\Facades;

use Kdyby\Doctrine\EntityManager;
use App\Model\Entities;
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
    public function getReservations(): array
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
    public function create($from, $to, $plateNumber, $place): void
    {       
        try 
        {
            $reservation = new Entities\Reservation();
                $reservation
                    ->setPlace($place)
                    ->setPlateNumber($plateNumber);
                $this->entityManager->persist($reservation);
             $this->entityManager->flush();
            
            $days = $from->diff($to)->days;
            for($i = 0; $i <= $days; $i++)
            {
                $reservationDate = new Entities\ReservationDate();
                $reservationDate
                        ->setDate($from->modifyClone("$i day"))
                        ->setReservationId($reservation->getId());
                $this->entityManager->persist($reservationDate);
            }
            
            $this->entityManager->flush();
        } 
        catch (Exception $exc) 
        {
            throw new Exception('create reservation', $exc);
        }
    }
    
    /**
     * delete reservation
     * @param int $id
     */
    public function delete($id): void
    {
        $reservation = $this->entityManager->find(Reservation::class, $id);
        $this->entityManager->remove($reservation);
        $this->entityManager->flush();
    }
    
    /**
     * edit reservation
     * @param type $id
     * @param type $from
     * @param type $to
     * @param type $plateNumber
     */
    public function edit($id, $from, $to, $plateNumber): void
    {
        //@todo:
        $reservation = $this->entityManager->getReference(Reservation::class, $id);
        $reservation->setPlateNumber($plateNumber);
        $this->entityManager->flush();
    }
    
}
