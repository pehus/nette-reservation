<?php

namespace App\Presenters;

use App\Model\Facades;
use Nette\Utils\DateTime;
use App\Forms;

final class HomepagePresenter extends BasePresenter
{
    /**
     * @inject
     * @var \Kdyby\Doctrine\EntityManager
     */
    public $entityManager;
    
    /**
     * @inject
     * @var Facades\ReservationFacade
     */
    public $reservationFacade;
    
    /**
     * @inject
     * @var Facades\PlaceFacade
     */
    public $placeFacade;
    
    /**
     * @inject
     * @var Forms\ReservationFormFactory
     */
    public $reservationFormFactory;
    
    /**
     * render default
     */
    public function renderDefault() : void
    {
        $pagination = $page = $this->pagination();

        $this->template->prev = $pagination['prev'];
        $this->template->next = $pagination['next'];
        $this->template->date = $pagination['selected_page'];
    }
    
    /**
     * pagination
     * @return array
     */
    private function pagination() : array
    {
        $page = $this->getParameter('page');   
  
        if(is_numeric($page) && $page > 0)
        {
            $up = ($page + 1);
            $down = ($page - 1);
            
            if($page <= 1)
            {
                $prev = null;
                $next = $up;
            }
            else
            {
                $prev = $down;
                $next = $up;
            }
        }
        else
        {
            $prev = null;
            $next = 1;
        }
        
        return [
            'selected_page' => $this->selectedDate($next, $page),
            'next' => $next,
            'prev' => $prev
        ];
    }
    
    /**
     * set date
     * @param int $next
     * @param int $page
     * @return \Nette\Utils\DateTime
     */
    private function selectedDate($next, $page) : DateTime
    {        
        $date = new DateTime();
        
        if($next > 1)
        {
            $date->modify("$page day");
        }
        
        return $date;
    }
    
    /**
     * component cube selected tips form
     */
    protected function createComponentPlaces() : \App\Components\Place\PlaceControl
    {
        return new \App\Components\Place\PlaceControl($this->placeFacade, $this->reservationFormFactory);
    }
}
