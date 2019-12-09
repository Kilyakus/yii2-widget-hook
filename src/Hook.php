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

	public function init()
	{

	}

	public function run()
	{
		parent::run();

		HookAssets::register(Yii::$app->getView());

		echo Html::beginTag('div', ['class' => 'dg-hook']);

			echo Html::beginTag('div', ['class' => 'dg-hook-move']);

			echo Html::endTag('div');

		echo Html::endTag('div');

		// <div class="w-12 h-align v-align" style="height: 43px;margin-bottom: 20px;margin-top: 30px;">
		// 	<div class="position-absolute move clearfix">
		// 		<div class="cursor-move img">
		// 			<img src="/bin/media/img/move.png" alt="">
		// 		</div>
		// 	</div>
		// </div>

		// $this->view->registerJs(new JsExpression("

		// "), yii\web\View::POS_END);
	}
}
