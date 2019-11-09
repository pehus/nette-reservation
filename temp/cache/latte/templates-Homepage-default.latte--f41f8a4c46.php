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
<?php
	}


	function blockScripts($_args)
	{
		
	}


	function blockHead($_args)
	{
		
	}

}
