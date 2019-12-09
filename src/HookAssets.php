<?php
namespace kilyakus\widget\hook;

use yii\web\AssetBundle;

class HookAssets extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';

        $this->js[] = 'js/hook.js';

        $this->css[] = 'css/hook.css';
    }
}