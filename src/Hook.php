<?php
namespace kilyakus\widget\hook;

use Yii;
use yii\web\JsExpression;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class Hook extends Widget
{
	const DRAG_LEFT = 'left';
	const DRAG_RIGHT = 'right';

	public $pluginName = 'hook';

	public $image;

	public $container = false;

	public $options = [];

	public $containment = 'parent';

	public $drag = [
		self::DRAG_LEFT,
		self::DRAG_RIGHT,
	];

	public function init()
	{
		if(empty($this->image)){
			$this->image = '/bin/media/img/move.png';
		}
	}

	public function run()
	{
		parent::run();

		HookAssets::register(Yii::$app->getView());

		echo Html::beginTag('div', array_merge_recursive(['class' => 'dg-hook-container'], $this->options));

			if($this->container === true){
				echo Html::beginTag('div', ['class' => 'container']);
			}

			echo Html::beginTag('div', ['class' => 'dg-hook-alignment']);

				echo Html::beginTag('div', ['id' => $this->id, 'class' => 'dg-hook-move']);

					echo Html::beginTag('div', ['class' => 'dg-hook-grab']);

						echo Html::img($this->image);

					echo Html::endTag('div');

				echo Html::endTag('div');

			echo Html::endTag('div');

			if($this->container === true){
				echo Html::endTag('div');
			}

		echo Html::endTag('div');

		$this->view->registerJs(new JsExpression("
			$('.dg-hook-move#" . $this->id . "').hook({
				containment: '" . $this->containment . "',
				drag: (function(d, last){

					var isMouseDown = false;

					$(d).on('mousedown touchstart', function(){ isMouseDown = true; });
					$(d).on('mouseup touchend', function(){ isMouseDown = false; });

					$(d).on('touchend', function(){
						var width = ($($('.dg-hook-move#" . $this->id . "').parent()).width() - $('.dg-hook-move#" . $this->id . "').width())/2;
						$('.dg-hook-move#" . $this->id . "').attr('style', 'left:'+width+'px;');
					});

					$(d).on('mousemove', function(e){

						if(isMouseDown){
							var position = e.clientX ? e.clientX : e.originalEvent.changedTouches[0].clientX;

							if(position < last){
								" . $this->drag[self::DRAG_LEFT] . "
							}else{
								" . $this->drag[self::DRAG_RIGHT] . "
							}

							last = position;
						}
					})

					$(d).on('touchmove', function(e){

						var target = e.target, grab = $(target).hasClass('dg-hook-grab');

						if(isMouseDown && grab){

							var position = e.clientX ? e.clientX : e.originalEvent.changedTouches[0].clientX;
								
							$('.dg-hook-move#" . $this->id . "').attr('style','left:' + (position/2 - ($($(e.target).parent()).width()/2 - $(e.target).width())) + 'px;');

						}
					});

				})(document, 0),
				stop: function(e) {
					var width = ($($('.dg-hook-move#" . $this->id . "').parent()).width() - $('.dg-hook-move#" . $this->id . "').width())/2;
					$('.dg-hook-move#" . $this->id . "').attr('style', 'left:'+width+'px;');
				}
			})
		"), yii\web\View::POS_END);
	}
}
