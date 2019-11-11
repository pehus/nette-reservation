<?php
namespace App\Components\Place;

use Nette\Http\Request;
use App\Model\Facades;
use App\Forms;
use Tracy\Debugger;

class PlaceControl extends \App\Components\BaseControl
{	        
    /** 
     * @var Facades\HockeyFacade 
     */
    public $placeFacade;
    
    /**  
     * @var Forms\ReservationFormFactory 
     */
    public $reservationFormFactory;

    /** 
     * @var Facades\ReservationFacade 
     */
    public $reservationFacade;
    
    /**
     * selected date
     * @var type 
     */
    private $selectedDate;
    
    /**
     * @param Facades\PlaceFacade $placeFacade
     * @param Facades\ReservationFacade $reservationFacade
     * @param Forms\ReservationFormFactory
     */
    public function __construct(
            Facades\PlaceFacade $placeFacade, 
            Facades\ReservationFacade $reservationFacade, 
            Forms\ReservationFormFactory $reservationFormFactory
        )
    {
        $this->placeFacade = $placeFacade;
        $this->reservationFacade = $reservationFacade;
        $this->reservationFormFactory = $reservationFormFactory;
    }
    
    /**
     * set selected date
     * @param type $selectedDate
     * @return void
     */
    public function setSelectedDate($selectedDate): void
    {
        $this->selectedDate = $selectedDate;
    }

    /**
     * render place
     * @return void
     */
    public function render(): void
    {            
        $parameters = $this->getPresenter()->getParameters();
        $template = $this->template;
        $template->setFile(__DIR__ . '/place.latte');
        $places = $this->placeFacade->getPlaces($this->selectedDate);
        $template->places = $places;
        $template->render();
    }
}
