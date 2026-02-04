<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Congviec */
?>
<div class="congviec-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten',
            'mota',
            'noilamviec',
            'nganhnghe',
            'vitriungtuyen',
            'capbac',
            'thoigianlamviec',
            'mucluong',
            'yeucauchung:ntext',
            'chinhsachphucloi:ntext',
            'lienhe:ntext',

            'tuvanvien:ntext',
        ],
    ]) ?>

</div>
