<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/** @var \common\models\Vanban $model */

?>
<?php $value = $model ?>
<tr>
    <td><?=$key?></td>
    <td><?= $model->mavanban ?></td>
    <td><?= $model->ngayvanban ?></td>
    <td><?= $model->trichyeu ?></td>
    <td><a title="Tải xuống" download href="<?= $model->filedinhkem ?>"><span class="cmsmasters_simple_icon cmsmasters-icon-custom-27"></span>Tải xuống</a></td>
</tr>
