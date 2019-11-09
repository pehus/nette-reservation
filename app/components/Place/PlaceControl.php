<?php
namespace App\Components\Place;

use Nette\Http\Request;
use App\Model\Facades;
use App\Forms;
use Tracy\Debugger;

class PlaceControl extends \App\Components\BaseControl
{	        
    /** @var Facades\HockeyFacade */
    public $placeFacade;
    
    /**  @var Forms\ReservationFormFactory */
    public $reservationFormFactory;

    /** @var Facades\ReservationFacade */
    public $reservationFacade;
    
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
     * render place
     * @return void
     */
    public function render(): void
    {            
        $parameters = $this->getPresenter()->getParameters();
        $template = $this->template;
        $template->setFile(__DIR__ . '/place.latte');
        $places = $this->placeFacade->getPlaces(null);
        $template->places = $places;
        $template->render();
    }
}
