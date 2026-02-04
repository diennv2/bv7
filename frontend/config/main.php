<?php

use \yii\web\Request;
$request = new Request();
$baseUrl = str_replace('/frontend/web','',$request->baseUrl);
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'cookieValidationKey' => '[XQV155EvgFTfLJ6GrJHV]',
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => $baseUrl,
        ],

        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [ ]
                ],
                'yii\bootstrap\BootstrapAsset' => FALSE,
                'kartik\grid\GridViewAsset' => FALSE,

                'yii\bootstrap\BootstrapPluginAsset' => FALSE,
            ]
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_frontendUser', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'log' => [
            'traceLevel' => 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>'.html',
            'rules' => [
                '' => 'site/index',
                '<catname>/<url>-n<id:\d+>'=>'site/news',
                '<catname>-l<id:\d+>'=>'site/listnews',
                '<tieude>-td<id:\d+>'=>'site/listcauhoi',
                '<danhmucvanban>-dmvb<id:\d+>'=>'site/vanbans',
                '<video>-vd<id:\d+>'=>'site/video',
                '<name>-g<id:\d+>'=>'site/listgroup',
                'user<user:\d+>-profile'=>'site/profile',
                '<path>-p<id:\d+>'=>'product/product',
                '<path>-cl<id:\d+>'=>'site/catlist',
                '<path>-br<id:\d+>'=>'site/brand',
                '<path>-s<id:\d+>'=>'product/detailproduct',
                '<title>-b<id:\d+>'=>'site/page',
                '<title>-ck<id:\d+>'=>'site/chuyenkhoas',
                '<title>-v<id:\d+>'=>'site/viewviec',
                '<type>-tg<value:\d+>'=>'site/tag',
                '<name>-topic<id:\d+>'=>'site/viewtopic',
                '<url>-ld<id:\d+>'=>'site/landingpage',
                '<url>-getlanding<id:\d+>'=>'site/getlanding',
                'xac-thuc-v<id:\d+>'=>'site/userverify',
                'thao-luan-tl<id:\d+>'=>'site/topic',
                'error'=>'site/error',
                'them-bai-viet'=>'site/addtopic',
                'lien-he' => 'site/contact',
                'san-pham' => 'site/sanpham',
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
                'dang-xuat'=>'site/logout',
                'cart'=>'product/giohang',
                'tim-kiem'=>'site/search',
                'nhanqua'=>'site/nhanqua',
                'lich-su-doi-qua'=>'site/lichsudoiqua',
                'topup-webhook'=>'site/topupwebhook',
                'xacthucthanhcong'=>'site/xacthucdone',
                'datlich'=>'site/datlichkham',
                'video' => 'site/video',
                'list-video'=>'site/listvideo',
                'dat-cau-hoi'=>'site/datcauhoi',
                'list-cau-hoi'=>'site/listdatcauhoi',

                'action-delete'=>'product/xoagiohang',

                // API News routes - đặt trước rule controller chung
                'api/news/get-all' => 'appservices/get-all-news',
                'api/news/get-by-id' => 'appservices/get-news-by-id',
                'api/news/get-paginated' => 'appservices/get-news-paginated',
                'api/news/get-hot' => 'appservices/get-hot-news',
                'api/news/get-home' => 'appservices/get-home-news',

                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],

    ],
//    'on beforeRequest' => function ($event) {
//        if(!Yii::$app->request->isSecureConnection){
//            $url = Yii::$app->request->getAbsoluteUrl();
//            $url = str_replace('http:', 'https:', $url);
//            Yii::$app->getResponse()->redirect($url);
//            Yii::$app->end();
//        }
//    },
    'params' => $params,
];