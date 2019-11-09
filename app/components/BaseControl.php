<?php
namespace App\Components;

use Nette;
use Nette\Application\UI\Control;
use Nette\Http\Request;


/**
 * The base control
 */
abstract class BaseControl extends Control
{	
    protected function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $template->addFilter(NULL, ['App\Filter\Filters','common']);
        return $template;
    }
	
}
