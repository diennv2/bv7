<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ConfirmAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        "https://fonts.googleapis.com/css?family=Raleway",
        "themes/plugins/bootstrap/css/bootstrap.min.css",
        "themes/css/font.css",
        "themes/plugins/font-awesome/css/font-awesome.min.css",
        "themes/plugins/simple-line-icons/simple-line-icons.min.css",
        "themes/plugins/bootstrap-switch/css/bootstrap-switch.min.css",
        "css/confirm.css",
    ];
    public $js = [
        "mainjs/confirm.js",
    ];

}
