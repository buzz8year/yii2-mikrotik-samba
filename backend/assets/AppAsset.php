<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'https://fonts.googleapis.com/css?family=Titillium+Web:200,300,400,600',
        // 'https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600',
        // 'https://fonts.googleapis.com/css?family=Ubuntu+Mono:200,300,400,600',
        'https://fonts.googleapis.com/css?family=PT+Mono:200,300,400,600',
        'css/site.css',
    ];
    
    public $js = [
        'js/chart.min.js',
        // 'js/miner-charts.js',
        'js/first-charts.js',
        'js/rig-index-mutual.js',
        'js/rig-first.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
