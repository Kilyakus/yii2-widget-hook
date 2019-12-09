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

		// $this->view->registerJs(new JsExpression("

		// "), yii\web\View::POS_END);
	}
}
