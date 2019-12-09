<?php
namespace kilyakus\widget\hook;

use yii\web\AssetBundle;

class HookAssets extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';

        $this->js[] = 'js/widget-hook.js';

        $this->css[] = 'css/widget-hook.css';
    }
}