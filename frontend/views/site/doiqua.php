<?php

$config = \common\models\Configure::getConfig();
$this->title="Lịch sử đổi quà";
use common\models\Configure;
use yii\widgets\ActiveForm;

\johnitvn\ajaxcrud\CrudAsset::register($this);
?>
<div class="container" style="margin-top: 25px">
    <h1 style="font-weight: bold;text-transform: uppercase">Lịch sử đổi quà</h1>
    <div class="col-xs-12 table-responsive" style="margin-top: 25px">
        <?php  echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' =>  "{summary}\n<table class='table table-bordered table-hover table-striped'><tr><th>STT</th><th>Ngày đổi</th><th>Số tiền</th><th>Chi tiết</th><th>Trạng thái</th></tr>{items}</table>\n{pager}",
            'itemOptions' => [
                'tag' => false
            ],
            'itemView' =>function ($order, $key, $index, $widget) use($config){

                return $this->render( '_doiqua', [
                    'model'=>$order,
                    'config'=>$config,
                    'index'=>$index
                ]);

            },
        ]);
        ?>
    </div>
</div>
