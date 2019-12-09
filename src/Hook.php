<?php
namespace kilyakus\widget\hook;

use Yii;
use yii\web\JsExpression;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class Hook extends Widget
{
	public $pluginName = 'hook';

	public $image = '/bin/media/img/move.png';

	public $container = false;

	public function run()
	{
		parent::run();

		HookAssets::register(Yii::$app->getView());

		echo Html::beginTag('div', ['class' => 'dg-hook-container']);

			if($this->container === true){
				echo Html::beginTag('div', ['class' => 'container']);
			}

			echo Html::beginTag('div', ['class' => 'dg-hook']);

				echo Html::beginTag('div', ['class' => 'dg-hook-move']);

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
			$('.dg-hook-move').hook({
				containment: 'parent',
				drag: function(e) {
					console.log(1)
				},
				stop: function(e) {
					$('.dg-hook-move').attr('style', 'left:'+($($(this).parent()).width()/2 - $('.dg-hook-move').width()/2)+'px;');
					console.log($($(this).parent()).width());
				}
			})
		"), yii\web\View::POS_END);
	}
}
