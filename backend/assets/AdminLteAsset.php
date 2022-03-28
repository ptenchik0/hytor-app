<?php


namespace backend\assets;

use rmrevin\yii\fontawesome\NpmFreeAssetBundle;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AdminLteAsset extends AssetBundle
{

    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';

    public $css = [
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
        'css/adminlte.min.css',
    ];

    public $js = [
        'js/adminlte.min.js'
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapPluginAsset::class,
        NpmFreeAssetBundle::class,
        //JquerySlimScroll::class
    ];
}