<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Donvi */
?>
<div class="donvi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'companyname:ntext',
            [
                    'attribute'=>'aboutcompany',
                'value'=>function($data){
                    return "<div style='max-height:200px;overflow-y:scroll'>".$data->aboutcompany."</div>";
                },
                'format'=>'raw',
            ]
        ],
    ]) ?>

</div>
