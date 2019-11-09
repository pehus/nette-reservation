<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


final class ReservationFormFactory
{
    use Nette\SmartObject;

    /** @var FormFactory */
    private $factory;

    public function __construct(FormFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Form
     */
    public function create()
    {
        $form = $this->factory->create();
        $form->addText('plate_code', 'Plate Code:')
                ->setRequired('Please enter your plate code.');

        $form->addText('date_from', 'Date from:')
                ->setRequired('Please enter date from.');

        $form->addText('date_to', 'Date to:');

        $form->addSubmit('send', 'Submit');

        $form->onSuccess[] = function (Form $form, $values) {
                dump('test');
        };

        return $form;
    }
}
