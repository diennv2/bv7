<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>
<div class="product-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'url:ntext',
            'code',
            [
                    'attribute'=>'brief',
                    'value'=>function($model){
                        return "<div style='max-height: 250px; overflow-y:scroll'>".$model->brief."</div>";
                    },
                    'format'=>'raw'
            ],
            [
                'attribute'=>'decription',
                'value'=>function($model){
                    return "<div style='max-height: 250px; overflow-y:scroll'>".$model->decription."</div>";
                },
                'format'=>'raw'
            ],
            'retail',
            'sale',
            [
                'attribute'=>'cat_product_id',
                'value'=>function($model){
                    return $model->catProduct->name;
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'brand_id',
                'value'=>function($model){
                    return $model->brand->name;
                },
                'format'=>'raw'
            ],
            'philapdat',
            'tag',
            'tags',
            'luotxem'
        ],
    ]) ?>

</div>
