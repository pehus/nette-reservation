<?php
// source: C:\xampp\htdocs\nette-reservation\app\components\Place/place.latte

use Latte\Runtime as LR;

class Template2d3c073060 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<table class="reservation">
    <tr>
<?php
		$counter = 1;
		$iterations = 0;
		foreach ($places as $key => $place) {
?>
            <td class="free">
                <a href="#" data-toggle="modal" data-target="#modal-<?php echo LR\Filters::escapeHtmlAttr($place) /* line 6 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($place) /* line 6 */ ?></a>
                
                <!-- Modal -->
                <div class="modal fade" id="modal-<?php echo LR\Filters::escapeHtmlAttr($place) /* line 9 */ ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php
			echo LR\Filters::escapeHtmlAttr($place) /* line 9 */ ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">place <?php echo LR\Filters::escapeHtmlText($place) /* line 13 */ ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
<?php
			/* line 19 */ $_tmp = $this->global->uiControl->getComponent("reservationForm");
			if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
?>
                      </div>
                      <div class="modal-footer">

                      </div>
                    </div>
                  </div>
                </div>
                
<?php
			if ($counter >= 20) {
?>
                    </tr>
<?php
				$counter = 0;
			}
?>
            </td>
<?php
			$counter++;
			$iterations++;
		}
?>
    <tr>            
</table><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['key'])) trigger_error('Variable $key overwritten in foreach on line 4');
		if (isset($this->params['place'])) trigger_error('Variable $place overwritten in foreach on line 4');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
