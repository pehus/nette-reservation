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
			?>            <td class="<?php
			if ($place['is_free']) {
				?>free<?php
			}
			else {
				?>occupied<?php
			}
?>">
<?php
			if ($place['is_free']) {
				?>                <a href="#" class="place" data-toggle="modal" data-target="#modal" data-place="<?php
				echo LR\Filters::escapeHtmlAttr($place['place']) /* line 7 */ ?>"><?php echo LR\Filters::escapeHtmlText($place['place']) /* line 7 */ ?></a>
<?php
			}
			else {
				?>                <span class="place"><?php echo LR\Filters::escapeHtmlText($place['place']) /* line 9 */ ?></span>    
<?php
			}
?>
                
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
