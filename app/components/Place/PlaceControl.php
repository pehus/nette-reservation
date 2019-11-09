<?php
namespace App\Components\Place;

use Nette\Http\Request;
use App\Model\Facades;

class PlaceControl extends \App\Components\BaseControl
{	        
    /** @var Facades\HockeyFacade */
    public $placeFacade;

    /**
     * @param \App\Model\Facades\PlaceFacade $placeFacade
     */
    public function __construct(Facades\PlaceFacade $placeFacade)
    {
        $this->placeFacade = $placeFacade;
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

}
