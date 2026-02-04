<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
?>
<div class="contact-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_name',
            'slogan',
            'address:ntext',
            'address1:ntext',
            'phone',
            'footer',
            'fax',
            'email:email',
            'email_bcc:email',
        ],
    ]) ?>

</div>
