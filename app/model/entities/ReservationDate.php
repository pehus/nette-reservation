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
     * reservation id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
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
}