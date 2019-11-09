<?php
// source: C:\xampp\htdocs\nette-reservation\app/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Templatef41f8a4c46 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'scripts' => 'blockScripts',
		'head' => 'blockHead',
	];

	public $blockTypes = [
		'content' => 'html',
		'scripts' => 'html',
		'head' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
		$this->renderBlock('head', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		/* line 2 */ $_tmp = $this->global->uiControl->getComponent("places");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
    <p>
        <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $date, 'd.m.Y')) /* line 4 */ ?> <a href=<?php
		echo LR\Filters::escapeHtmlAttrUnquoted($this->global->uiControl->link("Homepage:default", ['page' => $prev])) ?>>prev</a> | <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default", ['page' => $next])) ?>">next</a>
    </p>
    
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">place</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["reservationForm"];
		?>                    <form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
                        <input<?php
		$_input = end($this->global->formsStack)["place"];
		echo $_input->getControlPart()->attributes() ?>>
                        
                        <div class="form-group">
                            <input class="form-control" placeholder="Plate Number"<?php
		$_input = end($this->global->formsStack)["plate_number"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
                        </div>
                        
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control"<?php
		$_input = end($this->global->formsStack)["date_from"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control"<?php
		$_input = end($this->global->formsStack)["date_to"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>
                        </div>
                          
                        <br>
                        
                        <div class="form-group">
                            <input class="btn btn-primary mb-2"<?php
		$_input = end($this->global->formsStack)["send"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>
                        </div>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>                    </form>
                    
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
<?php
	}


	function blockScripts($_args)
	{
		
	}


	function blockHead($_args)
	{
		
	}

}
