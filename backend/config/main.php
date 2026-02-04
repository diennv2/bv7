<?php

use \yii\web\Request;
$request = new Request();
$baseUrl = str_replace('/backend/web','/admin',$request->baseUrl);
$homeUrl = str_replace("/admin",'',$baseUrl);
//require('/home/admin/domains/vendor/yexcel/Yexcel.php');
//require_once('/home/admin/domains/vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');
//require_once('/home/admin/domains/vendor/PHPExcel/Classes/PHPExcel.php');
require('G:/Project-company/vendor/yexcel/Yexcel.php');
require_once('G:/Project-company/vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');
require_once('G:/Project-company/vendor/PHPExcel/Classes/PHPExcel.php');
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'downloadAction' => 'gridview/export/download',
            ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $baseUrl,
            'cookieValidationKey' => '[LuFYCE3t8YhPj7jxbP5t]',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
//            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_backendUser', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'myphamsdev',
            'savePath' => sys_get_temp_dir(),
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/index',
        ],

        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'dang-nhap-admin' => 'site/login',
                '<controller:\w+>/' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',

            ],
        ],
        'urlManagerFrontend'=>[
            'baseUrl' => $homeUrl,
            'enablePrettyUrl' => true,
            'class' => 'yii\web\UrlManager',
            'showScriptName'=>false,
            'hostInfo' => '/',
            'suffix'=>'.html',
            'rules' => [
                '' => 'site/index',
                '<catname>/<url>-n<id:\d+>'=>'site/news',
                '<catname>-l<id:\d+>'=>'site/listnews',
                '<name>-g<id:\d+>'=>'site/listgroup',
                '<path>-p<id:\d+>'=>'product/product',
                '<path>-cl<id:\d+>'=>'site/catlist',
                '<path>-br<id:\d+>'=>'site/brand',
                '<path>-s<id:\d+>'=>'product/detailproduct',
                '<title>-b<id:\d+>'=>'site/page',
                '<title>-v<id:\d+>'=>'site/viewviec',
                '<type>-tg<value:\d+>'=>'site/tag',
                '<url>-ld<id:\d+>'=>'site/landingpage',
                'xac-thuc-v<id:\d+>'=>'site/userverify',
                'error'=>'site/error',
                'lien-he' => 'site/contact',
                'dien-thoai-4G' => 'site/dienthoai',
                'gioi-thieu' => 'site/about',
                'account' => 'site/overview',
                'dang-ky' => 'site/signup',
                'thanhcong' => 'site/success',
                'dang-nhap' => 'site/login',
                'thanh-toan'=>'product/payment',
                'dat-hang-thanh-cong'=>'product/done',
                'dat-hang-khong-thanh-cong'=>'product/fail',
                'addtocart'=>'product/addtocart',
                'cart'=>'product/giohang',
                'tim-kiem'=>'site/search',
                'xacthucthanhcong'=>'site/xacthucdone',

                'action-delete'=>'product/xoagiohang',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
	'on beforeRequest' => function ($event) {
        if(!Yii::$app->request->isSecureConnection){
            $url = Yii::$app->request->getAbsoluteUrl();
            $url = str_replace('http:', 'https:', $url);
            Yii::$app->getResponse()->redirect($url);
            Yii::$app->end();
        }
    },
    'params' => $params,
];
