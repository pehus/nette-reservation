<?php
namespace App\Components\Place;

use Nette\Http\Request;
use App\Model\Facades;
use App\Forms;

class PlaceControl extends \App\Components\BaseControl
{	        
    /** @var Facades\HockeyFacade */
    public $placeFacade;
    
    /**  @var Forms\ReservationFormFactory */
    public $reservationFormFactory;

    /**
     * @param \App\Model\Facades\PlaceFacade $placeFacade
     */
    public function __construct(Facades\PlaceFacade $placeFacade, Forms\ReservationFormFactory $reservationFormFactory)
    {
        $this->placeFacade = $placeFacade;
        $this->reservationFormFactory = $reservationFormFactory;
    }

    public function render()
    {            
        $parameters = $this->getPresenter()->getParameters();
        $template = $this->template;
        $template->setFile(__DIR__ . '/place.latte');
        $places = $this->placeFacade->getPlaces(null);
        $template->places = $places;
        $template->render();
    }
    
    protected function createComponentReservationForm()
    {
        $control = $this->reservationFormFactory->create();
        /*$control->onCategorySave[] = function (CategoryControl $control, $category) {
            $this->redirect('this');
            // nebo například přesměrujeme na detail dané kategorie
            // $this->redirect('detail', ['id' => $category->id]);
        };*/

        return $control;
    }

}
