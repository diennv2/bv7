<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Catnew */
?>
<div class="catnew-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'loaivanban',
        ],
    ]) ?>

</div>
