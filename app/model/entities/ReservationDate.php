<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="reservation_date")
 * @ORM\Entity
 */
class ReservationDate extends \Kdyby\Doctrine\Entities\BaseEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     */
    protected $reservationId;
    
    /**
     * @ORM\Column(name="date", type="date")
     */
    protected $date;
    
    /**
     * set reservation id
     * @param integer $reservationId
     * @return $this
     */
    public function setReservationId($reservationId)
    {
        $this->reservationId = $reservationId;
        return $this;
    }
    
    /**
     * set date
     * @param Nette\Utils\DateTime $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
}
