<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Thuoctinhproduct */
?>
<div class="thuoctinhproduct-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gia',
            'conhang:boolean',
            'giagoc',
            [
                    'label'=>"",
                'value'=>function($value){
                    $returnvalue = "<label class=\"label label-danger\">";
                    $listthuoctinh = \common\models\Thuoctinh::find()->all();
                    $dulieuthuoctinh = \yii\helpers\Json::decode($value->thuoctinh_id);
                    foreach ($dulieuthuoctinh as $value2){
                        foreach ($listthuoctinh as $valuett){
                            if($valuett->id==$value2){
                                $returnvalue.=$valuett->tenthuoctinh.", ";
                                break;
                            }
                        }
                    }
                    $returnvalue.="</label>";
                    return $returnvalue;
                },
                'format'=>'raw'
            ]
        ],
    ]) ?>

</div>
