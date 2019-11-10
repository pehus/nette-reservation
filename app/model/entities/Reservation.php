<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="reservation")
 * @ORM\Entity
 */
class Reservation extends \Kdyby\Doctrine\Entities\BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="plate_number", type="string")
     */
    protected $plateNumber;
    
    /**
     * @ORM\Column(name="place", type="integer")
     */
    protected $place;
    
    /**
     * set plate number
     * @param string $plateNumber
     * @return $this
     */
    public function setPlateNumber($plateNumber)
    {
        $this->plateNumber = $plateNumber;
        return $this;
    }
    
    /**
     * set place
     * @param integer $place
     * @return $this
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }
    
    /**
     * get id reservation
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
