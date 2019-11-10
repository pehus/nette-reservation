<?php

namespace App\Presenters;

use App\Model\Facades;
use Nette\Utils\DateTime;
use App\Forms;
use App\Components;

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
    public function renderDefault(): void
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
    private function pagination(): array
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
    private function selectedDate($next, $page): DateTime
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
     * @param Facades\PlaceFacade
     * @param Facades\ReservationFacade
     * @param Forms\ReservationFormFactory
     */
    protected function createComponentPlaces(): Components\Place\PlaceControl
    {
        return new Components\Place\PlaceControl($this->placeFacade, $this->reservationFacade, $this->reservationFormFactory);
    }
    
    /**
     * create component reservation form
     * @return \Nette\Application\UI\Form
     * @throws Exception
     */
    protected function createComponentReservationForm(): \Nette\Application\UI\Form
    {
        $control = $this->reservationFormFactory->create();
        $control->onSuccess[] = function (\Nette\Application\UI\Form $form, $values) {
                       
            try 
            {          
                $dateFrom = DateTime::createFromFormat('d.m.Y', $values->start);
                $dateTo = DateTime::createFromFormat('d.m.Y', $values->end);

                $this->reservationFacade->create($dateFrom, $dateTo, $values->plate_number, (int)$values->place);
                $this->flashMessage('Reservation was added');
                $this->redirect('Homepage:');
            } 
            catch (Exception $exc) 
            {
                Debugger::log($exc);
                throw new Exception('create reservation', $exc);
            }
        };
        
        return $control;
    }
}
