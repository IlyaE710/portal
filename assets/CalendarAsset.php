<?php

namespace app\assets;

class CalendarAsset extends \yii\web\AssetBundle
{
    public $sourcePath  = '@npm';

    public $js = [
        'fullcalendar/index.global.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}