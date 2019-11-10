<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use App\Forms;
use Nette\Utils\DateTime;


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

        $form->addText('start', 'Date from:')
                ->setAttribute('class', 'input-sm form-control')
                ->setAttribute('readonly')
                ->setRequired('Please enter date from.');

        $form->addText('end', 'Date to:')
                ->setAttribute('class', 'input-sm form-control')
                ->setAttribute('readonly')
                ->setRequired('Please enter date to.');

        $form->addSubmit('send', 'Submit');

        $form->onValidate[] = function(\Nette\Application\UI\Form $form, $values) {
            
            if($values->place < 1)
            {
                throw new Nette\Neon\Exception('Bad place');
            }
            
            if(!DateTime::createFromFormat('d.m.Y', $values->start) instanceof Nette\Utils\DateTime)
            {
                throw new Nette\Neon\Exception('Bad format date from');
            }
            
            if(!DateTime::createFromFormat('d.m.Y', $values->end) instanceof Nette\Utils\DateTime)
            {
                throw new Nette\Neon\Exception('Bad format date to');
            }
            
        };


        return $form;
    }
}
