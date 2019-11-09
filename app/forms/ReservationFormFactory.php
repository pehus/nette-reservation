<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use App\Forms;


final class ReservationFormFactory
{
    use Nette\SmartObject;

    /** @var FormFactory */
    private $factory;
    
    /**
     * @param Forms\FormFactory $factory
     */
    public function __construct(FormFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Form
     */
    public function create(): Form
    {        
        $form = $this->factory->create();
        $form->addHidden('place');
        
        $form->addText('plate_number', 'Plate Code:')
                ->setRequired('Please enter your plate code.');

        $form->addText('date_from', 'Date from:')
                ->setAttribute('data-provide', 'datepicker')
                ->setAttribute('readonly')
                ->setRequired('Please enter date from.');

        $form->addText('date_to', 'Date to:')
                ->setAttribute('data-provide', 'datepicker')
                ->setAttribute('readonly')
                ->setRequired('Please enter date to.');

        $form->addSubmit('send', 'Submit');

        $form->onValidate[] = function(\Nette\Application\UI\Form $form, $values) {
            
            if($values->place < 1)
            {
                throw new Nette\Neon\Exception('Bad place');
            }
            
            if(!$values->date_from instanceof Nette\Utils\DateTime)
            {
                //throw new Nette\Neon\Exception('Bad format date from');
            }
            
            if(!$values->date_to instanceof Nette\Utils\DateTime)
            {
                //throw new Nette\Neon\Exception('Bad format date to');
            }
            
        };


        return $form;
    }
}
