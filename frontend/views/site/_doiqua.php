<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Coinexchange $model */

?>
<?php $value=$model?>
<tr>
    <td><?=$index?></td>
    <td><?=$value->time?></td>
    <td><?=number_format($value->sodiem,0,"",".")?> VNĐ</td>
    <td>
        Số điện thoại nạp: <?=$value->phonenumber?><br>
        Mạng: <?=$value->getBrand()?><br>
        Phương thức nạp: <?=$value->getType()?><br>
    </td>
    <td><?=$value->getStatusText()?></td>
</tr>
