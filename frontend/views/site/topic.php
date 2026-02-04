<?php

$config = \common\models\Configure::getConfig();


use common\models\Configure;
use yii\widgets\ActiveForm;

\johnitvn\ajaxcrud\CrudAsset::register($this);

?>
<div class="col-xs-12" style="background-image: url(<?=$product->getDefaultImage()?>);position: absolute;left: 0;padding-top: 10vh;padding-bottom: 10vh;">
    <div class="ttxxx">
        <h1 class="thaoluantitle">Thảo luận: <span><?=$product->name?></span></h1>
    </div>
</div>
<style>
    .ttxxx:after{
        content: "";
        position: absolute;left: 0;
        width: 100%;
        height: 100%;
        top: 0;
        background: #00000085;
        z-index: 98;
    }
    .thaoluantitle{
        text-transform: uppercase;font-size: 2em;font-weight: bold;color: #f0f0f0;z-index: 99;position: absolute;left: 0;
        width: 100%;
        margin: 15px 0;
        text-align: center;
        transform: translateY(-20px);
    }
</style>
<div class="backgroundwhite container" style="min-height: 100vh;margin-top: 20vh">
    <div class="container" style="padding: 3vh 0;clear: both">
        <div class="col-xs-12">
            <a class="btn btn-success" href="<?=Yii::$app->urlManager->createUrl(['site/addtopic'])?>" title="Tạo mới Topic"><i class="glyphicon glyphicon-plus" style="font-weight: bold;font-size: 14px;line-height: 14px;top:0"></i> Thêm mới topic</a>
        </div>
        <div class="col-xs-12" style="padding-top: 10px">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'emptyText'=>'Chưa có topic nào được tạo, hãy tạo một topic để bắt đầu thảo luận hay chia sẻ cùng những người khác!',
                'layout' =>  "<div class='row'><div class='col-xs-12' style='margin: 10px 0'>{summary}</div></div>{items}<div class='row'><div class='col-xs-12' style='margin: 10px 0'>{pager}</div></div>",
                'itemOptions' => [
                    'tag' => false
                ],
                'itemView' =>function ($order, $key, $index, $widget) use($config){

                    return $this->render( '_topic', [
                        'model'=>$order,
                        'config'=>$config
                    ]);

                },
            ]);
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>