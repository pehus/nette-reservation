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
    
    
    private $selectedDate;
    
    /**
     * render default
     */
    public function renderDefault(): void
    {
        $page = $this->getParameter('page'); 
        
        $pagination = $this->pagination($page);
        $selectedDate = $this->selectedDate($pagination['next'], $page);
                
        $this->template->prev = $pagination['prev'];
        $this->template->next = $pagination['next'];
        $this->template->date = $selectedDate;
        $this->selectedDate = $selectedDate;
    }
    
    /**
     * pagination
     * @return array
     */
    private function pagination($page): array
    {  
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
        $placeControl = new Components\Place\PlaceControl($this->placeFacade, $this->reservationFacade, $this->reservationFormFactory);
        $placeControl->setSelectedDate($this->selectedDate);
        
        return $placeControl;
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
                
                $checkIsFree = $this->placeFacade->isFree($values->place, $dateFrom, $dateTo);            
                if($checkIsFree)
                {
                    $this->reservationFacade->create($dateFrom, $dateTo, $values->plate_number, (int)$values->place);
                    $this->flashMessage('Reservation was added');
                    $this->redirect('Homepage:default');
                }
                else
                {
                    $this->flashMessage('Reservation already exists');
                    $this->redirect('Homepage:default');
                }
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
