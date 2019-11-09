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
     * reservation id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
   
    /**
     * place
     * @ORM\Column(type="integer") 
     */
    protected $place;
    
    /**
     * plate number
     * @ORM\Column(type="string")
     */
    protected $plate_number;
    
    /**
     * datetime from
     * @ORM\Column(type="datetime")
     */
    protected $datetime_from;
    
    /**
     * datetime to
     * @ORM\Column(type="datetime")
     */
    protected $datetime_to;
    

    /**
     * set plate number
     * @param string $plate_number
     * @return $this
     */
    public function setPlateNumber(string $plate_number)
    {
        $this->plate_number = $plate_number;
        return $this;
    }
    
    /**
     * set datetime from
     * @param Nette\Utils\DateTime $datetime_from
     * @return $this
     */    
    public function setDatetimeFrom($datetime_from)
    {
        $this->datetime_from = $datetime_from;
        return $this;
    }
    
    /**
     * set datetime to
     * @param Nette\Utils\DateTime $datetime_to
     * @return $this
     */
    public function setDatetimeTo($datetime_to)
    {
        $this->datetime_to = $datetime_to;
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
}