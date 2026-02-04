<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Listnhanqua */
?>
<div class="listnhanqua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'billid',
            'productid',
            'ngaynhan',
        ],
    ]) ?>

</div>
